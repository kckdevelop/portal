<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Guestbook;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GuestbookController extends Controller
{
    /**
     * Display guestbook page with form and recent entries.
     */
    public function index()
    {
        $guestbooks = Guestbook::where('is_approved', true)
                               ->latest()
                               ->paginate(12);

        $totalEntries = Guestbook::count();

        return view('guestbook.index', compact('guestbooks', 'totalEntries'));
    }

    /**
     * Store a newly created guestbook entry with selfie image.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'institution' => 'required|string|max:150',
            'message' => 'required|string|max:1000',
            'rating' => 'nullable|integer|min:1|max:5',
            'selfie_image' => 'nullable|string', // Base64 data URI from webcam/camera
            'selfie_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // Upload from gallery
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'institution.required' => 'Instansi / Asal sekolah wajib diisi.',
            'message.required' => 'Pesan, kesan, atau saran wajib diisi.',
            'selfie_file.image' => 'File foto harus berupa gambar yang valid (JPEG, PNG, WebP).',
            'selfie_file.max' => 'Ukuran foto maksimal adalah 5MB.',
        ]);

        $selfiePath = null;

        // Ensure storage directory exists
        if (!Storage::disk('public')->exists('guestbook_selfies')) {
            Storage::disk('public')->makeDirectory('guestbook_selfies');
        }

        // 1. Check if base64 camera image was provided
        if (!empty($request->selfie_image) && str_starts_with($request->selfie_image, 'data:image/')) {
            try {
                $imageParts = explode(';base64,', $request->selfie_image);
                $imageTypeAux = explode('image/', $imageParts[0]);
                $imageType = $imageTypeAux[1] ?? 'jpg';
                if ($imageType === 'jpeg') {
                    $imageType = 'jpg';
                }
                $imageBase64 = base64_decode($imageParts[1]);

                $fileName = 'selfie_' . date('Ymd_His') . '_' . Str::random(10) . '.' . $imageType;
                $relativePath = 'guestbook_selfies/' . $fileName;

                Storage::disk('public')->put($relativePath, $imageBase64);
                $selfiePath = $relativePath;
            } catch (\Exception $e) {
                // Ignore base64 decode errors or fallback
            }
        }
        // 2. Fallback or direct gallery file upload
        elseif ($request->hasFile('selfie_file') && $request->file('selfie_file')->isValid()) {
            $uploadedFile = $request->file('selfie_file');
            $fileName = 'selfie_upload_' . date('Ymd_His') . '_' . Str::random(10) . '.' . $uploadedFile->getClientOriginalExtension();
            $selfiePath = $uploadedFile->storeAs('guestbook_selfies', $fileName, 'public');
        }

        $guestbook = Guestbook::create([
            'name' => $validated['name'],
            'institution' => $validated['institution'],
            'message' => $validated['message'],
            'rating' => $validated['rating'] ?? 5,
            'selfie_path' => $selfiePath,
            'is_approved' => true,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Terima kasih telah berkunjung dan mengisi Buku Tamu Pameran Karya Siswa SMK Muhammadiyah 1 Bantul!',
                'data' => [
                    'id' => $guestbook->id,
                    'name' => $guestbook->name,
                    'institution' => $guestbook->institution,
                    'message' => $guestbook->message,
                    'rating' => $guestbook->rating,
                    'selfie_url' => $guestbook->selfie_url,
                    'created_at' => $guestbook->created_at->diffForHumans(),
                ],
            ]);
        }

        return redirect()->route('guestbook.index')->with('success', 'Terima kasih! Pesan dan foto selfie Anda berhasil disimpan di Buku Tamu Pameran.');
    }
}

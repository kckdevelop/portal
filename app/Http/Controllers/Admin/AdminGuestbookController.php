<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guestbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGuestbookController extends Controller
{
    /**
     * Display a listing of guestbook entries with filters.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');
        $rating = $request->query('rating');

        $query = Guestbook::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('institution', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($status !== null && $status !== '') {
            $query->where('is_approved', $status === '1');
        }

        if ($rating) {
            $query->where('rating', $rating);
        }

        $guestbooks = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => Guestbook::count(),
            'approved' => Guestbook::where('is_approved', true)->count(),
            'hidden' => Guestbook::where('is_approved', false)->count(),
            'avg_rating' => round(Guestbook::avg('rating') ?: 5, 1),
        ];

        return view('admin.guestbook.index', compact('guestbooks', 'stats', 'search', 'status', 'rating'));
    }

    /**
     * Toggle approval status of a guestbook entry.
     */
    public function toggleApproval(Guestbook $guestbook)
    {
        $guestbook->is_approved = !$guestbook->is_approved;
        $guestbook->save();

        $statusText = $guestbook->is_approved ? 'ditampilkan di website publik' : 'disembunyikan dari publik';

        return back()->with('success', 'Status pesan dari ' . $guestbook->name . ' berhasil diubah menjadi: ' . $statusText . '.');
    }

    /**
     * Remove the specified guestbook entry from storage.
     */
    public function destroy(Guestbook $guestbook)
    {
        $name = $guestbook->name;

        // Delete selfie photo if stored locally
        if ($guestbook->selfie_path && !str_starts_with($guestbook->selfie_path, 'http') && Storage::disk('public')->exists($guestbook->selfie_path)) {
            Storage::disk('public')->delete($guestbook->selfie_path);
        }

        $guestbook->delete();

        return redirect()->route('admin.guestbook.index')
            ->with('success', 'Pesan buku tamu dari "' . $name . '" berhasil dihapus.');
    }

    /**
     * Export all guestbook entries to CSV file.
     */
    public function exportCsv()
    {
        $filename = 'buku_tamu_musaba_' . date('Y-m-d_His') . '.csv';

        $guestbooks = Guestbook::orderBy('created_at', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($guestbooks) {
            $output = fopen('php://output', 'w');

            // UTF-8 BOM for Excel compatibility
            fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($output, ['ID', 'Nama Lengkap', 'Instansi / Asal Sekolah', 'Rating (1-5)', 'Pesan & Kesan', 'Status', 'Tanggal Kunjungan']);

            foreach ($guestbooks as $item) {
                fputcsv($output, [
                    $item->id,
                    $item->name,
                    $item->institution,
                    $item->rating,
                    $item->message,
                    $item->is_approved ? 'Disetujui (Tampil)' : 'Disembunyikan',
                    $item->created_at->format('d/m/Y H:i:s'),
                ]);
            }

            fclose($output);
        };

        return response()->stream($callback, 200, $headers);
    }
}

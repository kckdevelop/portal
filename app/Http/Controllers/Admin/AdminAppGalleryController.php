<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminAppGalleryController extends Controller
{
    /**
     * Display a listing of the student projects.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $jurusan = $request->query('jurusan') ?? $request->query('category');
        $featured = $request->query('featured');

        $query = AppGallery::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('student_name', 'like', "%{$search}%")
                  ->orWhere('student_class', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($jurusan && $jurusan !== 'all') {
            $query->where(function ($q) use ($jurusan) {
                $q->where('jurusan', $jurusan)
                  ->orWhere('category', $jurusan);
            });
        }

        if ($featured !== null && $featured !== '') {
            $query->where('featured', $featured === '1');
        }

        $apps = $query->orderBy('featured', 'desc')
                      ->orderBy('order', 'asc')
                      ->orderBy('created_at', 'desc')
                      ->paginate(10)
                      ->withQueryString();

        $jurusanList = AppGallery::JURUSAN_DETAILS;

        return view('admin.karya.index', compact('apps', 'jurusanList', 'search', 'jurusan', 'featured'));
    }

    /**
     * Show the form for creating a new student project.
     */
    public function create()
    {
        $jurusanList = AppGallery::JURUSAN_DETAILS;

        return view('admin.karya.form', [
            'karya' => new AppGallery(),
            'isEdit' => false,
            'jurusanList' => $jurusanList,
        ]);
    }

    /**
     * Store a newly created student project in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'student_name' => 'required|string|max:100',
            'student_class' => 'required|string|max:50',
            'jurusan' => 'nullable|string|in:TKR,TSM,TPM,TAV,PPLG',
            'category' => 'nullable|string',
            'description' => 'required|string',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'thumbnail_url' => 'nullable|url|max:500',
            'gallery_files.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'gallery_urls' => 'nullable|string',
            'tech_stacks' => 'nullable|string',
            'canva_url' => 'nullable|url|max:500',
            'demo_url' => 'nullable|url|max:500',
            'github_url' => 'nullable|url|max:500',
            'featured' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ], [
            'title.required' => 'Judul karya wajib diisi.',
            'student_name.required' => 'Nama siswa pembuat wajib diisi.',
            'student_class.required' => 'Kelas siswa wajib diisi.',
            'description.required' => 'Deskripsi karya wajib diisi.',
            'canva_url.url' => 'Format tautan Canva tidak valid.',
            'thumbnail_file.image' => 'File thumbnail harus berupa gambar.',
            'thumbnail_file.max' => 'Ukuran thumbnail maksimal 5MB.',
        ]);

        $selectedJurusan = $validated['jurusan'] ?? $validated['category'] ?? 'PPLG';

        // Process thumbnail
        $thumbnailPath = 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80';

        if ($request->hasFile('thumbnail_file') && $request->file('thumbnail_file')->isValid()) {
            if (!Storage::disk('public')->exists('thumbnails')) {
                Storage::disk('public')->makeDirectory('thumbnails');
            }
            $file = $request->file('thumbnail_file');
            $filename = 'karya_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $thumbnailPath = $file->storeAs('thumbnails', $filename, 'public');
        } elseif (!empty($validated['thumbnail_url'])) {
            $thumbnailPath = $validated['thumbnail_url'];
        }

        // Process gallery images (multiple photos)
        $galleryImages = [];

        // Uploaded files
        if ($request->hasFile('gallery_files')) {
            if (!Storage::disk('public')->exists('gallery')) {
                Storage::disk('public')->makeDirectory('gallery');
            }
            foreach ($request->file('gallery_files') as $gFile) {
                if ($gFile && $gFile->isValid()) {
                    $gFilename = 'gal_' . time() . '_' . Str::random(8) . '.' . $gFile->getClientOriginalExtension();
                    $galleryImages[] = $gFile->storeAs('gallery', $gFilename, 'public');
                }
            }
        }

        // Additional URLs
        if (!empty($validated['gallery_urls'])) {
            $urls = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $validated['gallery_urls']))));
            foreach ($urls as $u) {
                if (filter_var($u, FILTER_VALIDATE_URL) && !in_array($u, $galleryImages)) {
                    $galleryImages[] = $u;
                }
            }
        }

        // Process tech stacks (comma separated to array)
        $techStacks = [];
        if (!empty($validated['tech_stacks'])) {
            $techStacks = array_values(array_filter(array_map('trim', explode(',', $validated['tech_stacks']))));
        }

        if (empty($techStacks)) {
            $techStacks = ['Inovasi Vokasi', 'PBL Siswa'];
        }

        AppGallery::create([
            'title' => $validated['title'],
            'student_name' => $validated['student_name'],
            'student_class' => $validated['student_class'],
            'jurusan' => $selectedJurusan,
            'category' => $selectedJurusan,
            'description' => $validated['description'],
            'thumbnail' => $thumbnailPath,
            'images' => $galleryImages,
            'tech_stacks' => $techStacks,
            'canva_url' => $validated['canva_url'] ?? null,
            'demo_url' => $validated['demo_url'] ?? null,
            'github_url' => $validated['github_url'] ?? null,
            'featured' => $request->boolean('featured'),
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.karya.index')
            ->with('success', 'Karya siswa "' . $validated['title'] . '" berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified student project.
     */
    public function edit(AppGallery $karya)
    {
        $jurusanList = AppGallery::JURUSAN_DETAILS;

        return view('admin.karya.form', [
            'karya' => $karya,
            'isEdit' => true,
            'jurusanList' => $jurusanList,
        ]);
    }

    /**
     * Update the specified student project in storage.
     */
    public function update(Request $request, AppGallery $karya)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'student_name' => 'required|string|max:100',
            'student_class' => 'required|string|max:50',
            'jurusan' => 'nullable|string|in:TKR,TSM,TPM,TAV,PPLG',
            'category' => 'nullable|string',
            'description' => 'required|string',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'thumbnail_url' => 'nullable|url|max:500',
            'gallery_files.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'gallery_urls' => 'nullable|string',
            'delete_images' => 'nullable|array',
            'tech_stacks' => 'nullable|string',
            'canva_url' => 'nullable|url|max:500',
            'demo_url' => 'nullable|url|max:500',
            'github_url' => 'nullable|url|max:500',
            'featured' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $selectedJurusan = $validated['jurusan'] ?? $validated['category'] ?? $karya->jurusan ?? 'PPLG';

        $thumbnailPath = $karya->thumbnail;

        if ($request->hasFile('thumbnail_file') && $request->file('thumbnail_file')->isValid()) {
            if ($karya->thumbnail && !str_starts_with($karya->thumbnail, 'http') && Storage::disk('public')->exists($karya->thumbnail)) {
                Storage::disk('public')->delete($karya->thumbnail);
            }

            $file = $request->file('thumbnail_file');
            $filename = 'karya_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $thumbnailPath = $file->storeAs('thumbnails', $filename, 'public');
        } elseif (!empty($validated['thumbnail_url'])) {
            $thumbnailPath = $validated['thumbnail_url'];
        }

        // Manage existing and new gallery images
        $currentImages = is_array($karya->images) ? $karya->images : [];

        // Remove deleted images
        if (!empty($validated['delete_images']) && is_array($validated['delete_images'])) {
            foreach ($validated['delete_images'] as $delImg) {
                if (($key = array_search($delImg, $currentImages)) !== false) {
                    unset($currentImages[$key]);
                    if (!str_starts_with($delImg, 'http') && Storage::disk('public')->exists($delImg)) {
                        Storage::disk('public')->delete($delImg);
                    }
                }
            }
            $currentImages = array_values($currentImages);
        }

        // Upload new gallery files
        if ($request->hasFile('gallery_files')) {
            if (!Storage::disk('public')->exists('gallery')) {
                Storage::disk('public')->makeDirectory('gallery');
            }
            foreach ($request->file('gallery_files') as $gFile) {
                if ($gFile && $gFile->isValid()) {
                    $gFilename = 'gal_' . time() . '_' . Str::random(8) . '.' . $gFile->getClientOriginalExtension();
                    $currentImages[] = $gFile->storeAs('gallery', $gFilename, 'public');
                }
            }
        }

        // Append new URLs
        if (!empty($validated['gallery_urls'])) {
            $urls = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $validated['gallery_urls']))));
            foreach ($urls as $u) {
                if (filter_var($u, FILTER_VALIDATE_URL) && !in_array($u, $currentImages)) {
                    $currentImages[] = $u;
                }
            }
        }

        // Process tech stacks
        $techStacks = [];
        if (!empty($validated['tech_stacks'])) {
            $techStacks = array_values(array_filter(array_map('trim', explode(',', $validated['tech_stacks']))));
        }

        if (empty($techStacks)) {
            $techStacks = $karya->tech_stacks ?? ['Inovasi Vokasi', 'PBL Siswa'];
        }

        $karya->update([
            'title' => $validated['title'],
            'student_name' => $validated['student_name'],
            'student_class' => $validated['student_class'],
            'jurusan' => $selectedJurusan,
            'category' => $selectedJurusan,
            'description' => $validated['description'],
            'thumbnail' => $thumbnailPath,
            'images' => $currentImages,
            'tech_stacks' => $techStacks,
            'canva_url' => $validated['canva_url'] ?? null,
            'demo_url' => $validated['demo_url'] ?? null,
            'github_url' => $validated['github_url'] ?? null,
            'featured' => $request->boolean('featured'),
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.karya.index')
            ->with('success', 'Data karya siswa "' . $karya->title . '" berhasil diperbarui.');
    }

    /**
     * Remove the specified student project from storage.
     */
    public function destroy(AppGallery $karya)
    {
        $title = $karya->title;

        // Delete local thumbnail if exists
        if ($karya->thumbnail && !str_starts_with($karya->thumbnail, 'http') && Storage::disk('public')->exists($karya->thumbnail)) {
            Storage::disk('public')->delete($karya->thumbnail);
        }

        // Delete local gallery images if exist
        if (!empty($karya->images) && is_array($karya->images)) {
            foreach ($karya->images as $img) {
                if (!str_starts_with($img, 'http') && Storage::disk('public')->exists($img)) {
                    Storage::disk('public')->delete($img);
                }
            }
        }

        $karya->delete();

        return redirect()->route('admin.karya.index')
            ->with('success', 'Karya "' . $title . '" berhasil dihapus.');
    }

    /**
     * Toggle featured status of a student project.
     */
    public function toggleFeatured(AppGallery $karya)
    {
        $karya->featured = !$karya->featured;
        $karya->save();

        $status = $karya->featured ? 'ditandai sebagai Karya Rekomendasi' : 'dihapus dari Karya Rekomendasi';

        return back()->with('success', 'Karya "' . $karya->title . '" berhasil ' . $status . '.');
    }
}

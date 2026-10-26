<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppGallery;
use App\Models\Guestbook;

class HomeController extends Controller
{
    /**
     * Display landing page with exhibition catalog & highlights.
     */
    public function index(Request $request)
    {
        $jurusan = $request->query('jurusan') ?? $request->query('category');
        $search = $request->query('search');

        $query = AppGallery::query();

        if ($jurusan && $jurusan !== 'all') {
            $query->where(function ($q) use ($jurusan) {
                $q->where('jurusan', $jurusan)
                  ->orWhere('category', $jurusan);
            });
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('student_name', 'like', "%{$search}%")
                  ->orWhere('student_class', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('tech_stacks', 'like', "%{$search}%");
            });
        }

        $apps = $query->orderBy('featured', 'desc')
                      ->orderBy('order', 'asc')
                      ->orderBy('created_at', 'desc')
                      ->get();

        // Jurusan definitions & counts
        $jurusanList = AppGallery::JURUSAN_DETAILS;

        $jurusanCounts = AppGallery::selectRaw('jurusan, count(*) as count')
                                  ->groupBy('jurusan')
                                  ->pluck('count', 'jurusan')
                                  ->toArray();

        $stats = [
            'total_apps' => AppGallery::count(),
            'total_students' => 24,
            'total_visitors' => Guestbook::count(),
            'satisfaction_rate' => 99,
        ];

        $recentGuestbooks = Guestbook::where('is_approved', true)
                                     ->latest()
                                     ->take(4)
                                     ->get();

        return view('home', compact('apps', 'jurusanList', 'jurusanCounts', 'stats', 'recentGuestbooks', 'jurusan', 'search'));
    }

    /**
     * Display the specified student project detail page.
     */
    public function show(AppGallery $karya)
    {
        // Related works from the same major (jurusan)
        $relatedApps = AppGallery::where('id', '!=', $karya->id)
                                ->where(function ($q) use ($karya) {
                                    $q->where('jurusan', $karya->jurusan)
                                      ->orWhere('category', $karya->jurusan);
                                })
                                ->orderBy('featured', 'desc')
                                ->take(3)
                                ->get();

        // Fallback if less than 3 from same major, get other featured works
        if ($relatedApps->count() < 3) {
            $needed = 3 - $relatedApps->count();
            $otherApps = AppGallery::where('id', '!=', $karya->id)
                                  ->whereNotIn('id', $relatedApps->pluck('id'))
                                  ->orderBy('featured', 'desc')
                                  ->take($needed)
                                  ->get();
            $relatedApps = $relatedApps->merge($otherApps);
        }

        return view('karya.show', compact('karya', 'relatedApps'));
    }
}

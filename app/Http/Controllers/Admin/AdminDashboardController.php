<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppGallery;
use App\Models\Guestbook;

class AdminDashboardController extends Controller
{
    /**
     * Display admin dashboard overview.
     */
    public function index()
    {
        $stats = [
            'total_apps' => AppGallery::count(),
            'total_featured' => AppGallery::where('featured', true)->count(),
            'total_guestbooks' => Guestbook::count(),
            'approved_guestbooks' => Guestbook::where('is_approved', true)->count(),
            'average_rating' => round(Guestbook::avg('rating') ?: 5, 1),
        ];

        $latestApps = AppGallery::latest()->take(5)->get();
        $latestGuestbooks = Guestbook::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestApps', 'latestGuestbooks'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminSettingController extends Controller
{
    /**
     * Show settings and logo management page.
     */
    public function index()
    {
        $settings = [
            'school_name' => Setting::get('school_name', 'SMK Muhammadiyah 1 Bantul'),
            'portal_title' => Setting::get('portal_title', 'Portal Karya Siswa'),
            'event_name' => Setting::get('event_name', 'Musaba Expo 2026'),
            'header_subtitle' => Setting::get('header_subtitle', 'Pameran Inovasi Aplikasi & Karya Siswa'),
            'logo_url' => Setting::logoUrl(),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings and upload new logo.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'school_name' => 'required|string|max:150',
            'portal_title' => 'required|string|max:150',
            'event_name' => 'nullable|string|max:150',
            'header_subtitle' => 'nullable|string|max:255',
            'logo_file' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:3072',
        ], [
            'school_name.required' => 'Nama sekolah wajib diisi.',
            'portal_title.required' => 'Judul portal wajib diisi.',
            'logo_file.image' => 'File logo harus berupa gambar yang valid.',
            'logo_file.mimes' => 'Format logo yang didukung: PNG, JPG, JPEG, SVG, WebP.',
            'logo_file.max' => 'Ukuran file logo maksimal 3MB.',
        ]);

        Setting::set('school_name', $validated['school_name']);
        Setting::set('portal_title', $validated['portal_title']);
        Setting::set('event_name', $validated['event_name'] ?? '');
        Setting::set('header_subtitle', $validated['header_subtitle'] ?? '');

        // Handle logo upload
        if ($request->hasFile('logo_file') && $request->file('logo_file')->isValid()) {
            if (!Storage::disk('public')->exists('settings')) {
                Storage::disk('public')->makeDirectory('settings');
            }

            // Delete old custom logo if stored locally
            $oldLogo = Setting::get('logo_path');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }

            $file = $request->file('logo_file');
            $filename = 'logo_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('settings', $filename, 'public');

            Setting::set('logo_path', $path);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan portal dan logo sekolah berhasil diperbarui.');
    }

    /**
     * Remove custom logo and revert to default icon.
     */
    public function deleteLogo()
    {
        $oldLogo = Setting::get('logo_path');
        if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
            Storage::disk('public')->delete($oldLogo);
        }

        Setting::set('logo_path', null);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Logo kustom berhasil dihapus. Portal kini menggunakan logo ikon bawaan.');
    }
}

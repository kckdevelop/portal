<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AppGallerySeeder::class,
        ]);

        \App\Models\Guestbook::updateOrCreate(
            ['name' => 'Drs. H. Sugiyanto, M.Pd.'],
            [
                'institution' => 'Balai Dikmen DIY & Pengawas Sekolah',
                'message' => 'Luar biasa karya inovasi siswa SMK Muhammadiyah 1 Bantul! Aplikasi-aplikasi yang dipamerkan sangat relevan dengan kebutuhan industri masa kini. Maju terus Musaba!',
                'rating' => 5,
                'selfie_path' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80',
                'is_approved' => true,
            ]
        );

        \App\Models\Guestbook::updateOrCreate(
            ['name' => 'Maya Anggraeni, S.Kom.'],
            [
                'institution' => 'PT Solusi Teknologi Nusantara (Industri Mitra)',
                'message' => 'Sangat terkesan dengan penguasaan teknologi Flutter dan Laravel oleh siswa. SiBatik dan Smart Attendance siap kami dampingi untuk masuk tahap inkubasi!',
                'rating' => 5,
                'selfie_path' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=400&q=80',
                'is_approved' => true,
            ]
        );

        // Default Admin User
        User::updateOrCreate(
            ['email' => 'admin@musaba.sch.id'],
            [
                'name' => 'Admin Musaba',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            ]
        );

        // Default Site Settings
        \App\Models\Setting::updateOrCreate(['key' => 'school_name'], ['value' => 'SMK Muhammadiyah 1 Bantul']);
        \App\Models\Setting::updateOrCreate(['key' => 'portal_title'], ['value' => 'Portal Karya Siswa']);
        \App\Models\Setting::updateOrCreate(['key' => 'event_name'], ['value' => 'Musaba Expo 2026']);
        \App\Models\Setting::updateOrCreate(['key' => 'header_subtitle'], ['value' => 'Pameran Inovasi Aplikasi & Karya Siswa']);
    }
}

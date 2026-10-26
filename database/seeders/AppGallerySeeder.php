<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppGallery;

class AppGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apps = [
            // PPLG
            [
                'title' => 'Musaba Smart Attendance (Presensi QR & Geolocation)',
                'student_name' => 'Ahmad Zaki & Tim PPLG 1',
                'student_class' => 'XII PPLG 1',
                'jurusan' => 'PPLG',
                'category' => 'PPLG',
                'description' => 'Aplikasi absensi presensi siswa berbasis mobile dengan integrasi GPS geofencing lingkungan sekolah dan QR Code dinamis untuk verifikasi kehadiran yang aman, transparan, dan real-time.',
                'thumbnail' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1000&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1000&q=80',
                ],
                'tech_stacks' => ['Flutter', 'Laravel 12', 'MySQL', 'Google Maps API'],
                'canva_url' => 'https://www.canva.com/design/play?template=EAFexample_smart_attendance',
                'demo_url' => 'https://github.com/smk-muh1-bantul/smart-attendance',
                'github_url' => 'https://github.com/smk-muh1-bantul/smart-attendance',
                'featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'SiBatik Bantul - E-Commerce & Ensiklopedia Batik Tradisional',
                'student_name' => 'Nur Aini Rahmawati & Daffa Pratama',
                'student_class' => 'XII PPLG 2',
                'jurusan' => 'PPLG',
                'category' => 'PPLG',
                'description' => 'Platform katalog interaktif dan e-commerce pelestarian batik khas Bantul dilengkapi fitur ensiklopedia filosofi corak batik lokal serta simulasi kain busana digital.',
                'thumbnail' => 'https://images.unsplash.com/photo-1558769132-cb1aea458c5e?auto=format&fit=crop&w=1000&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1558769132-cb1aea458c5e?auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1000&q=80',
                ],
                'tech_stacks' => ['Laravel 12', 'Tailwind CSS', 'Alpine.js', 'Midtrans Gateway'],
                'canva_url' => 'https://www.canva.com/design/play?template=EAFexample_sibatik_bantul',
                'demo_url' => 'https://github.com/smk-muh1-bantul/sibatik-bantul',
                'github_url' => 'https://github.com/smk-muh1-bantul/sibatik-bantul',
                'featured' => true,
                'order' => 2,
            ],
            [
                'title' => 'Aksara Hero - Petualangan Budaya Game Edukasi 2D',
                'student_name' => 'Rian Hendrawan & Bayu Aji',
                'student_class' => 'XI PPLG',
                'jurusan' => 'PPLG',
                'category' => 'PPLG',
                'description' => 'Game 2D platformer edukasi aksara Jawa dengan petualangan interaktif, kuis tebak sandhangan, dan leaderboard online antar siswa tingkat sekolah se-Kabupaten Bantul.',
                'thumbnail' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=1000&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1552824722-ddab1374e622?auto=format&fit=crop&w=1000&q=80',
                ],
                'tech_stacks' => ['Unity 2D', 'C#', 'Photoshop', 'Android SDK'],
                'canva_url' => 'https://www.canva.com/design/play?template=EAFexample_aksara_hero',
                'demo_url' => 'https://github.com/smk-muh1-bantul/aksara-hero',
                'github_url' => 'https://github.com/smk-muh1-bantul/aksara-hero',
                'featured' => false,
                'order' => 3,
            ],

            // TKR (Teknik Kendaraan Ringan)
            [
                'title' => 'Smart EFI Engine Trainer & Diagnostic Scanner OBD-II',
                'student_name' => 'Fajar Santoso & Tim TKR Otomotif',
                'student_class' => 'XII TKR 1',
                'jurusan' => 'TKR',
                'category' => 'TKR',
                'description' => 'Modul simulator engine stand injeksi bensin (EFI) lengkap dengan modul trouble shooting injeksi, sensor MAP/TPS/O2 digital, dan konektivitas scanner OBD-II Bluetooth ke smartphone.',
                'thumbnail' => 'https://images.unsplash.com/photo-1486006920555-c77dce18193b?auto=format&fit=crop&w=1000&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1486006920555-c77dce18193b?auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?auto=format&fit=crop&w=1000&q=80',
                ],
                'tech_stacks' => ['OBD-II Protocol', 'Arduino Mega', 'ELM327 Bluetooth', 'ECU Simulator'],
                'canva_url' => 'https://www.canva.com/design/play?template=EAFexample_tkr_efi',
                'demo_url' => 'https://youtube.com',
                'github_url' => null,
                'featured' => true,
                'order' => 4,
            ],

            // TSM (Teknik Sepeda Motor)
            [
                'title' => 'Smart Keyless RFID & Anti-Begal IoT Motor Injeksi',
                'student_name' => 'Bima Prasetyo & Ilham Kurniawan',
                'student_class' => 'XII TSM 2',
                'jurusan' => 'TSM',
                'category' => 'TSM',
                'description' => 'Sistem pengaman motor berbasis RFID smart key dan modul IoT pemutus kelistrikan jarak jauh via aplikasi ponsel pintar, dilengkapi pelacak lokasi GPS anti-pencurian kendaraan.',
                'thumbnail' => 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=1000&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1599819811279-d5ad9cccf838?auto=format&fit=crop&w=1000&q=80',
                ],
                'tech_stacks' => ['ESP32 Microcontroller', 'RFID RC522', 'GPS NEO-6M', 'Blynk IoT App'],
                'canva_url' => 'https://www.canva.com/design/play?template=EAFexample_tsm_keyless',
                'demo_url' => 'https://youtube.com',
                'github_url' => null,
                'featured' => true,
                'order' => 5,
            ],

            // TPM (Teknik Pemesinan)
            [
                'title' => 'Mini CNC Milling & Engraving Router 3-Axis Presisi',
                'student_name' => 'Wisnu Pamungkas & Galih Prakoso',
                'student_class' => 'XII TPM 1',
                'jurusan' => 'TPM',
                'category' => 'TPM',
                'description' => 'Mesin CNC router mini berdaya 500W dengan tingkat presisi tinggi untuk pembuatan pcb, ukir akrilik, dan plakat kayu presisi, dikendalikan software G-Code terintegrasi.',
                'thumbnail' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=1000&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1581092335397-9583fe92d232?auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1504917599217-d4dc5ebe6122?auto=format&fit=crop&w=1000&q=80',
                ],
                'tech_stacks' => ['GRBL Firmware', 'Stepper NEMA 23', 'Fusion 360 CAM', 'Spindle 500W'],
                'canva_url' => 'https://www.canva.com/design/play?template=EAFexample_tpm_cnc',
                'demo_url' => 'https://youtube.com',
                'github_url' => null,
                'featured' => false,
                'order' => 6,
            ],

            // TAV (Teknik Audio Video)
            [
                'title' => 'Smart Hi-Fi Audio Amplifier DSP & Equalizer Digital',
                'student_name' => 'Rangga Wijaya & Satria Utama',
                'student_class' => 'XII TAV 1',
                'jurusan' => 'TAV',
                'category' => 'TAV',
                'description' => 'Sistem penguat sinyal audio fidelitas tinggi (Hi-Fi) Kelas D 2x100W dilengkapi chip Digital Signal Processing (DSP) akustik ruang, koneksi Bluetooth 5.0 APTX, dan VU display retro.',
                'thumbnail' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?auto=format&fit=crop&w=1000&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1546435770-a3e426bf472b?auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1511379938547-c1f69419868d?auto=format&fit=crop&w=1000&q=80',
                ],
                'tech_stacks' => ['TPA3116D2 Class-D', 'ADA1701 DSP', 'Bluetooth 5.0 Lossless', 'Analog VU Meter'],
                'canva_url' => 'https://www.canva.com/design/play?template=EAFexample_tav_hifi',
                'demo_url' => 'https://youtube.com',
                'github_url' => null,
                'featured' => true,
                'order' => 7,
            ],
        ];

        foreach ($apps as $app) {
            AppGallery::updateOrCreate(
                ['title' => $app['title']],
                $app
            );
        }
    }
}

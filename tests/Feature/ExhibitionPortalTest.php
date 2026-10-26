<?php

namespace Tests\Feature;

use App\Models\AppGallery;
use App\Models\Guestbook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExhibitionPortalTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_renders_successfully_with_app_catalog(): void
    {
        $app = AppGallery::create([
            'title' => 'Sistem Presensi IoT Siswa',
            'student_name' => 'Fulan & Tim RPL',
            'student_class' => 'XII RPL 1',
            'category' => 'Mobile App',
            'description' => 'Aplikasi inovasi presensi berbasis QR code',
            'thumbnail' => 'https://example.com/thumb.jpg',
            'tech_stacks' => ['Flutter', 'Laravel', 'MySQL'],
            'canva_url' => 'https://canva.com/design/test',
            'featured' => true,
            'order' => 1,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Portal Aplikasi Karya Siswa');
        $response->assertSee('SMK Muhammadiyah 1 Bantul');
        $response->assertSee('Isi Buku Tamu');
        $response->assertSee('Sistem Presensi IoT Siswa');
        $response->assertSee('Lihat Presentasi');
        $response->assertSee($app->canva_url);
    }

    public function test_karya_detail_page_renders_with_gallery_images(): void
    {
        $app = AppGallery::create([
            'title' => 'Mesin CNC Router 3-Axis',
            'student_name' => 'Wisnu Pamungkas',
            'student_class' => 'XII TPM 1',
            'jurusan' => 'TPM',
            'category' => 'TPM',
            'description' => 'Inovasi mesin CNC router untuk ukir akrilik dan plakat kayu presisi tinggi.',
            'thumbnail' => 'https://example.com/thumb-cnc.jpg',
            'images' => [
                'https://example.com/cnc-part-1.jpg',
                'https://example.com/cnc-part-2.jpg',
            ],
            'tech_stacks' => ['GRBL', 'Stepper NEMA 23'],
            'canva_url' => 'https://canva.com/design/cnc-router',
            'featured' => true,
            'order' => 1,
        ]);

        $response = $this->get('/karya/' . $app->id);

        $response->assertStatus(200);
        $response->assertSee('Mesin CNC Router 3-Axis');
        $response->assertSee('Wisnu Pamungkas');
        $response->assertSee('XII TPM 1');
        $response->assertSee('Teknik Pemesinan');
        $response->assertSee('Buka Slide Canva');
        $response->assertSee('https://example.com/cnc-part-1.jpg');
    }

    public function test_jurusan_filter_filters_karya_correctly(): void
    {
        AppGallery::create([
            'title' => 'Sistem Kelistrikan Mobil EFI',
            'student_name' => 'Fajar Santoso',
            'student_class' => 'XII TKR',
            'jurusan' => 'TKR',
            'category' => 'TKR',
            'description' => 'Simulator trainer kelistrikan mobil',
            'thumbnail' => 'https://example.com/tkr.jpg',
            'tech_stacks' => ['OBD-II'],
            'canva_url' => 'https://canva.com/test',
        ]);

        AppGallery::create([
            'title' => 'Game Edukasi Aksara Jawa',
            'student_name' => 'Bayu Aji',
            'student_class' => 'XI PPLG',
            'jurusan' => 'PPLG',
            'category' => 'PPLG',
            'description' => 'Game 2D platformer aksara',
            'thumbnail' => 'https://example.com/pplg.jpg',
            'tech_stacks' => ['Unity'],
            'canva_url' => 'https://canva.com/test',
        ]);

        $responseTkr = $this->get('/?jurusan=TKR');
        $responseTkr->assertStatus(200);
        $responseTkr->assertSee('Sistem Kelistrikan Mobil EFI');
        $responseTkr->assertDontSee('Game Edukasi Aksara Jawa');

        $responsePplg = $this->get('/?jurusan=PPLG');
        $responsePplg->assertStatus(200);
        $responsePplg->assertSee('Game Edukasi Aksara Jawa');
        $responsePplg->assertDontSee('Sistem Kelistrikan Mobil EFI');
    }

    public function test_guestbook_page_renders_successfully(): void
    {
        $response = $this->get('/buku-tamu');

        $response->assertStatus(200);
        $response->assertSee('Buku Tamu');
        $response->assertSee('Selfie Pengunjung');
        $response->assertSee('Nama Lengkap');
        $response->assertSee('Instansi');
    }

    public function test_guestbook_can_be_stored_via_ajax_with_base64_selfie(): void
    {
        Storage::fake('public');

        // 1x1 transparent png base64
        $fakeBase64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==';

        $payload = [
            'name' => 'Drs. H. Ahmad Dahlan',
            'institution' => 'Majelis Dikdasmen Bantul',
            'message' => 'Karya yang sangat luar biasa dan membanggakan persyarikatan!',
            'rating' => 5,
            'selfie_image' => $fakeBase64,
        ];

        $response = $this->postJson('/buku-tamu', $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('guestbooks', [
            'name' => 'Drs. H. Ahmad Dahlan',
            'institution' => 'Majelis Dikdasmen Bantul',
            'rating' => 5,
        ]);

        $entry = Guestbook::first();
        $this->assertNotNull($entry->selfie_path);
        Storage::disk('public')->assertExists($entry->selfie_path);
    }

    public function test_guestbook_can_be_stored_with_uploaded_file(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('selfie.jpg', 600, 600);

        $payload = [
            'name' => 'Dewi Lestari',
            'institution' => 'DUDI Mitra Industri',
            'message' => 'Tertarik untuk merekrut siswa lulusan RPL Musaba.',
            'rating' => 5,
            'selfie_file' => $file,
        ];

        $response = $this->post('/buku-tamu', $payload);

        $response->assertRedirect('/buku-tamu');
        $this->assertDatabaseHas('guestbooks', [
            'name' => 'Dewi Lestari',
        ]);
    }
}

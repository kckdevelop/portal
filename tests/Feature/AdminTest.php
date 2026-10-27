<?php

namespace Tests\Feature;

use App\Models\AppGallery;
use App\Models\Guestbook;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('Portal Admin Expo');
    }

    public function test_unauthenticated_user_is_redirected_to_admin_login(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');

        $responseDashboard = $this->get('/admin/dashboard');
        $responseDashboard->assertRedirect('/admin/login');
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $user = User::first();
        $this->assertNotNull($user);

        $response = $this->post('/admin/login', [
            'email' => $user->email,
            'password' => 'admin123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_admin_can_access_dashboard(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Ringkasan Dashboard');
    }

    public function test_admin_can_update_settings(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->post('/admin/settings', [
            'school_name' => 'SMK Muhammadiyah 1 Bantul (Musaba)',
            'portal_title' => 'Portal Karya Siswa RPL',
            'event_name' => 'Expo 2026',
            'header_subtitle' => 'Pameran Aplikasi Unggulan',
        ]);

        $response->assertRedirect(route('admin.settings.index'));
        $this->assertEquals('SMK Muhammadiyah 1 Bantul (Musaba)', Setting::get('school_name'));
        $this->assertEquals('Portal Karya Siswa RPL', Setting::get('portal_title'));
    }

    public function test_admin_can_create_karya_siswa(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->post('/admin/karya', [
            'title' => 'Smart IoT Garden',
            'student_name' => 'Andi Wijaya',
            'student_class' => 'XII RPL 2',
            'category' => 'IoT & Robotics',
            'description' => 'Sistem penyiraman otomatis berbasis sensor kelembaban tanah.',
            'tech_stacks' => 'Arduino, Laravel, MQTT',
            'demo_url' => 'https://iot.musaba.sch.id',
            'github_url' => 'https://github.com/musaba/smart-garden',
            'featured' => 1,
            'order' => 1,
        ]);

        $response->assertRedirect(route('admin.karya.index'));
        $this->assertDatabaseHas('app_galleries', [
            'title' => 'Smart IoT Garden',
            'student_name' => 'Andi Wijaya',
        ]);
    }

    public function test_admin_can_toggle_guestbook_approval(): void
    {
        $user = User::first();
        $guestbook = Guestbook::first();
        $this->assertNotNull($guestbook);

        $initialStatus = $guestbook->is_approved;

        $response = $this->actingAs($user)->post("/admin/buku-tamu/{$guestbook->id}/toggle-approval");
        $response->assertStatus(302);

        $guestbook->refresh();
        $this->assertNotEquals($initialStatus, $guestbook->is_approved);
    }
}

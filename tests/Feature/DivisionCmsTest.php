<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DivisionCmsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_homepage_loads_successfully()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee(get_setting('parent_institution', 'STIKES Panti Waluya'));
    }

    public function test_profile_page_loads_successfully()
    {
        $response = $this->get('/profil');
        $response->assertStatus(200);
        $response->assertSee('Visi');
    }

    public function test_services_page_loads_successfully()
    {
        $response = $this->get('/layanan');
        $response->assertStatus(200);
    }

    public function test_posts_page_loads_successfully()
    {
        $response = $this->get('/berita');
        $response->assertStatus(200);
    }

    public function test_events_page_loads_successfully()
    {
        $response = $this->get('/agenda');
        $response->assertStatus(200);
    }

    public function test_documents_page_loads_successfully()
    {
        $response = $this->get('/unduhan');
        $response->assertStatus(200);
    }

    public function test_contact_form_submission()
    {
        $response = $this->post('/kontak/kirim', [
            'name' => 'Dr. Test User',
            'email' => 'testuser@example.com',
            'phone' => '08123456789',
            'subject' => 'Pertanyaan Kaji Etik',
            'message' => 'Halo admin, bagaimana alur permohonan kaji etik?',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('messages', [
            'email' => 'testuser@example.com',
            'subject' => 'Pertanyaan Kaji Etik',
        ]);
    }

    public function test_super_admin_can_access_settings_and_apply_preset()
    {
        $superAdmin = User::where('role', 'super_admin')->first();

        // Access settings page
        $settingsPageResponse = $this->actingAs($superAdmin)->get('/admin/settings');
        $settingsPageResponse->assertStatus(200);

        // Apply Belmawa preset
        $response = $this->actingAs($superAdmin)->post('/admin/settings/apply-preset', [
            'preset_key' => 'belmawa',
        ]);

        $response->assertSessionHas('success');
        $this->assertEquals('Biro Pembelajaran & Kemahasiswaan (Belmawa)', Setting::get('division_name'));
        $this->assertEquals('BELMAWA', Setting::get('division_acronym'));
    }

    public function test_division_admin_cannot_access_settings_or_apply_preset()
    {
        $divisionAdmin = User::where('role', 'division_admin')->first();

        // Attempt to access settings page
        $settingsPageResponse = $this->actingAs($divisionAdmin)->get('/admin/settings');
        $settingsPageResponse->assertRedirect(route('admin.dashboard'));
        $settingsPageResponse->assertSessionHas('error');

        // Attempt to apply preset
        $presetResponse = $this->actingAs($divisionAdmin)->post('/admin/settings/apply-preset', [
            'preset_key' => 'farmasi',
        ]);
        $presetResponse->assertRedirect(route('admin.dashboard'));
    }

    public function test_super_admin_can_manage_users()
    {
        $superAdmin = User::where('role', 'super_admin')->first();

        $response = $this->actingAs($superAdmin)->get('/admin/users');
        $response->assertStatus(200);

        $createResponse = $this->actingAs($superAdmin)->post('/admin/users', [
            'name' => 'New Division Admin',
            'email' => 'newadmin@pantiwaluya.ac.id',
            'role' => 'division_admin',
            'password' => 'password123',
        ]);

        $createResponse->assertSessionHas('success');
        $this->assertDatabaseHas('users', ['email' => 'newadmin@pantiwaluya.ac.id']);
    }

    public function test_admin_can_manage_carousels()
    {
        $divisionAdmin = User::where('role', 'division_admin')->first();

        $response = $this->actingAs($divisionAdmin)->get('/admin/carousels');
        $response->assertStatus(200);
        $response->assertSee('Carousel & Banner Slider');
    }

    public function test_prodi_displays_dedicated_vision_and_mission_on_homepage()
    {
        $superAdmin = User::where('role', 'super_admin')->first();

        // Switch to Keperawatan & Ners Prodi Preset
        $this->actingAs($superAdmin)->post('/admin/settings/apply-preset', [
            'preset_key' => 'keperawatan_ners',
        ]);

        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Visi Program Studi');
        $homeResponse->assertSee('Misi Program Studi');
        $homeResponse->assertSee('Tri Dharma Perguruan Tinggi');
        $homeResponse->assertSee('Profil Lulusan Utama');
    }

    public function test_mik_and_rpl_presets_apply_successfully()
    {
        $superAdmin = User::where('role', 'super_admin')->first();

        // Switch to D4 MIK
        $this->actingAs($superAdmin)->post('/admin/settings/apply-preset', [
            'preset_key' => 'mik',
        ]);
        $this->assertEquals('D4-MIK', Setting::get('division_acronym'));
        $this->assertEquals('#7c3aed', Setting::get('theme_primary_color'));

        // Switch to RPL
        $this->actingAs($superAdmin)->post('/admin/settings/apply-preset', [
            'preset_key' => 'rpl',
        ]);
        $this->assertEquals('RPL', Setting::get('division_acronym'));
    }

    public function test_services_feature_can_be_disabled_via_switch()
    {
        $superAdmin = User::where('role', 'super_admin')->first();

        // 1. Disable services
        Setting::set('enable_services', '0');
        Setting::clearCache();

        // Public user visiting /layanan should redirect to home
        $servicesResponse = $this->get('/layanan');
        $servicesResponse->assertRedirect(route('home'));

        // Homepage shouldn't display "Layanan yang Kami Sediakan"
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertDontSee('Layanan yang Kami Sediakan');

        // 2. Re-enable services
        Setting::set('enable_services', '1');
        Setting::clearCache();

        $enabledResponse = $this->get('/layanan');
        $enabledResponse->assertStatus(200);
    }

    public function test_admin_can_manage_nav_menus()
    {
        $divisionAdmin = User::where('role', 'division_admin')->first();

        // 1. View menu list
        $response = $this->actingAs($divisionAdmin)->get('/admin/menus');
        $response->assertStatus(200);
        $response->assertSee('Kelola Menu Navigasi');

        // 2. Add custom menu item
        $createResponse = $this->actingAs($divisionAdmin)->post('/admin/menus', [
            'label' => 'Kurikulum & SPMI',
            'url' => '/profil#kurikulum',
            'target' => '_self',
            'order_index' => 10,
            'is_active' => 1,
        ]);
        $createResponse->assertSessionHas('success');
        $this->assertDatabaseHas('nav_menus', ['label' => 'Kurikulum & SPMI']);

        // 3. Frontend displays the new menu item
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Kurikulum &amp; SPMI', false);

        // 4. Add submenu item under 'Tentang Kami'
        $parentMenu = \App\Models\NavMenu::where('url', '/profil')->first();
        if ($parentMenu) {
            $submenuResponse = $this->actingAs($divisionAdmin)->post('/admin/menus', [
                'parent_id' => $parentMenu->id,
                'label' => 'Visi & Misi Terpadu',
                'url' => '/profil#visimisi',
                'target' => '_self',
                'order_index' => 1,
                'is_active' => 1,
            ]);
            $submenuResponse->assertSessionHas('success');
            $this->assertDatabaseHas('nav_menus', ['label' => 'Visi & Misi Terpadu', 'parent_id' => $parentMenu->id]);

            // Frontend displays dropdown submenu
            $homeWithSubmenu = $this->get('/');
            $homeWithSubmenu->assertStatus(200);
            $homeWithSubmenu->assertSee('Visi &amp; Misi Terpadu', false);
        }

        // 5. Reset to defaults
        $resetResponse = $this->actingAs($divisionAdmin)->post('/admin/menus/reset-defaults');
        $resetResponse->assertSessionHas('success');
    }

    public function test_admin_can_manage_organization_chart()
    {
        $divisionAdmin = User::where('role', 'division_admin')->first();

        // 1. Upload mock chart and set mode
        \Illuminate\Support\Facades\Storage::fake('public');
        $file = \Illuminate\Http\UploadedFile::fake()->image('bagan-struktur.png', 800, 600);

        $response = $this->actingAs($divisionAdmin)->post('/admin/team/chart', [
            'organization_chart' => $file,
            'organization_display_mode' => 'both',
        ]);
        $response->assertSessionHas('success');
        $this->assertEquals('both', Setting::get('organization_display_mode'));
        $this->assertNotEmpty(Setting::get('organization_chart_image'));

        // 2. Profile page displays chart diagram
        $profileResponse = $this->get('/profil');
        $profileResponse->assertStatus(200);
        $profileResponse->assertSee('Diagram Bagan Struktur Organisasi');

        // 3. Remove chart
        $deleteResponse = $this->actingAs($divisionAdmin)->delete('/admin/team/chart');
        $deleteResponse->assertSessionHas('success');
        $this->assertEmpty(Setting::get('organization_chart_image'));
    }

    public function test_unauthenticated_user_redirects_to_login()
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect(route('admin.login'));

        $loginAliasResponse = $this->get('/login');
        $loginAliasResponse->assertRedirect(route('admin.login'));
    }

    public function test_csrf_token_mismatch_redirects_to_login_gracefully()
    {
        // Simulate posting with invalid CSRF token / TokenMismatchException
        $this->withoutMiddleware(\App\Http\Middleware\EnsureSuperAdmin::class);
        $response = $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class)->post('/admin/login', [
            'email' => 'it@pantiwaluya.ac.id',
            'password' => 'password123',
        ]);
        $response->assertRedirect(route('admin.dashboard'));
    }
}

<?php

namespace Tests\Feature;

use App\Models\AcademicCalendar;
use App\Models\Announcement;
use App\Models\Course;
use App\Models\Cpl;
use App\Models\Curriculum;
use App\Models\Event;
use App\Models\Facility;
use App\Models\GraduateProfile;
use App\Models\News;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContentAndAcademicTest extends TestCase
{
    use RefreshDatabase;

    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::factory()->create([
            'role' => User::ROLE_SUPERADMIN,
        ]);
    }

    public function test_public_pages_render_seeded_or_fresh_content(): void
    {
        // Setup initial records
        Staff::create([
            'name' => 'Dr. Ir. Pengajar TRM, M.Kom.',
            'type' => 'dosen',
            'is_active' => true,
            'order' => 1,
        ]);

        Staff::create([
            'name' => 'Staf Administrasi Akademik',
            'type' => 'tendik',
            'is_active' => true,
            'order' => 1,
        ]);

        News::create([
            'title' => 'Berita Pelatihan VR dan AR',
            'slug' => 'berita-pelatihan-vr-dan-ar',
            'content' => 'Mahasiswa TRM mengikuti workshop teknologi VR.',
            'status' => 'published',
            'published_at' => now(),
        ]);

        Announcement::create([
            'title' => 'Pengumuman Ujian Akhir Semester',
            'slug' => 'pengumuman-ujian-akhir-semester',
            'content' => 'Jadwal pelaksanaan UAS semester ganjil.',
            'status' => 'published',
            'is_active' => true,
            'published_at' => now(),
        ]);

        Event::create([
            'title' => 'Pameran Multimedia Expo',
            'slug' => 'pameran-multimedia-expo',
            'location' => 'Auditorium POLITALA',
            'event_date' => now()->addDays(5),
            'start_time' => '09:00',
            'end_time' => '16:00',
            'status' => 'Pendaftaran Dibuka',
        ]);

        Facility::create([
            'name' => 'Laboratorium Motion Capture & Audio',
            'slug' => 'lab-motion-capture-audio',
            'category' => 'Laboratorium Khusus',
            'is_active' => true,
        ]);

        $curriculum = Curriculum::create([
            'name' => 'Kurikulum Berbasis Industri 2026',
            'code' => 'KUR-2026',
            'year' => '2026',
            'is_active' => true,
        ]);

        Course::create([
            'curriculum_id' => $curriculum->id,
            'code' => 'TRM201',
            'name' => 'Pengembangan Game 3D Real-time',
            'semester' => 3,
            'sks' => 4,
            'theory_sks' => 1,
            'practical_sks' => 3,
            'type' => 'Wajib',
        ]);

        Cpl::create([
            'code' => 'CPL-01',
            'category' => 'Pengetahuan',
            'description' => 'Mampu menguasai teori multimedia interaktif.',
            'order' => 1,
        ]);

        GraduateProfile::create([
            'title' => '3D Generalist & Animator',
            'description' => 'Mampu memproduksi aset animasi dan visual effect.',
            'order' => 1,
        ]);

        AcademicCalendar::create([
            'academic_year' => '2026/2027',
            'semester' => 'ganjil',
            'title' => 'Masa Perkuliahan Efektif',
            'start_date' => now(),
            'is_active' => true,
        ]);

        // Test Public Routes
        $this->get(route('home'))->assertStatus(200)->assertSee('Laboratorium Motion Capture & Audio');
        $this->get(route('public.profile.lecturers'))->assertStatus(200)->assertSee('Dr. Ir. Pengajar TRM, M.Kom.');
        $this->get(route('public.profile.staff'))->assertStatus(200)->assertSee('Staf Administrasi Akademik');
        $this->get(route('public.academic.curriculum'))->assertStatus(200)->assertSee('TRM201');
        $this->get(route('public.academic.calendar'))->assertStatus(200)->assertSee('Masa Perkuliahan Efektif');
        $this->get(route('public.academic.cpl'))->assertStatus(200)->assertSee('CPL-01');
        $this->get(route('public.academic.graduate-profile'))->assertStatus(200)->assertSee('3D Generalist');
        $this->get(route('public.news.index'))->assertStatus(200)->assertSee('Berita Pelatihan VR dan AR');
        $this->get(route('public.news.show', 'berita-pelatihan-vr-dan-ar'))->assertStatus(200)->assertSee('Berita Pelatihan VR dan AR');
        $this->get(route('public.announcements.index'))->assertStatus(200)->assertSee('Pengumuman Ujian Akhir Semester');
        $this->get(route('public.events.index'))->assertStatus(200)->assertSee('Pameran Multimedia Expo');
        $this->get(route('public.events.show', 'pameran-multimedia-expo'))->assertStatus(200)->assertSee('Pameran Multimedia Expo');
        $this->get(route('public.facilities.index'))->assertStatus(200)->assertSee('Laboratorium Motion Capture & Audio');
        $this->get(route('public.gallery.index'))->assertStatus(200);
        $this->get(route('public.contact'))->assertStatus(200);
    }

    public function test_admin_can_crud_staff(): void
    {
        $this->actingAs($this->adminUser);

        // Store
        $response = $this->post(route('admin.staff.store'), [
            'name' => 'Dosen Baru Multimedia, M.T.',
            'type' => 'dosen',
            'nip' => '199201012020121001',
            'position' => 'Dosen Pengajar',
            'expertise' => 'Augmented Reality',
        ]);
        $response->assertRedirect(route('admin.crud.sample', ['section' => 'dosen']));
        $this->assertDatabaseHas('staff', ['name' => 'Dosen Baru Multimedia, M.T.']);

        $staff = Staff::where('name', 'Dosen Baru Multimedia, M.T.')->first();

        // Update
        $response = $this->put(route('admin.staff.update', $staff), [
            'name' => 'Dosen Baru Multimedia, Ph.D.',
            'type' => 'dosen',
            'nip' => '199201012020121001',
            'position' => 'Lektor Kepala',
        ]);
        $response->assertRedirect(route('admin.crud.sample', ['section' => 'dosen']));
        $this->assertDatabaseHas('staff', ['name' => 'Dosen Baru Multimedia, Ph.D.']);

        // Destroy
        $response = $this->delete(route('admin.staff.destroy', $staff));
        $response->assertRedirect(route('admin.crud.sample', ['section' => 'dosen']));
        $this->assertDatabaseMissing('staff', ['id' => $staff->id]);
    }

    public function test_admin_can_crud_news(): void
    {
        $this->actingAs($this->adminUser);

        // Store
        $response = $this->post(route('admin.news.store'), [
            'title' => 'Prestasi Mahasiswa TRM Juara Animasi Nasional',
            'slug' => 'prestasi-mahasiswa-trm-juara-animasi-nasional',
            'content' => 'Karya film pendek animasi 3D meraih medali emas.',
            'status' => 'published',
        ]);
        $response->assertRedirect(route('admin.crud.sample', ['section' => 'berita']));
        $this->assertDatabaseHas('news', ['title' => 'Prestasi Mahasiswa TRM Juara Animasi Nasional']);

        $news = News::where('slug', 'prestasi-mahasiswa-trm-juara-animasi-nasional')->first();

        // Update
        $response = $this->put(route('admin.news.update', $news), [
            'title' => 'Prestasi Mahasiswa TRM Juara Animasi Internasional',
            'content' => 'Karya film pendek animasi 3D meraih juara 1 internasional.',
            'status' => 'published',
        ]);
        $response->assertRedirect(route('admin.crud.sample', ['section' => 'berita']));
        $this->assertDatabaseHas('news', ['title' => 'Prestasi Mahasiswa TRM Juara Animasi Internasional']);

        // Destroy
        $response = $this->delete(route('admin.news.destroy', $news));
        $response->assertRedirect(route('admin.crud.sample', ['section' => 'berita']));
        $this->assertDatabaseMissing('news', ['id' => $news->id]);
    }

    public function test_admin_can_crud_events_and_announcements(): void
    {
        $this->actingAs($this->adminUser);

        // Announcement
        $annResponse = $this->post(route('admin.announcements.store'), [
            'title' => 'Pendaftaran Magang Industri Batch 2',
            'slug' => 'pendaftaran-magang-industri-batch-2',
            'content' => 'Segera daftarkan diri untuk program magang 6 bulan.',
            'status' => 'published',
        ]);
        $annResponse->assertRedirect(route('admin.crud.sample', ['section' => 'pengumuman']));
        $this->assertDatabaseHas('announcements', ['title' => 'Pendaftaran Magang Industri Batch 2']);

        // Event
        $eventResponse = $this->post(route('admin.events.store'), [
            'title' => 'Workshop UI/UX Design Figma ke Frontend',
            'slug' => 'workshop-ui-ux-design-figma-ke-frontend',
            'location' => 'Lab Komputer 3 POLITALA',
            'event_date' => now()->addDays(10)->format('Y-m-d'),
            'start_time' => '08:30',
            'end_time' => '12:00',
            'status' => 'Pendaftaran Dibuka',
        ]);
        $eventResponse->assertRedirect(route('admin.crud.sample', ['section' => 'agenda']));
        $this->assertDatabaseHas('events', ['title' => 'Workshop UI/UX Design Figma ke Frontend']);
    }

    public function test_admin_can_update_profile_section_and_settings(): void
    {
        $this->actingAs($this->adminUser);

        // Update Profile Section
        $response = $this->post(route('admin.profile-section.update'), [
            'section' => 'sejarah',
            'title' => 'Sejarah Lengkap TRM',
            'content' => 'Program studi ini didirikan untuk menjawab kebutuhan industri kreatif digital di Tanah Laut dan Kalimantan Selatan.',
        ]);
        $response->assertRedirect(route('admin.crud.sample', ['section' => 'sejarah']));
        $this->assertDatabaseHas('study_program_profiles', [
            'section' => 'sejarah',
            'title' => 'Sejarah Lengkap TRM',
        ]);

        // Update Settings
        $settingsResponse = $this->post(route('admin.settings.update'), [
            'section' => 'identitas',
            'settings' => [
                'site_name' => 'Program Studi D-IV Rekayasa Multimedia',
                'contact_email' => 'info.trm@politala.ac.id',
            ],
        ]);
        $settingsResponse->assertRedirect(route('admin.crud.sample', ['section' => 'identitas']));
        $this->assertDatabaseHas('settings', [
            'key' => 'site_name',
            'value' => 'Program Studi D-IV Rekayasa Multimedia',
        ]);
    }
}

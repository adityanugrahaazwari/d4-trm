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
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
        $this->get(route('home'))->assertStatus(200)->assertSee('Laboratorium Motion Capture & Audio')->assertSee('Tonggak Sejarah');
        $this->get(route('public.profile.history'))->assertStatus(200)->assertSee('Sejarah Program Studi')->assertSee('Tonggak Sejarah');
        $this->get(route('public.profile.vision-mission'))->assertStatus(200)->assertSee('Visi, Misi')->assertSee('Misi Program Studi');
        $this->get(route('public.profile.welcome'))->assertStatus(200)->assertSee('Sambutan Ketua Program Studi')->assertSee('Pesan Resmi Pimpinan');
        $this->get(route('public.profile.structure'))->assertStatus(200)->assertSee('Struktur Organisasi')->assertSee('Tata Kelola');
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
        Storage::fake('public');

        // Store Dosen with Photo File
        $photo = UploadedFile::fake()->image('dosen-profil.jpg', 400, 500);
        $response = $this->post(route('admin.staff.store'), [
            'name' => 'Dosen Baru Multimedia, M.T.',
            'type' => 'dosen',
            'nip' => '199201012020121001',
            'nidn' => '1101019201',
            'position' => 'Dosen Pengajar & Tim VR',
            'education' => 'S2 Teknik Informatika - ITB',
            'expertise' => 'Augmented Reality, WebGL',
            'email' => 'dosen.baru@politala.ac.id',
            'phone' => '081234567890',
            'order' => 5,
            'photo_file' => $photo,
        ]);
        $response->assertRedirect(route('admin.crud.sample', ['section' => 'dosen']));
        $this->assertDatabaseHas('staff', [
            'name' => 'Dosen Baru Multimedia, M.T.',
            'type' => 'dosen',
            'education' => 'S2 Teknik Informatika - ITB',
            'order' => 5,
        ]);

        $staff = Staff::where('name', 'Dosen Baru Multimedia, M.T.')->first();
        $this->assertNotNull($staff->photo);

        // Store Tendik
        $tendikResponse = $this->post(route('admin.staff.store'), [
            'name' => 'Budi Santoso, A.Md.',
            'type' => 'tendik',
            'nip' => '199505052021031002',
            'position' => 'Teknisi Studio Audio Spasial',
            'education' => 'D-3 Manajemen Informatika',
            'expertise' => 'Sound Engineering & Studio Setup',
            'email' => 'budi.tendik@politala.ac.id',
            'order' => 1,
        ]);
        $tendikResponse->assertRedirect(route('admin.crud.sample', ['section' => 'tendik']));
        $this->assertDatabaseHas('staff', [
            'name' => 'Budi Santoso, A.Md.',
            'type' => 'tendik',
        ]);

        // Update Dosen
        $response = $this->put(route('admin.staff.update', $staff), [
            'name' => 'Dosen Baru Multimedia, Ph.D.',
            'type' => 'dosen',
            'nip' => '199201012020121001',
            'position' => 'Lektor Kepala',
            'education' => 'S3 Computer Science - Monash University',
            'order' => 2,
        ]);
        $response->assertRedirect(route('admin.crud.sample', ['section' => 'dosen']));
        $this->assertDatabaseHas('staff', [
            'name' => 'Dosen Baru Multimedia, Ph.D.',
            'education' => 'S3 Computer Science - Monash University',
            'order' => 2,
        ]);

        // Test Admin Search
        $this->get(route('admin.crud.sample', ['section' => 'dosen', 'q' => 'Multimedia']))
            ->assertStatus(200)
            ->assertSee('Dosen Baru Multimedia, Ph.D.');

        // Test Public Search for Lecturer
        $this->get(route('public.profile.lecturers', ['q' => 'Multimedia']))
            ->assertStatus(200)
            ->assertSee('Dosen Baru Multimedia, Ph.D.')
            ->assertSee('S3 Computer Science - Monash University');

        // Test Public Search for Tendik
        $this->get(route('public.profile.staff', ['q' => 'Budi']))
            ->assertStatus(200)
            ->assertSee('Budi Santoso, A.Md.')
            ->assertSee('Teknisi Studio Audio Spasial');

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

        // Update Profile Section with Timeline Meta
        $response = $this->post(route('admin.profile-section.update'), [
            'section' => 'sejarah',
            'title' => 'Sejarah Lengkap TRM',
            'content' => 'Program studi ini didirikan untuk menjawab kebutuhan industri kreatif digital di Tanah Laut dan Kalimantan Selatan.',
            'meta' => [
                'established_year' => '2026',
                'timeline' => [
                    [
                        'year' => '2024',
                        'title' => 'Inisiasi Kurikulum TRM',
                        'badge' => 'Awal',
                        'status' => 'completed',
                        'description' => 'Penyusunan kurikulum awal.',
                    ],
                ],
            ],
        ]);
        $response->assertRedirect(route('admin.crud.sample', ['section' => 'sejarah']));
        $this->assertDatabaseHas('study_program_profiles', [
            'section' => 'sejarah',
            'title' => 'Sejarah Lengkap TRM',
        ]);

        $this->get(route('public.profile.history'))->assertStatus(200)->assertSee('Inisiasi Kurikulum TRM');

        // Update Vision Mission Section
        $visiMisiResponse = $this->post(route('admin.profile-section.update'), [
            'section' => 'visi-misi',
            'title' => 'Visi dan Misi Strategis TRM',
            'content' => 'Uraian visi dan misi lengkap...',
            'meta' => [
                'vision_statement' => 'Menjadi pusat unggulan teknologi multimedia 2030.',
                'target_year' => '2030',
                'missions' => [
                    ['number' => 1, 'title' => 'Misi Riset Terapan Inovatif', 'description' => 'Mengembangkan riset terapan.'],
                ],
                'goals' => [
                    ['title' => 'Tujuan Lulusan Bersertifikasi', 'description' => '100% lulusan memiliki sertifikat.'],
                ],
            ],
        ]);
        $visiMisiResponse->assertRedirect(route('admin.crud.sample', ['section' => 'visi-misi']));
        $this->get(route('public.profile.vision-mission'))->assertStatus(200)->assertSee('Misi Riset Terapan Inovatif');

        // Update Sambutan Section with Photo Upload & Key Points
        Storage::fake('public');
        $photoFile = UploadedFile::fake()->image('kaprodi-test.jpg', 600, 800);

        $sambutanResponse = $this->post(route('admin.profile-section.update'), [
            'section' => 'sambutan',
            'title' => 'Sambutan Hangat Koordinator Program Studi',
            'content' => 'Selamat datang di era baru program studi TRM vokasi masa depan.',
            'kaprodi_photo_file' => $photoFile,
            'meta' => [
                'kaprodi_name' => 'Prof. Dr. Ir. Pimpinan TRM, M.Kom.',
                'kaprodi_nip' => '198512122010121001',
                'kaprodi_position' => 'Koordinator Prodi D-IV TRM POLITALA',
                'kaprodi_department' => 'Jurusan Komputer dan Bisnis POLITALA',
                'kaprodi_email' => 'kaprodi.trm@politala.ac.id',
                'period' => '2024 - 2028',
                'greeting' => 'Salam Hangat & Assalamu’alaikum Warahmatullahi Wabarakatuh',
                'quote' => 'Membangun inovator masa depan dalam dunia game dan multimedia interaktif.',
                'closing_greeting' => 'Wassalam & Salam Sukses Mulia.',
                'signature_title' => 'Pimpinan Resmi TRM',
                'key_points' => [
                    [
                        'badge' => 'Fokus Riset',
                        'title' => 'Pusat Inovasi Imersif AR/VR',
                        'description' => 'Mengembangkan aplikasi spasial virtual untuk kebutuhan industri.',
                    ],
                ],
            ],
        ]);
        $sambutanResponse->assertRedirect(route('admin.crud.sample', ['section' => 'sambutan']));

        $this->assertDatabaseHas('study_program_profiles', [
            'section' => 'sambutan',
            'title' => 'Sambutan Hangat Koordinator Program Studi',
        ]);

        $welcomeResponse = $this->get(route('public.profile.welcome'));
        $welcomeResponse->assertStatus(200)
            ->assertSee('Prof. Dr. Ir. Pimpinan TRM, M.Kom.')
            ->assertSee('Membangun inovator masa depan dalam dunia game dan multimedia interaktif.')
            ->assertSee('Pusat Inovasi Imersif AR/VR');

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

    public function test_public_structure_page_renders_tree_and_staff_data(): void
    {
        $kaprodi = Staff::create([
            'name' => 'Dr. H. Rian Hidayat, S.T., M.Kom.',
            'type' => 'dosen',
            'nip_nidn' => '198205142008121003',
            'position' => 'Koordinator Program Studi (Kaprodi) TRM',
            'order' => 1,
            'is_active' => true,
        ]);

        $kalab = Staff::create([
            'name' => 'Fathurrahman, S.Kom., M.Cs.',
            'type' => 'dosen',
            'nip_nidn' => '198709212015041002',
            'position' => 'Kepala Studio & Laboratorium Terpadu',
            'order' => 2,
            'is_active' => true,
        ]);

        $plp = Staff::create([
            'name' => 'Ahmad Fauzi, A.Md.Kom.',
            'type' => 'tendik',
            'nip_nidn' => '199304122020121008',
            'position' => 'Pranata Laboratorium Pendidikan (PLP)',
            'order' => 3,
            'is_active' => true,
        ]);

        $response = $this->get(route('public.profile.structure'));
        $response->assertStatus(200)
            ->assertSee('Struktur Organisasi')
            ->assertSee('Bagan Pohon')
            ->assertSee('Daftar Penugasan')
            ->assertSee('Dr. H. Rian Hidayat, S.T., M.Kom.')
            ->assertSee('Fathurrahman, S.Kom., M.Cs.')
            ->assertSee('Ahmad Fauzi, A.Md.Kom.');
    }

    public function test_admin_can_manage_organizational_structure(): void
    {
        $this->actingAs($this->adminUser);

        $dosenKaprodi = Staff::create([
            'name' => 'Dr. Kaprodi Pilihan, M.T.',
            'type' => 'dosen',
            'nip_nidn' => '198101012005011005',
            'position' => 'Dosen Senior',
            'order' => 1,
            'is_active' => true,
        ]);

        $dosenKalab = Staff::create([
            'name' => 'Dr. Kalab Pilihan, M.Cs.',
            'type' => 'dosen',
            'nip_nidn' => '198602022010121004',
            'position' => 'Dosen Riset',
            'order' => 2,
            'is_active' => true,
        ]);

        $response = $this->post(route('admin.profile-section.update'), [
            'section' => 'struktur',
            'title' => 'Bagan Struktur Tata Kelola TRM',
            'content' => 'Bagan ini disahkan melalui SK Direktur POLITALA tahun 2026.',
            'meta' => [
                'sk_number' => 'SK/POLITALA/TRM/2026/045',
                'academic_year' => '2026/2027',
                'department_head_name' => 'Hj. Agustian Noor, S.Kom., M.Kom.',
                'department_head_nip' => '197908152005011002',
                'gkm_name' => 'Dewi Anggraini, S.T., M.Eng.',
                'gkm_position' => 'Ketua GKM TRM',
                'kaprodi_id' => $dosenKaprodi->id,
                'kalab_id' => $dosenKalab->id,
                'custom_units' => [
                    [
                        'unit' => 'KBK Game & Extended Reality',
                        'leader' => 'Dr. Pengembang Game, M.Kom.',
                        'desc' => 'Fokus pada Game Engine & Spatial Computing.',
                    ],
                ],
            ],
        ]);

        $response->assertRedirect(route('admin.crud.sample', ['section' => 'struktur']));

        $this->assertDatabaseHas('study_program_profiles', [
            'section' => 'struktur',
            'title' => 'Bagan Struktur Tata Kelola TRM',
        ]);

        $publicResponse = $this->get(route('public.profile.structure'));
        $publicResponse->assertStatus(200)
            ->assertSee('Bagan Struktur Tata Kelola TRM')
            ->assertSee('SK/POLITALA/TRM/2026/045')
            ->assertSee('Dr. Kaprodi Pilihan, M.T.')
            ->assertSee('Dr. Kalab Pilihan, M.Cs.')
            ->assertSee('KBK Game')
            ->assertSee('Extended Reality');
    }

    public function test_public_facilities_index_filters_and_searches(): void
    {
        $labVR = Facility::create([
            'name' => 'Laboratorium VR Spasial Canggih',
            'slug' => 'laboratorium-vr-spasial-canggih',
            'category' => 'Laboratorium Komputer',
            'location' => 'Gedung TI Lantai 2 - Ruang 202',
            'description' => 'Fasilitas eksperimen virtual reality dan komputasi spasial imersif.',
            'specifications' => 'Workstation Dual GPU, Meta Quest 3, Vive Pro',
            'software' => 'Unreal Engine 5, Unity Pro, Blender 4',
            'capacity' => 36,
            'is_active' => true,
            'order' => 1,
        ]);

        $studioCinema = Facility::create([
            'name' => 'Studio Cinema & Green Screen 6K',
            'slug' => 'studio-cinema-green-screen-6k',
            'category' => 'Studio Produksi & Cinema',
            'location' => 'Gedung TI Lantai 1 - Ruang 105',
            'description' => 'Studio syuting profesional dengan dinding cyclorama.',
            'specifications' => 'Blackmagic Cinema 6K, Aputure Lighting Set',
            'software' => 'DaVinci Resolve, Premiere Pro',
            'capacity' => 20,
            'is_active' => true,
            'order' => 2,
        ]);

        // Default all
        $this->get(route('public.facilities.index'))
            ->assertStatus(200)
            ->assertSee('Fasilitas & Laboratorium Terpadu')
            ->assertSee('Laboratorium VR Spasial Canggih')
            ->assertSee('Studio Cinema & Green Screen 6K')
            ->assertSee('Unreal Engine 5');

        // Filter by category
        $this->get(route('public.facilities.index', ['category' => 'Studio Produksi & Cinema']))
            ->assertStatus(200)
            ->assertSee('Studio Cinema & Green Screen 6K')
            ->assertDontSee('Laboratorium VR Spasial Canggih');

        // Search by keyword
        $this->get(route('public.facilities.index', ['q' => 'Spasial']))
            ->assertStatus(200)
            ->assertSee('Laboratorium VR Spasial Canggih')
            ->assertDontSee('Studio Cinema & Green Screen 6K');
    }

    public function test_admin_can_crud_facility(): void
    {
        $this->actingAs($this->adminUser);
        Storage::fake('public');

        $imageFile = UploadedFile::fake()->image('lab-foto.jpg', 800, 600);

        // Store
        $response = $this->post(route('admin.facilities.store'), [
            'name' => 'Laboratorium Render Farm & Cloud TRM',
            'slug' => 'laboratorium-render-farm-cloud-trm',
            'category' => 'Sarana Pendukung & Riset',
            'location' => 'Server Room Gedung TI Lantai 2',
            'capacity' => 15,
            'specifications' => 'Rack Server Multi-GPU NVIDIA A5000, 10Gbps Network',
            'software' => 'Deadline Render, Proxmox VE, TrueNAS',
            'description' => 'Klaster render animasi 3D paralel berkecepatan tinggi.',
            'order' => 5,
            'is_active' => 1,
            'image_file' => $imageFile,
        ]);

        $response->assertRedirect(route('admin.crud.sample', ['section' => 'fasilitas']));

        $this->assertDatabaseHas('facilities', [
            'name' => 'Laboratorium Render Farm & Cloud TRM',
            'location' => 'Server Room Gedung TI Lantai 2',
            'capacity' => 15,
            'category' => 'Sarana Pendukung & Riset',
        ]);

        $facility = Facility::where('slug', 'laboratorium-render-farm-cloud-trm')->first();
        $this->assertNotNull($facility);
        $this->assertNotNull($facility->image);
        Storage::disk('public')->assertExists($facility->image);

        // Update
        $updateResponse = $this->put(route('admin.facilities.update', $facility), [
            'name' => 'Laboratorium Render Farm & HPC TRM',
            'category' => 'Sarana Pendukung & Riset',
            'location' => 'Pusat Data Gedung TI',
            'capacity' => 20,
            'specifications' => 'Multi-GPU Cluster Updated',
            'software' => 'Deadline 10, Docker, Linux',
            'order' => 3,
            'is_active' => 1,
        ]);

        $updateResponse->assertRedirect(route('admin.crud.sample', ['section' => 'fasilitas']));

        $this->assertDatabaseHas('facilities', [
            'id' => $facility->id,
            'name' => 'Laboratorium Render Farm & HPC TRM',
            'location' => 'Pusat Data Gedung TI',
            'capacity' => 20,
        ]);

        // Destroy
        $destroyResponse = $this->delete(route('admin.facilities.destroy', $facility));
        $destroyResponse->assertRedirect(route('admin.crud.sample', ['section' => 'fasilitas']));
        $this->assertDatabaseMissing('facilities', ['id' => $facility->id]);
    }
}

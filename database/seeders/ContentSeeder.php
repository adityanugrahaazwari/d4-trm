<?php

namespace Database\Seeders;

use App\Models\AcademicCalendar;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\Course;
use App\Models\Cpl;
use App\Models\Curriculum;
use App\Models\Event;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\GalleryAlbum;
use App\Models\GraduateProfile;
use App\Models\News;
use App\Models\Setting;
use App\Models\Staff;
use App\Models\StudyProgramProfile;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::first();

        // 1. Settings (Tahap 8)
        $settings = [
            ['key' => 'site_name', 'value' => 'D-IV Teknik Rekayasa Multimedia', 'group' => 'identity', 'type' => 'text'],
            ['key' => 'site_tagline', 'value' => 'Pusat Keunggulan Seni Digital & Teknologi Terapan', 'group' => 'identity', 'type' => 'text'],
            ['key' => 'institution_name', 'value' => 'Politeknik Negeri Tanah Laut', 'group' => 'identity', 'type' => 'text'],
            ['key' => 'accreditation', 'value' => 'Baik Sekali (LAM INFOKOM)', 'group' => 'identity', 'type' => 'text'],
            ['key' => 'degree_title', 'value' => 'Sarjana Terapan Komputer (S.Tr.Kom.)', 'group' => 'identity', 'type' => 'text'],
            ['key' => 'contact_email', 'value' => 'trm@politala.ac.id', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'contact_phone', 'value' => '(0512) 2021065', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'contact_address', 'value' => 'Jl. A. Yani Km. 06 Desa Panggung, Kec. Pelaihari, Kab. Tanah Laut, Kalimantan Selatan 70815', 'group' => 'contact', 'type' => 'textarea'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/trm_politala', 'group' => 'social', 'type' => 'text'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/@trmpolitala', 'group' => 'social', 'type' => 'text'],
            ['key' => 'pmb_url', 'value' => 'https://pmb.politala.ac.id', 'group' => 'identity', 'type' => 'text'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], $s);
        }

        // 2. Study Program Profiles (Tahap 8)
        $profiles = [
            [
                'section' => 'sejarah',
                'title' => 'Sejarah Pendirian Program Studi',
                'content' => "Program Studi Sarjana Terapan (D-IV) Teknik Rekayasa Multimedia di Politeknik Negeri Tanah Laut didirikan sebagai inisiatif strategis menjawab percepatan industri kreatif digital, teknologi komputasi interaktif, serta tingginya permintaan talenta profesional di bidang produksi animasi, pengembangan game komersial, dan rekayasa media imersif (AR/VR).\n\nBerakar dari perkembangan Jurusan Komputer dan Bisnis POLITALA, pendirian program studi ini melewati tahapan kajian kelayakan mendalam bersama asosiasi industri kreatif nasional. TRM dirancang dengan kurikulum vokasi modern 70% praktik langsung (hands-on project) yang memadukan keahlian logika pemrograman (Software Engineering) dengan estetika seni digital (Digital Arts & Design).\n\nMelalui SK Resmi Kemendiktisaintek RI, program studi ini resmi dibuka dan beroperasi penuh mempersiapkan Sarjana Terapan Komputer (S.Tr.Kom.) berdaya saing global yang siap memimpin transformasi ekonomi kreatif digital Indonesia.",
                'meta' => [
                    'established_year' => '2026',
                    'sk_number' => 'SK Kemendiktisaintek RI No. 124/D/OT/2026',
                    'degree_title' => 'Sarjana Terapan Komputer (S.Tr.Kom.)',
                    'timeline' => [
                        [
                            'year' => '2024',
                            'title' => 'Inisiasi Pendirian & Analisis Kebutuhan Industri',
                            'badge' => 'Tahap Awal',
                            'status' => 'completed',
                            'description' => 'Pembentukan satuan tugas perumus pendirian prodi dan penyusunan naskah akademik berkolaborasi dengan asosiasi industri game & animasi nasional (AINAKI & AGI) guna merumuskan Profil Lulusan berbasis KKNI Level 6.',
                        ],
                        [
                            'year' => '2025',
                            'title' => 'Pembangunan Laboratorium Studio & Pengajuan Izin',
                            'badge' => 'Infrastruktur',
                            'status' => 'completed',
                            'description' => 'Pengadaan fasilitas workstation grafis berspesifikasi tinggi, pembangunan Studio Motion Capture & Audio Spasial berstandar industri, serta pengajuan resmi berkas perizinan ke kementerian.',
                        ],
                        [
                            'year' => '2026',
                            'title' => 'Penerbitan SK Resmi & Penerimaan Angkatan Perdana',
                            'badge' => 'Operasional Resmi',
                            'status' => 'current',
                            'description' => 'Diterbitkannya SK Izin Operasional resmi Program Studi D-IV TRM POLITALA dan dibukanya pendaftaran mahasiswa baru angkatan perdana melalui jalur seleksi nasional SNBP, SNBT, dan Jalur Mandiri POLITALA.',
                        ],
                        [
                            'year' => '2027+',
                            'title' => 'Ekspansi Inkubator Game, Render Farm & Akreditasi Unggul',
                            'badge' => 'Akselerasi Masa Depan',
                            'status' => 'upcoming',
                            'description' => 'Realisasi Teaching Factory komersial terpadu, render farm mandiri, hilirisasi karya game & film animasi mahasiswa ke pasar global, serta pemantapan akreditasi prodi berpredikat Unggul.',
                        ],
                    ],
                ],
            ],
            [
                'section' => 'visi_misi',
                'title' => 'Visi & Misi Program Studi',
                'content' => 'Visi: Menjadi program studi terkemuka dalam bidang rekayasa multimedia yang menghasilkan sarjana terapan unggul, inovatif, dan berjiwa wirausaha di tingkat nasional dan internasional pada tahun 2030.\n\nMisi:\n1. Menyelenggarakan pendidikan vokasi terapan berstandar industri dengan kurikulum berbasis proyek pada domain game, animasi, dan teknologi imersif.\n2. Mengembangkan penelitian terapan dan karya rekayasa multimedia yang bermanfaat bagi masyarakat dan industri.\n3. Membangun jejaring kemitraan strategis dengan studio game, rumah produksi animasi, dan industri teknologi multimedia berskala nasional.',
            ],
            [
                'section' => 'sambutan',
                'title' => 'Sambutan Ketua Program Studi',
                'content' => 'Selamat datang di portal resmi Program Studi Sarjana Terapan Teknik Rekayasa Multimedia (D-IV TRM) Politeknik Negeri Tanah Laut. Di era revolusi teknologi imersif, kami berkomitmen mencetak praktisi terampil yang siap berkiprah sebagai Technical Artist, Game Programmer, 3D Animator, dan XR Developer yang berdaya saing global.',
            ],
            [
                'section' => 'struktur',
                'title' => 'Struktur Organisasi Program Studi',
                'content' => 'Kepemimpinan program studi didukung oleh Koordinator Program Studi, Kepala Laboratorium Studio Multimedia, Koordinator Kurikulum & Akademik, Kelompok Bidang Keahlian (KBK) Game & Animasi, serta Pembina Kemahasiswaan & Kerjasama Industri.',
            ],
        ];

        foreach ($profiles as $p) {
            StudyProgramProfile::updateOrCreate(
                ['section' => $p['section']],
                array_merge($p, ['updated_by' => $superadmin?->id])
            );
        }

        // 3. Staff & Lecturers (Tahap 8)
        $staffData = [
            [
                'name' => 'Dr. H. Rian Hidayat, M.Kom.',
                'type' => 'dosen',
                'nip_nidn' => '198504122014041001',
                'position' => 'Koordinator Program Studi / Lektor',
                'expertise' => 'Game Engine Architecture, Virtual Reality, Interactive Media',
                'education' => 'S3 Ilmu Komputer - Universitas Gadjah Mada',
                'email' => 'rian.hidayat@politala.ac.id',
                'order' => 1,
            ],
            [
                'name' => 'Fathurrahman, M.Sn.',
                'type' => 'dosen',
                'nip_nidn' => '198906232018031002',
                'position' => 'Kepala Studio Animasi & Motion Capture',
                'expertise' => '3D Animation Pipeline, Character Rigging, Digital Sculpting',
                'education' => 'S2 Desain Komunikasi Visual - Institut Seni Indonesia Yogyakarta',
                'email' => 'fathurrahman@politala.ac.id',
                'order' => 2,
            ],
            [
                'name' => 'Siti Nur Aisyah, M.T.',
                'type' => 'dosen',
                'nip_nidn' => '199201152020122003',
                'position' => 'Dosen Pengajar / Koordinator MBKM',
                'expertise' => 'Web Multimedia Engineering, UI/UX Interaction, Computer Graphics',
                'education' => 'S2 Teknik Informatika - Institut Teknologi Sepuluh Nopember',
                'email' => 'siti.aisyah@politala.ac.id',
                'order' => 3,
            ],
            [
                'name' => 'Bambang Trianto, S.Kom., M.Cs.',
                'type' => 'dosen',
                'nip_nidn' => '199008102019031004',
                'position' => 'Dosen Pengajar / Pembina Studio Game',
                'expertise' => 'Game Programming (Unreal/Unity), Shader Programming, AI in Games',
                'education' => 'S2 Computer Science - Universitas Gadjah Mada',
                'email' => 'bambang.trianto@politala.ac.id',
                'order' => 4,
            ],
            [
                'name' => 'Ahmad Fauzi, A.Md.Kom.',
                'type' => 'tendik',
                'nip_nidn' => '199411052022031005',
                'position' => 'Pranata Laboratorium Pendidikan (PLP)',
                'expertise' => 'Manajemen Server Render Farm, Perawatan Hardware Studio & Audio MoCap',
                'education' => 'D-III Manajemen Informatika',
                'email' => 'fauzi.plp@politala.ac.id',
                'order' => 5,
            ],
            [
                'name' => 'Dewi Anggraini, S.AP.',
                'type' => 'tendik',
                'nip_nidn' => '199603182023012006',
                'position' => 'Staf Administrasi & Layanan Akademik',
                'expertise' => 'Administrasi Akademik, Pengarsipan MBKM, dan Layanan Mahasiswa',
                'education' => 'S1 Administrasi Publik',
                'email' => 'dewi.admin@politala.ac.id',
                'order' => 6,
            ],
        ];

        foreach ($staffData as $s) {
            Staff::updateOrCreate(['name' => $s['name']], $s);
        }

        // 4. Categories & News (Tahap 8)
        $catPrestasi = Category::updateOrCreate(['slug' => 'prestasi'], ['name' => 'Prestasi', 'description' => 'Pencapaian dan penghargaan mahasiswa & dosen']);
        $catIndustri = Category::updateOrCreate(['slug' => 'kerjasama'], ['name' => 'Kerjasama Industri', 'description' => 'Kemitraan studio game & animasi']);
        $catAkademik = Category::updateOrCreate(['slug' => 'akademik'], ['name' => 'Akademik', 'description' => 'Kegiatan perkuliahan dan inovasi kurikulum']);

        $newsData = [
            [
                'title' => 'D-IV TRM POLITALA Jalin Kerjasama dengan Studio Game Nasional',
                'slug' => 'd4-trm-politala-jalin-kerjasama-dengan-studio-game-nasional',
                'category_id' => $catIndustri->id,
                'user_id' => $superadmin?->id,
                'excerpt' => 'Peningkatan kapasitas mahasiswa melalui magang bersertifikat dan transfer teknologi pipeline produksi game komersial.',
                'content' => 'Program Studi Sarjana Terapan Teknik Rekayasa Multimedia (TRM) Politeknik Negeri Tanah Laut resmi menandatangani nota kesepahaman (MoU) dengan studio pengembangan game nasional terkemuka. Kolaborasi ini mencakup penyelarasan kurikulum berbasis standar industri, program magang intensif selama 1 tahun, serta kuliah tamu oleh para technical artist dan lead programmer industri game.',
                'status' => 'published',
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Mahasiswa TRM Raih Medali Perak Kategori 3D Animation di Kompetisi Vokasi Nasional',
                'slug' => 'mahasiswa-trm-raih-medali-perak-kategori-3d-animation-di-kompetisi-vokasi-nasional',
                'category_id' => $catPrestasi->id,
                'user_id' => $superadmin?->id,
                'excerpt' => 'Karya animasi pendek bertema budaya lokal berhasil memikat para juri praktisi industri perfilman.',
                'content' => 'Tim mahasiswa D-IV TRM berhasil menorehkan prestasi gemilang dengan meraih Medali Perak dalam ajang Olimpiade Vokasi Nasional. Mengusung film animasi 3D berdurasi 4 menit dengan kualitas tata cahaya dan karakter rigging berstandar layar lebar, karya mahasiswa POLITALA menuai apresiasi tinggi dari para juri praktisi.',
                'status' => 'published',
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Kuliah Tamu: Pemanfaatan Unreal Engine 5 untuk Rekayasa Simulasi Virtual Reality',
                'slug' => 'kuliah-tamu-pemanfaatan-unreal-engine-5-untuk-rekayasa-simulasi-virtual-reality',
                'category_id' => $catAkademik->id,
                'user_id' => $superadmin?->id,
                'excerpt' => 'Menghadirkan Technical Director dari industri kreatif untuk berbagi pengalaman implementasi Lumen dan Nanite.',
                'content' => 'Guna memperdalam wawasan mahasiswa mengenai rendering grafis real-time generasi terkini, Program Studi TRM mengadakan kuliah tamu bertajuk Pemanfaatan Unreal Engine 5 untuk Rekayasa Simulasi Interaktif. Acara dihadiri oleh seluruh mahasiswa semester 2 hingga 6 secara antusias di Studio Multimedia POLITALA.',
                'status' => 'published',
                'published_at' => now()->subDays(12),
            ],
        ];

        foreach ($newsData as $n) {
            News::updateOrCreate(['slug' => $n['slug']], $n);
        }

        // 5. Announcements & Events (Tahap 8)
        $announcementsData = [
            [
                'title' => 'Pendaftaran Ujian Sidang Skripsi & Tugas Akhir Terapan Gelombang II',
                'slug' => 'pendaftaran-ujian-sidang-skripsi-tugas-akhir-terapan-gelombang-ii',
                'user_id' => $superadmin?->id,
                'content' => 'Diumumkan kepada seluruh mahasiswa semester VIII Program Studi D-IV TRM, pendaftaran ujian sidang skripsi dan proyek karya akhir terapan gelombang II telah dibuka mulai tanggal 10 hingga 20 November 2026 melalui sistem informasi akademik.',
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Sosialisasi Program Magang MBKM Industri Game & Studio Animasi 2027',
                'slug' => 'sosialisasi-program-magang-mbkm-industri-game-studio-animasi-2027',
                'user_id' => $superadmin?->id,
                'content' => 'Bagi mahasiswa semester V dan VI yang berminat mengikuti program Magang Studi Independen Bersertifikat (MSIB) di mitra industri D-IV TRM, sosialisasi teknis seleksi berkas portofolio akan dilaksanakan pada hari Jumat via hybrid meeting.',
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ],
        ];

        foreach ($announcementsData as $a) {
            Announcement::updateOrCreate(['slug' => $a['slug']], $a);
        }

        $eventsData = [
            [
                'title' => 'Kuliah Pakar: Pipeline Animasi 3D Studio Hollywood',
                'slug' => 'kuliah-pakar-pipeline-animasi-3d-studio-hollywood',
                'description' => 'Workshop komprehensif mengupas alur produksi visual effects (VFX) dan animasi karakter 3D berstandar internasional bersama Senior Rigger & Animator studio global.',
                'location' => 'Auditorium Terpadu Lantai 3 POLITALA',
                'event_date' => now()->addDays(14)->toDateString(),
                'start_time' => '09:00',
                'end_time' => '15:30',
                'speaker' => 'Budi Santoso (Lead 3D Animator)',
                'registration_url' => 'https://bit.ly/workshop-trm-hollywood',
                'status' => 'published',
            ],
            [
                'title' => 'TRM Game & Interactive Media Showcase 2026',
                'slug' => 'trm-game-interactive-media-showcase-2026',
                'description' => 'Pameran karya tahunan game komersial, simulasi virtual reality, aplikasi multimedia interaktif, dan animasi karya mahasiswa dan alumni D-IV TRM POLITALA.',
                'location' => 'Hall Gedung Kuliah Terpadu POLITALA',
                'event_date' => now()->addDays(28)->toDateString(),
                'start_time' => '08:30',
                'end_time' => '17:00',
                'speaker' => 'Dosen & Tim Pengembang Mahasiswa',
                'registration_url' => 'https://pmb.politala.ac.id',
                'status' => 'published',
            ],
        ];

        foreach ($eventsData as $e) {
            Event::updateOrCreate(['slug' => $e['slug']], $e);
        }

        // 6. Academic Features (Tahap 9)
        $curriculum = Curriculum::updateOrCreate(
            ['code' => 'KUR-TRM-2024'],
            [
                'name' => 'Kurikulum Berbasis OBE & Project-Based Learning (PBL) 2024-2028',
                'year' => '2024',
                'total_sks' => 144,
                'description' => 'Kurikulum dirancang selaras dengan SKKNI Animasi & Game Development serta kebutuhan industri media digital global.',
                'is_active' => true,
            ]
        );

        $coursesData = [
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM101', 'name' => 'Dasar Pemrograman Multimedia', 'semester' => 1, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM102', 'name' => 'Menggambar Bentuk & Desain 2D', 'semester' => 1, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM103', 'name' => 'Pengantar Teknologi Rekayasa Multimedia', 'semester' => 1, 'sks' => 2, 'theory_sks' => 2, 'practical_sks' => 0, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM104', 'name' => 'Matematika Terapan untuk Game & Grafika', 'semester' => 1, 'sks' => 3, 'theory_sks' => 2, 'practical_sks' => 1, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM105', 'name' => 'Bahasa Inggris Vokasi', 'semester' => 1, 'sks' => 2, 'theory_sks' => 1, 'practical_sks' => 1, 'type' => 'Wajib'],

            ['curriculum_id' => $curriculum->id, 'code' => 'TRM201', 'name' => 'Pemrograman Berorientasi Objek (OOP)', 'semester' => 2, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM202', 'name' => 'Pemodelan Objek 3D Dasar', 'semester' => 2, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM203', 'name' => 'Desain Antarmuka & UX Design', 'semester' => 2, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM204', 'name' => 'Struktur Data & Algoritma Grafika', 'semester' => 2, 'sks' => 3, 'theory_sks' => 2, 'practical_sks' => 1, 'type' => 'Wajib'],

            ['curriculum_id' => $curriculum->id, 'code' => 'TRM301', 'name' => 'Game Engine Architecture (Unity/Godot)', 'semester' => 3, 'sks' => 4, 'theory_sks' => 1, 'practical_sks' => 3, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM302', 'name' => 'Rigging & Karakter Animasi 3D', 'semester' => 3, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM303', 'name' => 'Pemrograman Web Multimedia', 'semester' => 3, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM304', 'name' => 'Audio & Desain Suara Interaktif', 'semester' => 3, 'sks' => 2, 'theory_sks' => 1, 'practical_sks' => 1, 'type' => 'Wajib'],

            ['curriculum_id' => $curriculum->id, 'code' => 'TRM401', 'name' => 'Virtual Reality & Augmented Reality', 'semester' => 4, 'sks' => 4, 'theory_sks' => 1, 'practical_sks' => 3, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM402', 'name' => 'Visual Effects (VFX) & Compositing', 'semester' => 4, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM403', 'name' => 'PBL: Proyek Produksi Game 2D/3D', 'semester' => 4, 'sks' => 4, 'theory_sks' => 0, 'practical_sks' => 4, 'type' => 'Wajib'],
        ];

        foreach ($coursesData as $c) {
            Course::updateOrCreate(
                ['curriculum_id' => $c['curriculum_id'], 'code' => $c['code']],
                $c
            );
        }

        AcademicCalendar::updateOrCreate(
            ['academic_year' => '2026/2027', 'semester' => 'semua'],
            [
                'title' => 'Kalender Akademik Tahun Ajaran 2026/2027 POLITALA',
                'description' => 'Jadwal registrasi ulang, perkuliahan semester ganjil/genap, pekan UTS, UAS, dan yudisium program sarjana terapan.',
                'is_active' => true,
            ]
        );

        $cplData = [
            ['code' => 'CPL-01', 'category' => 'sikap', 'description' => 'Bertaqwa kepada Tuhan Yang Maha Esa dan mampu menunjukkan sikap profesional, etis, dan bertanggung jawab atas pekerjaan di bidang teknologi multimedia.', 'order' => 1],
            ['code' => 'CPL-02', 'category' => 'pengetahuan', 'description' => 'Menguasai konsep teoretis matematika grafika, arsitektur game engine, dan pipeline produksi animasi 3D.', 'order' => 2],
            ['code' => 'CPL-03', 'category' => 'keterampilan_umum', 'description' => 'Mampu menerapkan pemikiran logis, kritis, inovatif, dan bermutu dalam konteks penerapan ilmu pengetahuan dan teknologi terapan.', 'order' => 3],
            ['code' => 'CPL-04', 'category' => 'keterampilan_khusus', 'description' => 'Mampu merancang, mengimplementasikan, dan menguji aplikasi game interaktif, simulasi VR/AR, dan film animasi 3D standar industri.', 'order' => 4],
        ];

        foreach ($cplData as $cpl) {
            Cpl::updateOrCreate(['code' => $cpl['code']], $cpl);
        }

        $gradProfiles = [
            [
                'title' => 'Technical Game Programmer',
                'description' => 'Ahli pemrograman sistem permainan, mekanika interaktif, shader, arsitektur gameplay, dan integrasi fisika dalam Unreal Engine dan Unity.',
                'career_roles' => 'Gameplay Programmer, AI Programmer, Engine Developer, Mobile Game Developer',
                'order' => 1,
            ],
            [
                'title' => '3D Technical Artist & Animator',
                'description' => 'Spesialis pemodelan 3D, rigging karakter, teknik animasi gerak dinamis, teksturing PBR, lighting, dan efek visual (VFX) sinematik.',
                'career_roles' => '3D Modeler, Character Rigger, 3D Animator, VFX Compositor, Lighting Artist',
                'order' => 2,
            ],
            [
                'title' => 'XR & Virtual Reality Developer',
                'description' => 'Pengembang aplikasi realitas tertambah (AR), realitas virtual (VR), dan metaversal simulation untuk edukasi, kedokteran, dan simulator industri.',
                'career_roles' => 'VR Developer, AR Application Engineer, Simulation Software Specialist',
                'order' => 3,
            ],
            [
                'title' => 'Web Multimedia & UI/UX Engineer',
                'description' => 'Perekayasa aplikasi web kaya multimedia modern, desain antarmuka imersif, dan sistem interaktif berbasis teknologi komputasi awan.',
                'career_roles' => 'Frontend Multimedia Developer, UI/UX Designer, Creative Web Technologist',
                'order' => 4,
            ],
        ];

        foreach ($gradProfiles as $gp) {
            GraduateProfile::updateOrCreate(['title' => $gp['title']], $gp);
        }

        // 7. Facilities & Gallery (Tahap 10)
        $facilitiesData = [
            [
                'name' => 'Studio Animasi 3D & Motion Capture',
                'slug' => 'studio-animasi-3d-motion-capture',
                'category' => 'Studio',
                'description' => 'Fasilitas produksi animasi mutakhir dilengkapi rig sensor Motion Capture 16-kamera optik untuk penangkapan gerak real-time presisi tinggi.',
                'specifications' => '16-Camera Optical MoCap Suit, Workstation Dual GPU RTX 4090, Cintiq 24 Pro Drawing Display, Akustik Ruang Standar Dolby.',
                'capacity' => 30,
                'order' => 1,
            ],
            [
                'name' => 'Laboratorium Rekayasa Game & Virtual Reality',
                'slug' => 'laboratorium-rekayasa-game-virtual-reality',
                'category' => 'Laboratorium',
                'description' => 'Lab komputasi grafis performa tinggi untuk pengembangan game engine, kompilasi proyek besar, dan pengujian headset Meta Quest 3 & HTC Vive.',
                'specifications' => '36 Unit PC High-End Intel Core i9 / RTX 4080, Meta Quest 3 VR Headsets, Haptic Gloves Controller, Gigabit LAN Low-Latency.',
                'capacity' => 36,
                'order' => 2,
            ],
            [
                'name' => 'Laboratorium Desain Antarmuka & Web Interaktif',
                'slug' => 'laboratorium-desain-antarmuka-web-interaktif',
                'category' => 'Laboratorium',
                'description' => 'Ruang eksplorasi desain UI/UX, eye-tracking usability testing, dan pemrograman web interaktif berbasis multi-platform.',
                'specifications' => '36 Unit PC Apple iMac & Workstation Windows, Eye-Tracker Sensor Hardware, Software Figma Enterprise & Adobe Creative Cloud.',
                'capacity' => 36,
                'order' => 3,
            ],
        ];

        foreach ($facilitiesData as $f) {
            Facility::updateOrCreate(['slug' => $f['slug']], $f);
        }

        $album = GalleryAlbum::updateOrCreate(
            ['slug' => 'showcase-karya-animasi-game-2026'],
            [
                'title' => 'Showcase Karya Animasi & Game D-IV TRM 2026',
                'description' => 'Dokumentasi hasil karya tugas akhir terapan dan proyek kolaboratif mahasiswa bersama mitra industri kreatif.',
                'event_date' => now()->subDays(20)->toDateString(),
            ]
        );

        $galleryData = [
            ['gallery_album_id' => $album->id, 'title' => 'Pengujian Motion Capture Studio', 'image_url' => '/assets/logo.png', 'caption' => 'Mahasiswa mempraktikkan penangkapan gerak atlet pencak silat untuk karakter game laga.', 'order' => 1],
            ['gallery_album_id' => $album->id, 'title' => 'Presentasi Prototype Game VR', 'image_url' => '/assets/logo.png', 'caption' => 'Demontrasi simulasi keselamatan kerja berbasis Virtual Reality di depan dewan penguji industri.', 'order' => 2],
        ];

        foreach ($galleryData as $g) {
            Gallery::updateOrCreate(
                ['gallery_album_id' => $g['gallery_album_id'], 'title' => $g['title']],
                $g
            );
        }
    }
}

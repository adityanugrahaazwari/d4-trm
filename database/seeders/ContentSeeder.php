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
                'content' => "Visi Program Studi:\nMenjadi pusat pendidikan vokasi unggulan dan rujukan di bidang teknologi rekayasa multimedia terapan yang berdaya saing global, inovatif, dan berjiwa wirausaha pada tahun 2030.\n\nMisi Program Studi:\n1. Menyelenggarakan pendidikan sarjana terapan berbasis Project-Based Learning yang mengintegrasikan rekayasa sistem komputer dan kreativitas seni multimedia sesuai kebutuhan industri.\n2. Mengembangkan penelitian terapan dan menghasilkan karya inovasi tepat guna di bidang game development, animasi 3D, simulasi virtual, dan media interaktif.\n3. Menerapkan produk teknologi multimedia terapan guna mengakselerasi transformasi digital masyarakat, UMKM daerah, instansi publik, dan industri kreatif.\n4. Memperkuat jejaring kemitraan strategis dengan Dunia Usaha dan Dunia Industri (DUDI) skala nasional maupun global dalam skema magang, riset bersama, dan sertifikasi profesi.",
                'meta' => [
                    'vision_statement' => 'Menjadi pusat pendidikan tinggi vokasi unggulan dan rujukan di bidang teknologi rekayasa multimedia terapan yang berdaya saing global, inovatif, dan berjiwa wirausaha pada tahun 2030.',
                    'target_year' => '2030',
                    'missions' => [
                        [
                            'number' => 1,
                            'title' => 'Pendidikan Vokasi Selaras Industri & OBE',
                            'description' => 'Menyelenggarakan pendidikan sarjana terapan berbasis Outcome-Based Education (OBE) dan Project-Based Learning (PBL) yang memadukan rekayasa perangkat lunak dan estetika seni digital.',
                        ],
                        [
                            'number' => 2,
                            'title' => 'Penelitian Terapan & Inovasi Tepat Guna',
                            'description' => 'Mengembangkan penelitian terapan dan hilirisasi produk karya multimedia interaktif (game, animasi, dan realitas virtual) yang berdaya guna serta bernilai paten/HKI.',
                        ],
                        [
                            'number' => 3,
                            'title' => 'Pengabdian Masyarakat & Transformasi Digital',
                            'description' => 'Menerapkan produk teknologi rekayasa multimedia untuk memberdayakan masyarakat, mendukung digitalisasi UMKM daerah, instansi pemerintah, dan sektor pendidikan.',
                        ],
                        [
                            'number' => 4,
                            'title' => 'Kemitraan Strategis Bersama DUDI & Asosiasi',
                            'description' => 'Memperluas kolaborasi strategis dengan studio game, rumah produksi animasi, dan ekosistem industri kreatif nasional maupun global dalam skema magang, pengajaran praktisi, dan sertifikasi kompetensi.',
                        ],
                    ],
                    'goals' => [
                        [
                            'title' => 'Lulusan Kompeten & Bersertifikasi Profesi',
                            'description' => 'Menghasilkan Sarjana Terapan Komputer (S.Tr.Kom.) berkarakter unggul, kompeten di bidang multimedia, dan tersertifikasi profesi nasional (BNSP) maupun internasional.',
                        ],
                        [
                            'title' => 'Produk Karya Siap Komersial & Bernilai HKI',
                            'description' => 'Menghasilkan karya rekayasa multimedia, game komersial, animasi 3D, dan media imersif yang teruji industri dan terdaftar Hak Kekayaan Intelektual.',
                        ],
                        [
                            'title' => 'Inkubasi Technopreneurship Kreatif Mahasiswa',
                            'description' => 'Mendorong lahirnya rintisan usaha teknologi dan studio kreatif mahasiswa melalui teaching factory dan kolaborasi inkubator bisnis kampus.',
                        ],
                        [
                            'title' => 'Tata Kelola Unggul & Akreditasi Berkualitas',
                            'description' => 'Mewujudkan tata kelola program studi yang modern, transparan, akuntabel, dan berdaya saing tinggi berstandar mutu penjaminan internal dan eksternal.',
                        ],
                    ],
                    'core_values' => [
                        ['title' => 'Integrity', 'description' => 'Menjunjung tinggi etika akademik dan profesionalisme.'],
                        ['title' => 'Innovation', 'description' => 'Kreatif menciptakan terobosan karya media interaktif.'],
                        ['title' => 'Collaboration', 'description' => 'Sinergis bersama industri dan komunitas vokasi.'],
                        ['title' => 'Competence', 'description' => 'Menguasai keterampilan teknis mutakhir siap industri.'],
                    ],
                ],
            ],
            [
                'section' => 'sambutan',
                'title' => 'Sambutan Ketua Program Studi',
                'content' => "Selamat datang di website resmi Program Studi Sarjana Terapan (D-4) Teknik Rekayasa Multimedia (TRM) Politeknik Negeri Tanah Laut.\n\nEra transformasi digital saat ini menuntut sinergi antara kemampuan rekayasa perangkat lunak dan kepekaan seni multimedia. TRM POLITALA hadir dengan visi mencetak sarjana terapan yang tidak hanya memahami teori komputasi, tetapi juga mahir merancang game, memproduksi aset 3D & animasi, serta membangun solusi virtual dan augmented reality yang relevan dengan kebutuhan dunia kerja saat ini.\n\nMelalui kurikulum berbasis Teaching Factory dan Project-Based Learning, mahasiswa kami dipersiapkan sejak semester awal untuk mengerjakan proyek nyata bersama mitra industri. Kami berkomitmen untuk menyediakan iklim akademik yang kolaboratif, fasilitas laboratorium berteknologi terkini, dan bimbingan dosen yang berdedikasi.\n\nKami mengajak seluruh calon mahasiswa, mitra industri, dan masyarakat untuk bersama-sama mengembangkan ekosistem multimedia terapan yang unggul dan berdaya saing.",
                'meta' => [
                    'kaprodi_name' => 'Dr. H. Rian Hidayat, M.Kom.',
                    'kaprodi_nip' => '198504122014041001',
                    'kaprodi_position' => 'Koordinator Program Studi Sarjana Terapan TRM',
                    'kaprodi_department' => 'Jurusan Komputer dan Bisnis, Politeknik Negeri Tanah Laut',
                    'kaprodi_email' => 'rian.hidayat@politala.ac.id',
                    'kaprodi_photo_url' => null,
                    'period' => 'Periode 2024 - 2028',
                    'subtitle' => 'Pesan & Harapan dari Pimpinan Program Studi Sarjana Terapan TRM POLITALA',
                    'greeting' => 'Assalamu’alaikum Warahmatullahi Wabarakatuh & Salam Sejahtera,',
                    'quote' => 'TRM POLITALA hadir untuk melahirkan talenta digital masa depan yang memadukan keunggulan rekayasa teknologi dan estetika seni multimedia.',
                    'closing_greeting' => 'Wassalamu’alaikum Warahmatullahi Wabarakatuh.',
                    'signature_title' => 'Koordinator Program Studi D-4 TRM POLITALA',
                    'signature_name' => 'Dr. H. Rian Hidayat, M.Kom.',
                    'video_url' => null,
                    'key_points' => [
                        [
                            'badge' => 'Metode Belajar',
                            'title' => 'Pembelajaran Berbasis Proyek (PBL)',
                            'description' => 'Kurikulum vokasi 70% praktik yang membiasakan mahasiswa menyelesaikan proyek riil industri animasi, game, dan media interaktif sejak awal perkuliahan.',
                        ],
                        [
                            'badge' => 'Infrastruktur',
                            'title' => 'Laboratorium & Workstation Standar Industri',
                            'description' => 'Fasilitas Studio Motion Capture, Laboratorium Komputasi Grafis berkecepatan tinggi, dan Render Farm terintegrasi.',
                        ],
                        [
                            'badge' => 'Kemitraan DUDI',
                            'title' => 'Kolaborasi Ekosistem Industri Kreatif',
                            'description' => 'Kemitraan strategis dengan studio game komersial dan rumah produksi multimedia untuk program magang bersertifikat dan rekrutmen kerja.',
                        ],
                        [
                            'badge' => 'Kompetensi',
                            'title' => 'Sertifikasi Keahlian Berstandar Nasional (BNSP)',
                            'description' => 'Lulusan dibekali sertifikasi kompetensi profesi dan portofolio karya teruji sebelum wisuda untuk menjamin daya serap kerja.',
                        ],
                    ],
                ],
            ],
            [
                'section' => 'struktur',
                'title' => 'Struktur Organisasi Program Studi',
                'content' => "Tata kelola dan struktur organisasi Program Studi Sarjana Terapan (D-IV) Teknik Rekayasa Multimedia dirancang secara terpadu guna menjamin kelancaran tridharma perguruan tinggi, operasional laboratorium studio multimedia, serta efektivitas pelaksanaan pembelajaran berbasis proyek (Project-Based Learning).\n\nStruktur organisasi ini dipimpin oleh Koordinator Program Studi yang bertanggung jawab langsung kepada Ketua Jurusan Komputer dan Bisnis POLITALA, serta didukung oleh Gugus Kendali Mutu (GKM), Kepala Laboratorium Studio Multimedia, Koordinator Kurikulum & MBKM, Pembina Kemahasiswaan & Studio Game, Pranata Laboratorium Pendidikan (PLP), serta staf administrasi dan layanan akademik.",
                'meta' => [
                    'sk_number' => 'SK Direktur POLITALA No. 124/PL34/OT/2026',
                    'academic_year' => 'Tahun Akademik 2026/2027',
                    'department_head_name' => 'Hj. Agustian Noor, S.Kom., M.Kom.',
                    'department_head_nip' => '197908152005011002',
                    'department_head_dept' => 'Jurusan Komputer & Bisnis, Politeknik Negeri Tanah Laut',
                    'gkm_name' => 'Tim Gugus Kendali Mutu (GKM) TRM',
                    'gkm_nip' => 'Pusat Penjaminan Mutu (P4M)',
                    'custom_units' => [
                        [
                            'unit' => 'Kelompok Bidang Keahlian (KBK) Game & XR',
                            'leader' => 'Bambang Trianto, S.Kom., M.Cs.',
                            'desc' => 'Fokus pengembangan kurikulum dan riset terapan bidang Game Engine Architecture & Immersive Tech (AR/VR).',
                        ],
                        [
                            'unit' => 'Kelompok Bidang Keahlian (KBK) Animasi & Media Digital',
                            'leader' => 'Fathurrahman, M.Sn.',
                            'desc' => 'Fokus perancangan aset grafis 3D, rigging, motion capture, visual effects, dan audio spasial.',
                        ],
                    ],
                ],
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
            // Semester 1 (20 SKS)
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM101', 'name' => 'Algoritma & Pemrograman Multimedia', 'semester' => 1, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM102', 'name' => 'Dasar Desain Grafis & Tipografi Digital', 'semester' => 1, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM103', 'name' => 'Matematika Komputasi & Vektor Grafika', 'semester' => 1, 'sks' => 3, 'theory_sks' => 2, 'practical_sks' => 1, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM104', 'name' => 'Pengantar Teknologi Media Interaktif & Game', 'semester' => 1, 'sks' => 3, 'theory_sks' => 2, 'practical_sks' => 1, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM105', 'name' => 'Fotografi Digital & Sinematografi Dasar', 'semester' => 1, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'WKW101', 'name' => 'Pendidikan Pancasila & Kewarganegaraan', 'semester' => 1, 'sks' => 2, 'theory_sks' => 2, 'practical_sks' => 0, 'type' => 'Institusi'],
            ['curriculum_id' => $curriculum->id, 'code' => 'WKW102', 'name' => 'Bahasa Indonesia Akademik & Teknis', 'semester' => 1, 'sks' => 2, 'theory_sks' => 2, 'practical_sks' => 0, 'type' => 'Institusi'],
            ['curriculum_id' => $curriculum->id, 'code' => 'WKW103', 'name' => 'Bahasa Inggris Komunikasi Teknik', 'semester' => 1, 'sks' => 1, 'theory_sks' => 1, 'practical_sks' => 0, 'type' => 'Institusi'],

            // Semester 2 (20 SKS)
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM201', 'name' => 'Pemrograman Berorientasi Objek Multimedia (C#/C++)', 'semester' => 2, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM202', 'name' => 'Desain Antarmuka & Pengalaman Pengguna (UI/UX)', 'semester' => 2, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM203', 'name' => 'Dasar Pemodelan 3D & Digital Asset (Blender)', 'semester' => 2, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM204', 'name' => 'Audio Engineering & Sound Design', 'semester' => 2, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM205', 'name' => 'Sistem Basis Data Multimedia', 'semester' => 2, 'sks' => 3, 'theory_sks' => 2, 'practical_sks' => 1, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM206', 'name' => 'Animasi 2D Digital & Motion Graphics', 'semester' => 2, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'WKW201', 'name' => 'Pendidikan Agama', 'semester' => 2, 'sks' => 2, 'theory_sks' => 2, 'practical_sks' => 0, 'type' => 'Institusi'],

            // Semester 3 (19 SKS)
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM301', 'name' => 'Pemodelan Karakter 3D & Digital Sculpting', 'semester' => 3, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM302', 'name' => 'Pemrograman Game 2D & Game Engine I (Unity)', 'semester' => 3, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM303', 'name' => 'Pengembangan Web Multimedia & Frontend Interaktif', 'semester' => 3, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM304', 'name' => 'Rigging & Animasi Karakter 3D', 'semester' => 3, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM305', 'name' => 'Visual Effects (VFX) & Compositing', 'semester' => 3, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM306', 'name' => 'Statistika & Probabilitas Komputasi', 'semester' => 3, 'sks' => 2, 'theory_sks' => 2, 'practical_sks' => 0, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'WKW301', 'name' => 'Etika Profesi & Hukum Siber Multimedia', 'semester' => 3, 'sks' => 2, 'theory_sks' => 2, 'practical_sks' => 0, 'type' => 'Institusi'],

            // Semester 4 (19 SKS)
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM401', 'name' => 'Pemrograman Game 3D & Game Engine II (Unreal Engine 5)', 'semester' => 4, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM402', 'name' => 'Virtual Reality (VR) & Augmented Reality (AR) Fundamental', 'semester' => 4, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM403', 'name' => 'Environment Art & Lighting 3D', 'semester' => 4, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM404', 'name' => 'Produksi Video Digital & Color Grading', 'semester' => 4, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM405', 'name' => 'Rekayasa Perangkat Lunak Multimedia', 'semester' => 4, 'sks' => 3, 'theory_sks' => 2, 'practical_sks' => 1, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM406', 'name' => 'Proyek Terintegrasi Multimedia I (PBL Studio)', 'semester' => 4, 'sks' => 4, 'theory_sks' => 1, 'practical_sks' => 3, 'type' => 'Wajib'],

            // Semester 5 (19 SKS)
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM501', 'name' => 'Pengembangan Aplikasi Imersif Lanjut (Mixed Reality & XR)', 'semester' => 5, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM502', 'name' => 'Kecerdasan Buatan dalam Game (Game AI)', 'semester' => 5, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM503', 'name' => 'Mobile Interactive App Development', 'semester' => 5, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM504', 'name' => 'Computer Vision & Interaksi Manusia Komputer', 'semester' => 5, 'sks' => 3, 'theory_sks' => 2, 'practical_sks' => 1, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM505', 'name' => 'Manajemen Proyek Multimedia & Agile/Scrum', 'semester' => 5, 'sks' => 3, 'theory_sks' => 2, 'practical_sks' => 1, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM506', 'name' => 'Proyek Terintegrasi Multimedia II (PBL Industri)', 'semester' => 5, 'sks' => 4, 'theory_sks' => 1, 'practical_sks' => 3, 'type' => 'Wajib'],

            // Semester 6 (18 SKS)
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM601', 'name' => 'Game Engine Architecture & Optimasi Kinerja', 'semester' => 6, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM602', 'name' => 'Desain Audio Spasial & Komposisi Interaktif', 'semester' => 6, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM603', 'name' => 'Kewirausahaan Digital & Manajemen Bisnis Kreatif', 'semester' => 6, 'sks' => 3, 'theory_sks' => 2, 'practical_sks' => 1, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM604', 'name' => 'Metodologi Riset Terapan Multimedia', 'semester' => 6, 'sks' => 3, 'theory_sks' => 2, 'practical_sks' => 1, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM605', 'name' => 'MK Pilihan I: Virtual Production & MoCap Pipeline', 'semester' => 6, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Pilihan'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM606', 'name' => 'MK Pilihan II: Technical Art & Shader Programming', 'semester' => 6, 'sks' => 3, 'theory_sks' => 1, 'practical_sks' => 2, 'type' => 'Pilihan'],

            // Semester 7 (20 SKS)
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM701', 'name' => 'Magang Industri Bersertifikat (MBKM Vokasi DUDI)', 'semester' => 7, 'sks' => 16, 'theory_sks' => 0, 'practical_sks' => 16, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM702', 'name' => 'Portofolio Industri & Presentasi Proyek Mitra', 'semester' => 7, 'sks' => 4, 'theory_sks' => 0, 'practical_sks' => 4, 'type' => 'Wajib'],

            // Semester 8 (9 SKS)
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM801', 'name' => 'Seminar Proposal Tugas Akhir', 'semester' => 8, 'sks' => 2, 'theory_sks' => 0, 'practical_sks' => 2, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM802', 'name' => 'Tugas Akhir / Skripsi Terapan (Capstone Multimedia Product)', 'semester' => 8, 'sks' => 6, 'theory_sks' => 0, 'practical_sks' => 6, 'type' => 'Wajib'],
            ['curriculum_id' => $curriculum->id, 'code' => 'TRM803', 'name' => 'Uji Sertifikasi Kompetensi Profesi Multimedia (BNSP)', 'semester' => 8, 'sks' => 1, 'theory_sks' => 0, 'practical_sks' => 1, 'type' => 'Wajib'],
        ];

        foreach ($coursesData as $c) {
            Course::updateOrCreate(
                ['curriculum_id' => $c['curriculum_id'], 'code' => $c['code']],
                $c
            );
        }

        $calendarData = [
            [
                'academic_year' => '2026/2027',
                'semester' => 'ganjil',
                'title' => 'Registrasi Ulang & Pembayaran UKT Semester Ganjil',
                'start_date' => '2026-08-01',
                'end_date' => '2026-08-15',
                'description' => 'Pembayaran biaya pendidikan UKT dan pengisian Kartu Rencana Studi (KRS) online melalui sistem informasi akademik.',
                'is_active' => true,
            ],
            [
                'academic_year' => '2026/2027',
                'semester' => 'ganjil',
                'title' => 'Pengenalan Kehidupan Kampus Mahasiswa Baru (PKKMB)',
                'start_date' => '2026-08-18',
                'end_date' => '2026-08-22',
                'description' => 'Masa orientasi mahasiswa baru Politeknik Negeri Tanah Laut dan pengenalan laboratorium prodi TRM.',
                'is_active' => true,
            ],
            [
                'academic_year' => '2026/2027',
                'semester' => 'ganjil',
                'title' => 'Perkuliahan & Praktikum Aktif Semester Ganjil (Tahap I)',
                'start_date' => '2026-08-25',
                'end_date' => '2026-10-17',
                'description' => 'Perkuliahan tatap muka dan praktikum intensif laboratorium minggu ke-1 s.d. minggu ke-8.',
                'is_active' => true,
            ],
            [
                'academic_year' => '2026/2027',
                'semester' => 'ganjil',
                'title' => 'Ujian Tengah Semester (UTS) Ganjil',
                'start_date' => '2026-10-20',
                'end_date' => '2026-10-31',
                'description' => 'Evaluasi capaian tengah semester teori dan ujian performa portofolio praktikum.',
                'is_active' => true,
            ],
            [
                'academic_year' => '2026/2027',
                'semester' => 'ganjil',
                'title' => 'Perkuliahan Aktif & Pengerjaan Proyek PBL (Tahap II)',
                'start_date' => '2026-11-03',
                'end_date' => '2026-12-19',
                'description' => 'Penyelesaian proyek berbasis industri (Project-Based Learning) dan asistensi studio.',
                'is_active' => true,
            ],
            [
                'academic_year' => '2026/2027',
                'semester' => 'ganjil',
                'title' => 'Ujian Akhir Semester (UAS) & Showcase Proyek Multimedia',
                'start_date' => '2026-12-22',
                'end_date' => '2027-01-09',
                'description' => 'Ujian akhir semester, pameran karya tugas besar mahasiswa TRM, dan input nilai KHS.',
                'is_active' => true,
            ],
            [
                'academic_year' => '2026/2027',
                'semester' => 'genap',
                'title' => 'Registrasi Ulang & KRS Semester Genap 2026/2027',
                'start_date' => '2027-01-15',
                'end_date' => '2027-01-30',
                'description' => 'Konsultasi Dosen Penasihat Akademik (PA) dan pengisian KRS semester genap.',
                'is_active' => true,
            ],
            [
                'academic_year' => '2026/2027',
                'semester' => 'genap',
                'title' => 'Masa Perkuliahan & Magang Industri MBKM Semester Genap',
                'start_date' => '2027-02-08',
                'end_date' => '2027-06-19',
                'description' => 'Perkuliahan semester genap dan keberangkatan mahasiswa magang bersertifikat DUDI 6 bulan.',
                'is_active' => true,
            ],
            [
                'academic_year' => '2026/2027',
                'semester' => 'genap',
                'title' => 'Sidang Tugas Akhir Capstone & Yudisium Sarjana Terapan',
                'start_date' => '2027-07-05',
                'end_date' => '2027-07-24',
                'description' => 'Sidang dewan penguji tugas akhir bersama mitra industri, yudisium kelulusan, dan uji kompetensi BNSP.',
                'is_active' => true,
            ],
        ];

        foreach ($calendarData as $cal) {
            AcademicCalendar::updateOrCreate(
                ['academic_year' => $cal['academic_year'], 'title' => $cal['title']],
                $cal
            );
        }

        $cplData = [
            // Sikap (Attitude)
            ['code' => 'CPL-01', 'category' => 'sikap', 'description' => 'Bertaqwa kepada Tuhan Yang Maha Esa dan mampu menunjukkan sikap religius, disiplin, beretika moral, dan berintegritas tinggi dalam kehidupan bermasyarakat dan bernegara.', 'order' => 1],
            ['code' => 'CPL-02', 'category' => 'sikap', 'description' => 'Menjunjung tinggi penegakan hukum, menghargai orisinalitas karya, mematuhi etika profesi, serta menghormati hak cipta (HaKI) di industri media kreatif digital.', 'order' => 2],
            ['code' => 'CPL-03', 'category' => 'sikap', 'description' => 'Menunjukkan sikap bertanggung jawab, tangguh, berjiwa kewirausahaan (technopreneurship), dan memiliki komitmen mutu atas pekerjaan di bidang teknologi multimedia baik mandiri maupun tim multidisiplin.', 'order' => 3],

            // Penguasaan Pengetahuan (Knowledge)
            ['code' => 'CPL-04', 'category' => 'pengetahuan', 'description' => 'Menguasai konsep teoretis matematika komputasi grafika, rendering pipeline, struktur data multimedia, dan algoritma pengoptimalan performa game engine.', 'order' => 4],
            ['code' => 'CPL-05', 'category' => 'pengetahuan', 'description' => 'Menguasai prinsip interaksi manusia dan komputer (HCI), metodologi User Experience (UI/UX Design Thinking), serta arsitektur komputasi awan dan web spasial.', 'order' => 5],
            ['code' => 'CPL-06', 'category' => 'pengetahuan', 'description' => 'Menguasai metodologi rekayasa perangkat lunak interaktif modern, prinsip manajemen proyek berbasis Agile/Scrum, dan pipeline produksi animasi 3D sinematik standar DUDI.', 'order' => 6],

            // Keterampilan Umum (General Skills)
            ['code' => 'CPL-07', 'category' => 'keterampilan_umum', 'description' => 'Mampu menerapkan pemikiran logis, kritis, inovatif, dan bermutu dalam menyelesaikan pekerjaan rekayasa teknologi terapan yang memperhatikan nilai humaniora.', 'order' => 7],
            ['code' => 'CPL-08', 'category' => 'keterampilan_umum', 'description' => 'Mampu mengkaji implikasi pengembangan atau implementasi ilmu pengetahuan dan teknologi serta mempresentasikan solusi karya terapan secara efektif kepada pemangku kepentingan.', 'order' => 8],
            ['code' => 'CPL-09', 'category' => 'keterampilan_umum', 'description' => 'Mampu mengambil keputusan secara tepat dalam konteks penyelesaian masalah di bidang multimedia berdasarkan analisis data dan informasi yang valid.', 'order' => 9],

            // Keterampilan Khusus (Specific Skills)
            ['code' => 'CPL-10', 'category' => 'keterampilan_khusus', 'description' => 'Mampu merekayasa arsitektur permainan (gameplay mechanics), kecerdasan buatan game (Game AI), dan optimasi shader menggunakan game engine standar industri (Unreal Engine & Unity).', 'order' => 10],
            ['code' => 'CPL-11', 'category' => 'keterampilan_khusus', 'description' => 'Mampu memproduksi aset grafis 3D berkualitas tinggi, rigging karakter, penangkapan gerak (motion capture), animasi dinamis, visual effects (VFX), dan audio spasial terstandarisasi.', 'order' => 11],
            ['code' => 'CPL-12', 'category' => 'keterampilan_khusus', 'description' => 'Mampu merancang, membangun, dan menguji aplikasi imersif berbasis teknologi Virtual Reality (VR), Augmented Reality (AR), dan Mixed Reality (XR) untuk kebutuhan simulasi industri dan edukasi.', 'order' => 12],
        ];

        foreach ($cplData as $cpl) {
            Cpl::updateOrCreate(['code' => $cpl['code']], $cpl);
        }

        $gradProfiles = [
            [
                'title' => 'Technical Game Developer & Gameplay Programmer',
                'description' => 'Sarjana terapan yang menguasai perancangan arsitektur sistem permainan, mekanika interaktif, Game AI, network multiplayer, dan integrasi fisika dalam Unreal Engine 5 dan Unity.',
                'career_roles' => 'Gameplay Programmer, Game AI Engineer, Game Engine Optimizer, Mobile Game Developer, Technical Game Designer',
                'icon' => 'gamepad',
                'order' => 1,
            ],
            [
                'title' => '3D Technical Artist, Modeler & Character Rigger',
                'description' => 'Spesialis yang menjembatani seni visual dan komputasi teknis melalui pemodelan 3D hard-surface/organic, rigging tulang karakter, texturing PBR, lighting, dan visual effects (VFX).',
                'career_roles' => '3D Modeler, Character Rigger, Technical Artist, VFX Compositor, Real-time Lighting Artist, Motion Capture Operator',
                'icon' => 'cube',
                'order' => 2,
            ],
            [
                'title' => 'XR & Immersive Simulation Engineer (AR/VR/MR)',
                'description' => 'Pengembang aplikasi imersif spasial berkinerja tinggi untuk simulator pelatihan keselamatan kerja, simulasi medis, tur virtual interaktif, dan komputasi spasial industri modern.',
                'career_roles' => 'VR Application Developer, AR Specialist, Spatial Computing Engineer, Interactive Simulator Developer',
                'icon' => 'vr',
                'order' => 3,
            ],
            [
                'title' => 'Creative Multimedia Web & UI/UX Technologist',
                'description' => 'Perekayasa aplikasi web multimedia interaktif dengan kemampuan riset usability testing, desain antarmuka responsif modern, web graphics (WebGL/Three.js), dan integrasi API.',
                'career_roles' => 'UI/UX Designer, Frontend Multimedia Engineer, Creative Web Technologist, Design System Lead',
                'icon' => 'code',
                'order' => 4,
            ],
            [
                'title' => 'Technical Video Producer & Cinema VFX Compositor',
                'description' => 'Profesional produksi video sinematik dengan keahlian tata kamera cinema 6K, pencahayaan studio, live broadcasting, chroma keying cyclorama, dan grading warna DaVinci Resolve.',
                'career_roles' => 'Broadcast Video Director, Motion Graphic Designer, Colorist, VFX Compositor, Video Production Manager',
                'icon' => 'video',
                'order' => 5,
            ],
            [
                'title' => 'Interactive Audio Designer & Sound Engineer',
                'description' => 'Spesialis perancangan tata suara interaktif, rekaman foley, sulih suara (voice acting), aransemen musik orisinal, serta implementasi audio adaptif dalam game dan film animasi.',
                'career_roles' => 'Game Audio Engineer, Foley Artist, Sound Designer, Music Producer, Voice Director',
                'icon' => 'music',
                'order' => 6,
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
                'category' => 'Studio Produksi & Cinema',
                'location' => 'Gedung TI Lantai 2 - Ruang 201',
                'description' => 'Fasilitas produksi animasi mutakhir dilengkapi rig sensor Motion Capture 16-kamera optik untuk penangkapan gerak real-time presisi tinggi dalam pembuatan film dan game.',
                'specifications' => '16-Camera Optical MoCap Suit, Workstation Dual GPU RTX 4090, Wacom Cintiq 24 Pro Display, Studio Akustik Peredam Suara',
                'software' => 'Autodesk Maya, Blender 4, Motive MoCap System, ZBrush, Adobe After Effects',
                'capacity' => 30,
                'order' => 1,
            ],
            [
                'name' => 'Laboratorium Rekayasa Game & Virtual Reality (VR/AR)',
                'slug' => 'laboratorium-rekayasa-game-virtual-reality',
                'category' => 'Laboratorium Komputer',
                'location' => 'Gedung TI Lantai 2 - Ruang 202',
                'description' => 'Lab komputasi grafis performa tinggi untuk pengembangan game engine modern, kompilasi proyek berskala besar, serta uji coba pengalaman interaktif spasial.',
                'specifications' => '36 Unit Workstation Intel Core i9 / RTX 4080, Meta Quest 3 VR Headsets, HTC Vive Pro Enterprise, Gigabit LAN Gaming Setup',
                'software' => 'Unreal Engine 5, Unity 6 Pro, SteamVR SDK, Vuforia AR SDK, Godot Engine',
                'capacity' => 36,
                'order' => 2,
            ],
            [
                'name' => 'Laboratorium Komputasi Multimedia & Grafika 2D/3D',
                'slug' => 'laboratorium-komputasi-multimedia-grafika',
                'category' => 'Laboratorium Komputer',
                'location' => 'Gedung TI Lantai 2 - Ruang 203',
                'description' => 'Ruang praktikum terpusat untuk pemodelan objek 3D kompleks, digital sculpting, texturing PBR, serta rendering aset animasi interaktif.',
                'specifications' => '36 Unit Workstation Core i7 / RTX 4070 Ti, Dual Monitor IPS 4K 100% sRGB, Pen Tablet Drawing Display',
                'software' => 'Adobe Creative Cloud, Blender 3D, Substance 3D Painter, Cinema 4D, DaVinci Resolve',
                'capacity' => 36,
                'order' => 3,
            ],
            [
                'name' => 'Laboratorium Desain Antarmuka & Web Interaktif',
                'slug' => 'laboratorium-desain-antarmuka-web-interaktif',
                'category' => 'Laboratorium Komputer',
                'location' => 'Gedung TI Lantai 2 - Ruang 204',
                'description' => 'Ruang eksplorasi desain antarmuka pengguna (UI/UX), riset eye-tracking usability testing, dan rekayasa aplikasi web multimedia interaktif.',
                'specifications' => '36 Unit Apple iMac & PC Workstation Windows, Tobii Eye-Tracker Hardware, UX Usability Testing Suite',
                'software' => 'Figma Enterprise, Adobe XD, VS Code, Node.js, Webflow, Adobe Creative Cloud',
                'capacity' => 36,
                'order' => 4,
            ],
            [
                'name' => 'Studio Audio Recording, Sound Design & Foley',
                'slug' => 'studio-audio-recording-sound-design',
                'category' => 'Studio Produksi & Cinema',
                'location' => 'Gedung TI Lantai 1 - Ruang 104',
                'description' => 'Studio kedap suara bertaraf standar penyiaran untuk perekaman sulih suara (dubbing), efek suara game (SFX), foley audio, dan mastering musik orisinal.',
                'specifications' => 'Acoustic Soundproof Booth, Focusrite Scarlett 18i20 Audio Interface, Rode NT1-A & Shure SM7B Mics, MIDI Controller 88-Key',
                'software' => 'Avid Pro Tools Ultimate, FL Studio 21 Signature, Ableton Live 12, Adobe Audition, iZotope RX',
                'capacity' => 20,
                'order' => 5,
            ],
            [
                'name' => 'Studio Cinema, Video Production & Green Screen',
                'slug' => 'studio-cinema-video-production-green-screen',
                'category' => 'Studio Produksi & Cinema',
                'location' => 'Gedung TI Lantai 1 - Ruang 105',
                'description' => 'Fasilitas syuting video sinematik profesional, pengambilan visual effect dengan dinding cyclorama green screen, teleprompter, dan siaran langsung multi-kamera.',
                'specifications' => 'Cyclorama Green Screen Wall 6x4m, Blackmagic Pocket Cinema 6K Pro, Aputure Studio LED Lighting Kit, Teleprompter 17-inch, Motorized Slider',
                'software' => 'DaVinci Resolve Studio, Adobe Premiere Pro, Final Cut Pro, OBS Studio Broadcast',
                'capacity' => 25,
                'order' => 6,
            ],
            [
                'name' => 'Co-Working Space & Studio Proyek Industri (PBL Hub)',
                'slug' => 'coworking-space-studio-proyek-industri-pbl',
                'category' => 'Sarana Pendukung & Riset',
                'location' => 'Gedung Kuliah Terpadu Lantai 3 - Ruang Kolaborasi',
                'description' => 'Ruang inkubasi tim mahasiswa untuk mengerjakan proyek rill kemitraan DUDI dengan metode kerja kolaboratif berbasis Agile/Scrum dan teaching factory.',
                'specifications' => 'Interactive Smart Board 75-inch, Modular Collaboration Desks, Wi-Fi 6 High-Density Access Point, Standup Scrum Board',
                'software' => 'Figma Enterprise, Miro Collaborative Canvas, Notion Workspace, GitHub Enterprise, Jira Software',
                'capacity' => 40,
                'order' => 7,
            ],
            [
                'name' => 'Render Farm Terdistribusi & Mini Data Center TRM',
                'slug' => 'render-farm-terdistribusi-mini-data-center',
                'category' => 'Sarana Pendukung & Riset',
                'location' => 'Server Room Gedung TI Lantai 2',
                'description' => 'Menyediakan komputasi rendering animasi dan video skala besar terdistribusi secara paralel tanpa membebani komputer workstation mahasiswa saat produksi.',
                'specifications' => 'Rack Server 4U Multi-GPU NVIDIA A5000, 10Gbps SFP+ Backbone Network, 120TB TrueNAS Storage Pool, UPS Online 10kVA Redundant',
                'software' => 'Deadline Render Manager, Proxmox VE Cluster, TrueNAS CORE, Docker Container Farm',
                'capacity' => 15,
                'order' => 8,
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

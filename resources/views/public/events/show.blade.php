@extends('layouts.public')

@php
    $allEvents = [
        'kuliah-pakar-pipeline-animasi-3d-studio-hollywood' => [
            'slug' => 'kuliah-pakar-pipeline-animasi-3d-studio-hollywood',
            'title' => 'Kuliah Pakar: Standar Pipeline Produksi Animasi 3D Studio Hollywood & Karir Animator Global',
            'category' => 'Kuliah Pakar',
            'status' => 'Pendaftaran Dibuka',
            'status_color' => 'emerald',
            'mode' => 'Hybrid (Auditorium POLITALA & Zoom Webinar)',
            'day' => '28',
            'month' => 'OKT',
            'year' => '2026',
            'date_full' => 'Rabu, 28 Oktober 2026',
            'time' => '09:00 - 12:30 WITA',
            'location' => 'Auditorium Terpadu POLITALA, Lantai 2',
            'location_sub' => 'Jl. A. Yani KM 06, Desa Panggung, Pelaihari & Live Streaming Zoom',
            'fee' => 'Gratis (Mahasiswa & Sivitas Akademika)',
            'quota' => '100 Peserta Luring (Terisi 65%)',
            'speaker' => [
                'name' => 'Bambang Triasmoro, M.Sn.',
                'role' => 'Senior 3D Character Modeler & Pipeline Specialist',
                'company' => 'Ex-Senior Artist di Studio Animasi Internasional (MPC Vancouver & Base FX)',
                'bio' => 'Berpengalaman lebih dari 12 tahun di industri efek visual dan animasi 3D layar lebar Hollywood. Terlibat dalam berbagai proyek film blockbuster global serta aktif sebagai instruktur masterclass CGI di Asia Tenggara.'
            ],
            'description' => 'Program Studi D-IV Teknik Rekayasa Multimedia (TRM) POLITALA menyelenggarakan Kuliah Pakar Internasional bertajuk "Standar Pipeline Produksi Animasi 3D Studio Hollywood". Kegiatan ini bertujuan memberikan wawasan praktis mengenai tahapan kerja riil di industri perfilman internasional, mulai dari concept art, digital sculpting, topology & rigging, shading, texturing hingga visual rendering berstandar bioskop.',
            'rundown' => [
                ['time' => '08:30 - 09:00 WITA', 'activity' => 'Registrasi Ulang Peserta Luring & Verifikasi Zoom Meeting'],
                ['time' => '09:00 - 09:15 WITA', 'activity' => 'Pembukaan Acara, Doa & Sambutan Koordinator Program Studi D-IV TRM'],
                ['time' => '09:15 - 10:45 WITA', 'activity' => 'Sesi I: Anatomi Pipeline Animasi 3D & Live Breakdown Karakter Blockbuster'],
                ['time' => '10:45 - 11:45 WITA', 'activity' => 'Sesi II: Kiat Menembus Karir Global, Portofolio ArtStation & Standardisasi DUDI'],
                ['time' => '11:45 - 12:20 WITA', 'activity' => 'Sesi Diskusi & Tanya Jawab Interaktif (Q&A) Beserta Review Portofolio Acak Mahasiswa'],
                ['time' => '12:20 - 12:30 WITA', 'activity' => 'Penyerahan Sertifikat Narasumber, Foto Bersama & Penutupan']
            ],
            'benefits' => [
                'E-Sertifikat Resmi Berbobot SKP Kemahasiswaan',
                'Starter Asset 3D Project Files & Dokumen Pipeline Checklist (PDF/Blender)',
                'Snack & Konsumsi (Khusus Peserta Luring di Auditorium)',
                'Rekaman Video Sesi Penuh & Notulensi Materi'
            ],
            'requirements' => [
                'Terbuka bagi mahasiswa D-IV TRM, program studi serumpun, dan praktisi pemula multimedia.',
                'Peserta luring diwajibkan membawa kartu tanda mahasiswa (KTM) atau bukti registrasi digital.',
                'Peserta daring diwajibkan bergabung 15 menit sebelum acara dimulai dengan format nama: [Institusi] - [Nama Lengkap].'
            ],
            'contact_person' => '0812-5555-8821 (Humas TRM POLITALA)',
            'registration_url' => 'https://pmb.politala.ac.id/agenda-daftar'
        ],
        'workshop-pembuatan-game-interaktif-unreal-engine-5' => [
            'slug' => 'workshop-pembuatan-game-interaktif-unreal-engine-5',
            'title' => 'Workshop Hands-On: Pembuatan Prototipe Game 3D Menggunakan Unreal Engine 5 & Blueprint',
            'category' => 'Workshop Praktik',
            'status' => 'Pendaftaran Dibuka',
            'status_color' => 'emerald',
            'mode' => 'Luring Penuh di Laboratorium Komputasi TRM',
            'day' => '05',
            'month' => 'NOV',
            'year' => '2026',
            'date_full' => 'Kamis, 05 November 2026',
            'time' => '08:30 - 16:30 WITA',
            'location' => 'Laboratorium Game & Komputasi TRM POLITALA',
            'location_sub' => 'Gedung TI Lantai 2, Kampus Terpadu Pelaihari',
            'fee' => 'Gratis (Prioritas Mahasiswa Aktif)',
            'quota' => '40 Peserta (Kapasitas Workstation Lab)',
            'speaker' => [
                'name' => 'Rian Hidayat, S.Kom.',
                'role' => 'Lead Gameplay Programmer & Technical Designer',
                'company' => 'Studio Game Nasional & Asosiasi Game Indonesia (AGI)',
                'bio' => 'Spesialis perancangan arsitektur game berbasis Unreal Engine 5 dengan pengalaman merilis 3 judul game PC di platform Steam. Berfokus pada sistem gameplay mechanics, optimasi shader Lumen & Nanite.'
            ],
            'description' => 'Pelatihan teknis intensif selama satu hari penuh bagi mahasiswa D-IV TRM untuk mempelajari logika visual scripting Blueprint di Unreal Engine 5. Peserta akan dibimbing membuat game aksi 3D dari nol hingga siap dipublish menjadi prototipe executable.',
            'rundown' => [
                ['time' => '08:30 - 09:00 WITA', 'activity' => 'Check-in Peserta & Setup Environment UE5 di PC Workstation Lab'],
                ['time' => '09:00 - 11:30 WITA', 'activity' => 'Modul 1: Pengenalan Interface UE5, Setup Character Controller & Input Mapping'],
                ['time' => '11:30 - 13:00 WITA', 'activity' => 'Istirahat, Sholat Dzuhur & Makan Siang'],
                ['time' => '13:00 - 15:00 WITA', 'activity' => 'Modul 2: Implementasi AI Sederhana, Interaksi Objek & Collision System'],
                ['time' => '15:00 - 16:15 WITA', 'activity' => 'Modul 3: Level Design, Lighting Lumen Dasar & Build Packaging .exe'],
                ['time' => '16:15 - 16:30 WITA', 'activity' => 'Playtest Bersama, Evaluasi Singkat & Pembagian Sertifikat Pelatihan']
            ],
            'benefits' => [
                'Sertifikat Pelatihan Teknis UE5 dari Lab Multimedia',
                'Kompilasi Sample Project & Free 3D Environment Asset Pack',
                'Makan Siang & Coffee Break',
                'Pendampingan Pembuatan Portofolio Game PBL'
            ],
            'requirements' => [
                'Telah mengambil atau sedang menempuh mata kuliah Algoritma & Pemrograman.',
                'Workstation PC spesifikasi RTX telah disediakan di lab (peserta disarankan membawa flashdisk/harddisk eksternal minimal 32GB).'
            ],
            'contact_person' => '0813-4444-9912 (Lab Komputasi TRM)',
            'registration_url' => 'https://pmb.politala.ac.id/agenda-daftar'
        ],
        'seminar-nasional-vokasi-teknologi-imersif-industri-5' => [
            'slug' => 'seminar-nasional-vokasi-teknologi-imersif-industri-5',
            'title' => 'Seminar Nasional Vokasi: Peluang & Masa Depan Teknologi Imersif (XR) di Era Transformasi Digital',
            'category' => 'Seminar Nasional',
            'status' => 'Segera Dibuka',
            'status_color' => 'amber',
            'mode' => 'Hybrid (Gedung TI Lt. 3 & YouTube Live)',
            'day' => '14',
            'month' => 'NOV',
            'year' => '2026',
            'date_full' => 'Sabtu, 14 November 2026',
            'time' => '09:00 - 14:00 WITA',
            'location' => 'Hall Pertemuan Gedung TI Lt. 3 POLITALA',
            'location_sub' => 'Kampus Politeknik Negeri Tanah Laut & Kanal YouTube TRM POLITALA',
            'fee' => 'Gratis (Mahasiswa, Dosen & Praktisi)',
            'quota' => '150 Peserta Luring & 500 Peserta Daring',
            'speaker' => [
                'name' => 'Dr. Ir. Hendra Gunawan, S.T., M.Kom.',
                'role' => 'Peneliti Utama Teknologi Virtual Reality & Dosen Tamu Industri',
                'company' => 'Pusat Riset Komputasi Cerdas & Immersive Media Indonesia',
                'bio' => 'Peneliti aktif yang telah mempublikasikan puluhan riset terapan di bidang spatial computing, haptic feedback, dan simulasi pelatihan vokasi berbasis mixed reality di sektor maritim dan pertambangan.'
            ],
            'description' => 'Seminar ilmiah terapan yang mengkaji adopsi teknologi Virtual Reality (VR), Augmented Reality (AR), dan Mixed Reality (MR) dalam menyelesaikan tantangan nyata di sektor industri modern dan pendidikan vokasi masa depan.',
            'rundown' => [
                ['time' => '08:30 - 09:00 WITA', 'activity' => 'Registrasi Tamu Undangan & Sivitas Akademika'],
                ['time' => '09:00 - 09:30 WITA', 'activity' => 'Keynote Speech: Arah Pengembangan Kurikulum Vokasi Spasial oleh Direktur POLITALA'],
                ['time' => '09:30 - 11:30 WITA', 'activity' => 'Sesi Utama: Transformasi XR pada Industri Manufaktur, Kesehatan & Simulasi Medis'],
                ['time' => '11:30 - 12:45 WITA', 'activity' => 'Live Demo Perangkat Meta Quest XR & Apple Vision Pro oleh Tim Riset TRM'],
                ['time' => '12:45 - 13:45 WITA', 'activity' => 'Ishoma (Istirahat Sholat & Makan Siang)'],
                ['time' => '13:45 - 14:00 WITA', 'activity' => 'Rangkuman Diskusi Ilmiah, Penyerahan Plakat & Penutupan']
            ],
            'benefits' => [
                'E-Sertifikat Nasional Ber-SKP Resmi',
                'Prosiding Seminar Digital & Kumpulan Makalah Terapan',
                'Kesempatan Menjajal Demo Perangkat XR Terbaru di Booth Pameran',
                'Networking Bersama Industri Mitra & Dosen Komputasi se-Kalimantan'
            ],
            'requirements' => [
                'Terbuka bagi mahasiswa, dosen, akademisi, dan praktisi teknologi informasi umum.',
                'Diharapkan mengisi formulir kehadiran digital saat acara berlangsung.'
            ],
            'contact_person' => '0812-7777-6655 (Sekretariat Seminar TRM)',
            'registration_url' => 'https://pmb.politala.ac.id/agenda-daftar'
        ],
        'multimedia-expo-pameran-desain-interaktif-mahasiswa' => [
            'slug' => 'multimedia-expo-pameran-desain-interaktif-mahasiswa',
            'title' => 'Multimedia Expo 2026: Gelar Karya Inovasi Game, Animasi 3D, UI/UX & Pameran Produk Capstone',
            'category' => 'Pameran & Expo',
            'status' => 'Segera Dibuka',
            'status_color' => 'blue',
            'mode' => 'Luring di Plaza Terbuka Kampus POLITALA',
            'day' => '02',
            'month' => 'DES',
            'year' => '2026',
            'date_full' => 'Rabu, 02 Desember 2026',
            'time' => '08:00 - 17:00 WITA',
            'location' => 'Plaza Terbuka & Gedung Terpadu POLITALA',
            'location_sub' => 'Kompleks Politeknik Negeri Tanah Laut, Pelaihari',
            'fee' => 'Gratis & Terbuka untuk Umum / Siswa SMA/SMK',
            'quota' => 'Terbuka Bebas Tanpa Batasan Kuota',
            'speaker' => [
                'name' => 'Showcase Karya Mahasiswa TRM & Kurator Tamu DUDI',
                'role' => 'Reviewer Karya Industri Game & Agensi Desain Digital',
                'company' => 'Kolaborasi Bersama Studio Mitra Industri Kreatif',
                'bio' => 'Menghadirkan lebih dari 50 karya terbaik hasil perkuliahan Project-Based Learning (PBL) dan Tugas Akhir mahasiswa TRM dalam bentuk game playtest, screening film animasi, simulator VR interaktif, serta showcase mobile app.'
            ],
            'description' => 'Ajang tahunan terbesar Program Studi D-IV TRM POLITALA yang menampilkan portofolio karya nyata mahasiswa kepada mitra industri, calon mahasiswa, dan masyarakat luas. Diisi dengan talkshow santai, booth interaktif, turnamen mini game buatan mahasiswa, dan panggung apresiasi karya kreatif.',
            'rundown' => [
                ['time' => '08:00 - 08:30 WITA', 'activity' => 'Open Gate Pameran & Registrasi Pengunjung'],
                ['time' => '08:30 - 09:15 WITA', 'activity' => 'Grand Opening Ceremony & Pemotongan Pita oleh Pimpinan POLITALA'],
                ['time' => '09:15 - 12:00 WITA', 'activity' => 'Tur Pameran Booth, Playtest Game Mahasiswa & Screening Animasi 3D'],
                ['time' => '12:00 - 13:30 WITA', 'activity' => 'Istirahat & Akustik Music Mahasiswa'],
                ['time' => '13:30 - 15:30 WITA', 'activity' => 'Pitches Capstone Project di Depan Kurator Mitra Industri DUDI'],
                ['time' => '15:30 - 17:00 WITA', 'activity' => 'Awarding Night Karya Terbaik Pilihan Pengunjung & Penutupan Expo']
            ],
            'benefits' => [
                'Pengalaman Menjajal Game & Simulasi VR Orisinal Mahasiswa TRM',
                'Souvenir Menarik & Doorprize Eksklusif untuk Pengunjung',
                'Konsultasi Pendaftaran Mahasiswa Baru D-IV TRM di Booth PMB',
                'E-Certificate Kunjungan Edukasi bagi Siswa SMA/SMK yang Hadir'
            ],
            'requirements' => [
                'Terbuka untuk umum, pelajar SMA/SMK/MA sederajat, orang tua, dan penggiat industri kreatif.',
                'Gratis tiket masuk, pengunjung dapat melakukan scan QR di pintu masuk untuk memperoleh pass pengunjung.'
            ],
            'contact_person' => '0811-9988-7766 (Panitia Expo TRM)',
            'registration_url' => 'https://pmb.politala.ac.id/agenda-daftar'
        ]
    ];

    // Pick active event by slug or fallback to the first one
    $currentSlug = $slug ?? 'kuliah-pakar-pipeline-animasi-3d-studio-hollywood';
    $event = $allEvents[$currentSlug] ?? $allEvents['kuliah-pakar-pipeline-animasi-3d-studio-hollywood'];
@endphp

@section('title', $event['title'] . ' - Agenda D-IV TRM POLITALA')
@section('meta_description', Str::limit($event['description'], 155))

@section('content')
<!-- Top Hero Header -->
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-28 sm:pt-32 lg:pt-36 pb-10 lg:pb-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb Navigation -->
        <nav class="flex flex-wrap items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-4">
            <a href="{{ route('home') }}" class="hover:text-brand-primary flex items-center gap-1.5 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Beranda</span>
            </a>
            <span class="text-slate-300">/</span>
            <span class="text-brand-muted">Informasi</span>
            <span class="text-slate-300">/</span>
            <a href="{{ route('public.events.index') }}" class="hover:text-brand-primary transition-colors">
                Agenda Kegiatan
            </a>
            <span class="text-slate-300">/</span>
            <span class="text-brand-secondary font-bold truncate max-w-xs sm:max-w-sm">{{ $event['category'] }}</span>
        </nav>

        <!-- Category & Status Badges -->
        <div class="flex flex-wrap items-center gap-2.5 mb-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-brand-primary text-white shadow-xs">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-sky animate-ping"></span>
                {{ $event['category'] }}
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                {{ $event['status'] }}
            </span>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi Agenda]
            </span>
        </div>

        <!-- Main Title -->
        <h1 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-black text-brand-dark tracking-tight leading-tight sm:leading-snug max-w-5xl">
            {{ $event['title'] }}
        </h1>

        <!-- Agenda Metadata Ribbon -->
        <div class="mt-6 pt-6 border-t border-slate-200/80 flex flex-wrap items-center justify-between gap-4 text-xs text-brand-muted">
            <div class="flex flex-wrap items-center gap-4 sm:gap-6">
                <!-- Date -->
                <div class="flex items-center gap-2 font-medium text-slate-700">
                    <div class="w-7 h-7 rounded-lg bg-brand-primary-light text-brand-primary flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span>{{ $event['date_full'] }}</span>
                </div>

                <div class="hidden sm:block h-6 w-px bg-slate-200"></div>

                <!-- Time -->
                <div class="flex items-center gap-2 font-medium text-slate-700">
                    <div class="w-7 h-7 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span>{{ $event['time'] }}</span>
                </div>

                <div class="hidden sm:block h-6 w-px bg-slate-200"></div>

                <!-- Location -->
                <div class="flex items-center gap-2 font-medium text-slate-700">
                    <div class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span class="truncate max-w-xs">{{ $event['location'] }}</span>
                </div>
            </div>

            <!-- Action Tools -->
            <div class="flex items-center gap-2">
                <button type="button" onclick="window.print()" class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-brand-dark font-semibold transition-colors flex items-center gap-1.5 shadow-2xs" title="Cetak Brosur Agenda">
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    <span>Cetak</span>
                </button>
                <a href="{{ route('public.events.index') }}" class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-brand-primary font-semibold transition-colors flex items-center gap-1.5 shadow-2xs">
                    <span>← Semua Agenda</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Content & Sidebar Container -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
        
        <!-- Left Main Narrative Column (8 cols) -->
        <main class="lg:col-span-8 space-y-10">

            <!-- Featured Banner Card -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-brand-primary-dark via-brand-primary to-brand-secondary text-white p-7 sm:p-10 shadow-xl">
                <!-- Ambient Glow & Pattern -->
                <div class="absolute inset-0 bg-[radial-gradient(#97D7FF_1.2px,transparent_1.2px)] [background-size:24px_24px] opacity-15 pointer-events-none"></div>
                <div class="absolute -right-16 -bottom-16 w-80 h-80 rounded-full bg-brand-sky/20 blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                    <div class="flex items-center gap-5">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white flex flex-col items-center justify-center font-black shrink-0 shadow-lg">
                            <span class="text-3xl sm:text-4xl leading-none text-brand-cream">{{ $event['day'] }}</span>
                            <span class="text-xs uppercase font-extrabold tracking-widest text-brand-sky mt-1">{{ $event['month'] }}</span>
                            <span class="text-[10px] text-slate-300 font-mono">{{ $event['year'] }}</span>
                        </div>
                        <div>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-white/15 text-[10px] font-bold uppercase tracking-wider text-brand-cream mb-1 border border-white/20">
                                {{ $event['category'] }}
                            </span>
                            <h2 class="text-lg sm:text-xl font-extrabold leading-snug text-white">
                                {{ $event['title'] }}
                            </h2>
                            <p class="text-xs text-brand-sky/90 mt-1 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>{{ $event['mode'] }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 1. Deskripsi Agenda -->
            <section class="space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-200/80 pb-3">
                    <div class="w-2 h-6 rounded-full bg-brand-primary"></div>
                    <h2 class="text-xl sm:text-2xl font-bold text-brand-dark">Tentang Kegiatan Ini</h2>
                </div>
                <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed space-y-4 text-sm sm:text-base">
                    <p>{{ $event['description'] }}</p>
                    <p>
                        Melalui partisipasi dalam agenda ini, mahasiswa tidak hanya mendapatkan pemahaman teoritis, tetapi juga melihat secara langsung standar pipeline dan portofolio yang dicari oleh studio dan institusi terkemuka.
                    </p>
                </div>
            </section>

            <!-- 2. Profil Pemateri / Narasumber -->
            <section class="space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-200/80 pb-3">
                    <div class="w-2 h-6 rounded-full bg-brand-secondary"></div>
                    <h2 class="text-xl sm:text-2xl font-bold text-brand-dark">Narasumber &amp; Instruktur</h2>
                </div>
                
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-7 shadow-xs flex flex-col sm:flex-row items-start gap-5 hover:border-brand-primary/40 transition-all">
                    <!-- Avatar Profile -->
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-tr from-brand-primary to-brand-secondary text-white font-black text-xl sm:text-2xl flex items-center justify-center shrink-0 shadow-md">
                        <svg class="w-10 h-10 text-brand-cream opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>

                    <div class="space-y-2 flex-1">
                        <div>
                            <span class="text-[10px] uppercase font-bold tracking-wider text-brand-secondary">Pemateri Utama</span>
                            <h3 class="text-lg font-bold text-brand-dark leading-snug">{{ $event['speaker']['name'] }}</h3>
                            <p class="text-xs font-semibold text-brand-primary">{{ $event['speaker']['role'] }}</p>
                            <p class="text-xs text-slate-500">{{ $event['speaker']['company'] }}</p>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed pt-1 border-t border-slate-100">
                            {{ $event['speaker']['bio'] }}
                        </p>
                    </div>
                </div>
            </section>

            <!-- 3. Susunan Acara / Rundown -->
            <section class="space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-200/80 pb-3">
                    <div class="w-2 h-6 rounded-full bg-amber-500"></div>
                    <h2 class="text-xl sm:text-2xl font-bold text-brand-dark">Susunan Acara (Rundown)</h2>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
                    <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/70 flex items-center justify-between text-xs font-bold text-slate-600 uppercase tracking-wider">
                        <span>Waktu Pelaksanaan</span>
                        <span>Sesi &amp; Rincian Kegiatan</span>
                    </div>
                    <div class="divide-y divide-slate-100 text-xs sm:text-sm">
                        @foreach ($event['rundown'] as $r)
                            <div class="p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 hover:bg-slate-50/60 transition-colors">
                                <span class="font-mono font-bold text-brand-primary text-xs shrink-0 sm:w-44 bg-brand-primary-light px-2.5 py-1 rounded-lg">
                                    {{ $r['time'] }}
                                </span>
                                <span class="font-medium text-slate-800 flex-1">
                                    {{ $r['activity'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- 4. Fasilitas & Manfaat Peserta -->
            <section class="space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-200/80 pb-3">
                    <div class="w-2 h-6 rounded-full bg-emerald-500"></div>
                    <h2 class="text-xl sm:text-2xl font-bold text-brand-dark">Benefit &amp; Fasilitas Peserta</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($event['benefits'] as $b)
                        <div class="p-4 rounded-xl bg-white border border-slate-200/80 shadow-xs flex items-start gap-3 hover:border-emerald-500/40 transition-colors">
                            <div class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm font-medium text-slate-800 leading-snug">{{ $b }}</span>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- 5. Syarat & Ketentuan Peserta -->
            <section class="space-y-3 bg-brand-surface p-6 rounded-2xl border border-slate-200/80">
                <h3 class="font-bold text-sm text-brand-dark flex items-center gap-2">
                    <svg class="w-4 h-4 text-brand-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Ketentuan &amp; Persyaratan Kehadiran:</span>
                </h3>
                <ul class="space-y-2 text-xs sm:text-sm text-slate-600 list-disc list-inside">
                    @foreach ($event['requirements'] as $req)
                        <li>{{ $req }}</li>
                    @endforeach
                </ul>
            </section>

            <!-- Share Buttons Bar -->
            <div class="pt-6 border-t border-slate-200/80 flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold text-slate-600">Bagikan Agenda:</span>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($event['title'] . ' ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" class="p-2 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white transition-colors" title="Bagikan ke WhatsApp">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.044c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824z" />
                        </svg>
                    </a>
                    <button type="button" onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan agenda berhasil disalin ke clipboard!');" class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <span>Salin Link</span>
                    </button>
                </div>

                <a href="{{ route('public.events.index') }}" class="text-xs font-bold text-brand-primary hover:underline">
                    Lihat Semua Jadwal Kegiatan →
                </a>
            </div>

        </main>

        <!-- Right Sticky Sidebar Column (4 cols) -->
        <aside class="lg:col-span-4 space-y-6 lg:sticky lg:top-28">

            <!-- Card 1: Registration Box -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-lg space-y-5 relative overflow-hidden">
                <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-brand-primary via-brand-secondary to-brand-sky"></div>

                <div>
                    <span class="text-[10px] uppercase font-bold tracking-wider text-brand-secondary">Status Registrasi</span>
                    <h3 class="text-xl font-black text-brand-dark leading-tight mt-0.5">Pendaftaran Peserta</h3>
                    <p class="text-xs text-slate-500 mt-1">Biaya: <span class="font-bold text-emerald-600">{{ $event['fee'] }}</span></p>
                </div>

                <!-- Quota Tracker -->
                <div class="space-y-1.5 bg-slate-50 p-3.5 rounded-2xl border border-slate-100 text-xs">
                    <div class="flex items-center justify-between font-bold text-slate-700">
                        <span>Kapasitas Kursi</span>
                        <span class="text-brand-primary">{{ $event['quota'] }}</span>
                    </div>
                    <div class="w-full h-2 rounded-full bg-slate-200 overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-brand-primary to-emerald-500 rounded-full" style="width: 65%;"></div>
                    </div>
                    <p class="text-[10px] text-slate-400">Pendaftaran akan ditutup otomatis setelah kuota terpenuhi.</p>
                </div>

                <!-- Registration Primary CTA -->
                <div class="space-y-2.5 pt-1">
                    <a href="https://pmb.politala.ac.id" target="_blank" rel="noopener noreferrer" class="w-full py-3.5 px-4 rounded-xl bg-brand-primary text-white font-bold text-xs hover:bg-brand-primary-hover shadow-md hover:shadow-lg transition-all text-center flex items-center justify-center gap-2 group">
                        <span>Daftar Sekarang (Online)</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>

                    <!-- Add to Calendar Button -->
                    @php
                        $googleCalUrl = "https://calendar.google.com/calendar/render?action=TEMPLATE&text=" . urlencode($event['title']) . "&dates=20261028T010000Z/20261028T043000Z&details=" . urlencode($event['description']) . "&location=" . urlencode($event['location']);
                    @endphp
                    <a href="{{ $googleCalUrl }}" target="_blank" rel="noopener noreferrer" class="w-full py-2.5 px-4 rounded-xl border border-slate-200 hover:border-brand-primary/40 bg-slate-50 hover:bg-white text-slate-700 text-xs font-semibold transition-all text-center flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-brand-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Simpan ke Google Calendar</span>
                    </a>
                </div>

                <!-- Contact Person Info -->
                <div class="pt-4 border-t border-slate-100 text-xs text-slate-500 space-y-1">
                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Narahubung Panitia:</span>
                    <p class="font-bold text-brand-dark flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.044c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824z" />
                        </svg>
                        <span>{{ $event['contact_person'] }}</span>
                    </p>
                </div>
            </div>

            <!-- Card 2: Lokasi & Venue -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-3">
                <h4 class="font-bold text-sm text-brand-dark flex items-center gap-2">
                    <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <span>Lokasi Kampus</span>
                </h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    {{ $event['location'] }}
                </p>
                <p class="text-[11px] text-slate-500">
                    {{ $event['location_sub'] }}
                </p>
                <div class="pt-2">
                    <a href="https://maps.google.com/?q=Politeknik+Negeri+Tanah+Laut" target="_blank" rel="noopener noreferrer" class="text-xs font-bold text-brand-primary hover:underline flex items-center gap-1">
                        <span>Buka di Google Maps</span>
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Card 3: Agenda Lainnya -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                    <h4 class="font-bold text-sm text-brand-dark">Agenda Mendatang Lainnya</h4>
                    <a href="{{ route('public.events.index') }}" class="text-[11px] font-bold text-brand-primary hover:underline">Semua</a>
                </div>

                <div class="space-y-3">
                    @foreach ($allEvents as $otherSlug => $oEv)
                        @if ($otherSlug !== $currentSlug)
                            <a href="{{ route('public.events.show', $otherSlug) }}" class="group flex items-start gap-3 p-2.5 rounded-xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                                <div class="w-11 h-11 rounded-xl bg-brand-primary-light text-brand-primary font-bold flex flex-col items-center justify-center shrink-0 text-xs">
                                    <span class="leading-none">{{ $oEv['day'] }}</span>
                                    <span class="text-[9px] uppercase font-bold">{{ $oEv['month'] }}</span>
                                </div>
                                <div class="space-y-0.5 flex-1 min-w-0">
                                    <span class="text-[9px] font-bold text-brand-secondary uppercase">{{ $oEv['category'] }}</span>
                                    <h5 class="text-xs font-bold text-brand-dark group-hover:text-brand-primary transition-colors line-clamp-2 leading-snug">
                                        {{ $oEv['title'] }}
                                    </h5>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

        </aside>

    </div>
</div>
@endsection

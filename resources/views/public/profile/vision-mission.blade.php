@extends('layouts.public')

@section('title', 'Visi & Misi - D-IV TRM POLITALA')

@section('content')
<!-- Header Page -->
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-24 sm:pt-28 lg:pt-32 pb-8 sm:pb-10 lg:pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Profil</span>
            <span>/</span>
            <span class="text-brand-dark">Visi &amp; Misi</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4 mt-3 sm:mt-4">
            <div class="space-y-1.5">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">
                    {{ $profile->title ?? 'Visi, Misi & Tujuan' }}
                </h1>
                <p class="text-sm sm:text-base text-brand-muted">
                    Arah strategis, komitmen pengembangan keilmuan, dan pilar keunggulan vokasi rekayasa multimedia
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Rencana Strategis TRM {{ $targetYear ?? '2030' }}</span>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12 lg:py-14 space-y-12 sm:space-y-14">
    <!-- Visi Box (Highlight Banner) -->
    <div class="rounded-3xl bg-gradient-to-br from-brand-primary via-brand-secondary to-brand-primary-dark text-white p-8 sm:p-12 lg:p-14 shadow-xl relative overflow-hidden">
        <!-- Ambient Radial Background Glow -->
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-brand-sky/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-brand-complimentary/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 space-y-6">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/20 backdrop-blur-md text-brand-cream text-xs font-black uppercase tracking-wider border border-white/20">
                    <span class="w-2 h-2 rounded-full bg-brand-cream animate-pulse"></span>
                    <span>Visi Program Studi (Menuju {{ $targetYear ?? '2030' }})</span>
                </span>
                <span class="text-xs font-semibold text-white/70">
                    D-IV Teknologi Rekayasa Multimedia POLITALA
                </span>
            </div>

            <div class="relative">
                <svg class="w-12 h-12 text-white/20 absolute -top-4 -left-3 pointer-events-none" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                </svg>
                <blockquote class="text-xl sm:text-2xl lg:text-3xl font-black leading-snug tracking-tight pl-6 sm:pl-8 text-white">
                    "{{ $vision ?? 'Menjadi pusat pendidikan tinggi vokasi unggulan dan rujukan di bidang teknologi rekayasa multimedia terapan yang berdaya saing global, inovatif, dan berjiwa wirausaha pada tahun 2030.' }}"
                </blockquote>
            </div>

            <div class="pt-6 border-t border-white/20 flex flex-wrap items-center justify-between gap-4 text-xs text-white/80">
                <span class="flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    <span>Fokus: Game Development, 3D Animation &amp; Immersive Tech</span>
                </span>
                <span class="font-bold text-brand-cream">
                    Kesesuaian Standar Vokasi Nasional (KKNI Level 6)
                </span>
            </div>
        </div>
    </div>

    @php
        $defaultMissions = [
            [
                'number' => 1,
                'title' => 'Pendidikan Vokasi Selaras Industri & OBE',
                'description' => 'Menyelenggarakan pendidikan sarjana terapan berbasis Outcome-Based Education (OBE) dan Project-Based Learning (PBL) yang memadukan rekayasa perangkat lunak dan estetika seni digital sesuai standar industri kreatif.',
            ],
            [
                'number' => 2,
                'title' => 'Penelitian Terapan & Inovasi Tepat Guna',
                'description' => 'Mengembangkan penelitian terapan dan hilirisasi produk karya multimedia interaktif (game, animasi, dan realitas virtual) yang berdaya guna serta bernilai paten dan Hak Kekayaan Intelektual (HKI).',
            ],
            [
                'number' => 3,
                'title' => 'Pengabdian Masyarakat & Transformasi Digital',
                'description' => 'Menerapkan produk teknologi rekayasa multimedia untuk memberdayakan masyarakat, mendukung digitalisasi UMKM daerah, instansi pemerintah, dan sektor pendidikan terapan.',
            ],
            [
                'number' => 4,
                'title' => 'Kemitraan Strategis Bersama DUDI & Asosiasi',
                'description' => 'Memperluas kolaborasi strategis dengan studio game, rumah produksi animasi, dan ekosistem industri kreatif nasional maupun global dalam skema magang, pengajaran praktisi, dan sertifikasi kompetensi.',
            ],
        ];

        $missionList = !empty($missions) && is_array($missions) ? $missions : $defaultMissions;
    @endphp

    <!-- Misi Cards Grid -->
    <div class="space-y-6 mt-14 sm:mt-20">
        <div class="space-y-2">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-light text-brand-primary text-xs font-bold uppercase tracking-wider">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-primary"></span>
                <span>Pilar Pelaksanaan Tridharma</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-brand-dark tracking-tight mt-3">
                Misi Program Studi
            </h2>
            <p class="text-sm text-brand-muted mt-2">
                Empat pilar utama pelaksanaan Tridharma Perguruan Tinggi dan kemitraan industri di D-IV TRM POLITALA
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8 sm:mt-10">
            @foreach($missionList as $idx => $m)
                <div class="bg-white p-7 sm:p-8 rounded-3xl border border-slate-200/80 shadow-xs hover:border-brand-primary/40 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden mt-2 sm:mt-0">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="w-12 h-12 rounded-2xl bg-brand-primary-light text-brand-primary flex items-center justify-center font-black text-lg group-hover:bg-brand-primary group-hover:text-white transition-colors duration-300 shadow-2xs">
                                0{{ $m['number'] ?? ($idx + 1) }}
                            </span>
                            <span class="text-xs font-bold uppercase tracking-wider text-brand-muted group-hover:text-brand-secondary transition-colors">
                                Misi Strategis
                            </span>
                        </div>
                        <h3 class="font-extrabold text-lg text-brand-dark group-hover:text-brand-primary transition-colors mt-2">
                            {{ $m['title'] ?? 'Misi Program Studi' }}
                        </h3>
                        <p class="text-xs sm:text-sm text-brand-muted leading-relaxed mt-2">
                            {{ $m['description'] ?? '-' }}
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center text-xs font-bold text-brand-primary gap-1 group-hover:translate-x-1 transition-transform">
                        <span>Pilar Komitmen #0{{ $m['number'] ?? ($idx + 1) }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @php
        $defaultGoals = [
            [
                'title' => 'Lulusan Kompeten & Bersertifikasi Profesi',
                'description' => 'Menghasilkan Sarjana Terapan Komputer (S.Tr.Kom.) berkarakter unggul, kompeten di bidang rekayasa multimedia, dan tersertifikasi kompetensi bertaraf nasional (BNSP) maupun internasional.',
            ],
            [
                'title' => 'Produk Karya Siap Komersial & Bernilai HKI',
                'description' => 'Menghasilkan produk riset terapan, game komersial, animasi 3D, dan media imersif yang bernilai paten, Hak Kekayaan Intelektual, serta diakui oleh komunitas industri kreatif.',
            ],
            [
                'title' => 'Inkubasi Technopreneurship Kreatif Mahasiswa',
                'description' => 'Menumbuhkan jiwa wirausaha teknologi (technopreneur) dan inkubasi studio rintisan digital mahasiswa melalui teaching factory dan kolaborasi inkubator bisnis kampus.',
            ],
            [
                'title' => 'Tata Kelola Unggul & Akreditasi Berkualitas',
                'description' => 'Mewujudkan tata kelola program studi yang modern, transparan, akuntabel, dan berdaya saing berlandaskan sistem penjaminan mutu internal berkelanjutan menuju akreditasi Unggul.',
            ],
        ];

        $goalList = !empty($goals) && is_array($goals) ? $goals : $defaultGoals;
    @endphp

    <!-- Tujuan Program Studi (Educational Goals) -->
    <div class="space-y-6 mt-14 sm:mt-20">
        <div class="space-y-2">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-secondary/10 text-brand-secondary text-xs font-bold uppercase tracking-wider">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-secondary"></span>
                <span>Sasaran Mutu &amp; Capaian</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-brand-dark tracking-tight mt-3">
                Tujuan Program Studi (Educational Objectives)
            </h2>
            <p class="text-sm text-brand-muted mt-2">
                Target capaian konkret dalam mencetak lulusan berdaya saing tinggi dan kelembagaan prodi bereputasi
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-8 sm:mt-10">
            @foreach($goalList as $idx => $g)
                <div class="p-6 sm:p-7 rounded-3xl bg-white border border-slate-200/80 shadow-xs hover:border-brand-secondary/40 hover:shadow-md transition-all duration-300 flex items-start gap-4 mt-2 sm:mt-0">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 shadow-2xs">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="space-y-1.5">
                        <h4 class="font-bold text-base text-brand-dark mt-1">
                            {{ $g['title'] ?? 'Tujuan Program Studi' }}
                        </h4>
                        <p class="text-xs sm:text-sm text-brand-muted leading-relaxed mt-2">
                            {{ $g['description'] ?? '-' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Nilai-Nilai Utama (Core Values) -->
    <div class="bg-brand-surface rounded-3xl border border-slate-200/80 p-8 sm:p-10 shadow-xs space-y-6 mt-14 sm:mt-20">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-xl sm:text-2xl font-extrabold text-brand-dark">Nilai Utama Budaya Akademik (Core Values)</h3>
                <p class="text-xs sm:text-sm text-brand-muted mt-1">Prinsip dasar yang menjiwai seluruh sivitas akademika D-IV Teknologi Rekayasa Multimedia</p>
            </div>
            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-white border border-slate-200 text-brand-primary">
                Budaya TRM Unggul
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-4 border-t border-slate-200/80">
            <div class="p-4 rounded-2xl bg-white border border-slate-200/70 space-y-1 mt-2 sm:mt-0">
                <span class="text-xs font-black text-brand-primary">01. Integrity</span>
                <p class="text-xs text-brand-muted mt-1">Menjunjung tinggi kejujuran, etika profesi rekayasa, dan tanggung jawab akademik.</p>
            </div>
            <div class="p-4 rounded-2xl bg-white border border-slate-200/70 space-y-1 mt-2 sm:mt-0">
                <span class="text-xs font-black text-brand-secondary">02. Innovation</span>
                <p class="text-xs text-brand-muted mt-1">Kreatif dalam melahirkan solusi media interaktif bernilai terapan dan komersial.</p>
            </div>
            <div class="p-4 rounded-2xl bg-white border border-slate-200/70 space-y-1 mt-2 sm:mt-0">
                <span class="text-xs font-black text-brand-complimentary">03. Collaboration</span>
                <p class="text-xs text-brand-muted mt-1">Sinergi aktif bersama dunia industri, studio kreatif, dan masyarakat luas.</p>
            </div>
            <div class="p-4 rounded-2xl bg-white border border-slate-200/70 space-y-1 mt-2 sm:mt-0">
                <span class="text-xs font-black text-emerald-600">04. Competence</span>
                <p class="text-xs text-brand-muted mt-1">Menguasai kecakapan teknis mutakhir yang tersertifikasi standar industri global.</p>
            </div>
        </div>
    </div>

    <!-- Related Navigation Links -->
    <div class="pt-8 border-t border-slate-200 mt-16 sm:mt-24">
        <h4 class="text-xs font-bold uppercase tracking-wider text-brand-muted mb-4 mt-2">Informasi Terkait Profil TRM:</h4>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
            <a href="{{ route('public.profile.history') }}" class="p-5 rounded-2xl bg-white border border-slate-200/80 hover:border-brand-primary/40 hover:shadow-md transition-all group flex items-center justify-between mt-2 sm:mt-0">
                <div>
                    <span class="text-xs font-bold text-brand-dark group-hover:text-brand-primary block">Sejarah Program Studi</span>
                    <span class="text-[11px] text-brand-muted mt-1 block">Tonggak pendirian &amp; SK resmi</span>
                </div>
                <svg class="w-4 h-4 text-brand-muted group-hover:text-brand-primary group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            <a href="{{ route('public.academic.cpl') }}" class="p-5 rounded-2xl bg-white border border-slate-200/80 hover:border-brand-primary/40 hover:shadow-md transition-all group flex items-center justify-between mt-2 sm:mt-0">
                <div>
                    <span class="text-xs font-bold text-brand-dark group-hover:text-brand-primary block">Capaian Pembelajaran (CPL)</span>
                    <span class="text-[11px] text-brand-muted mt-1 block">Standar kompetensi lulusan</span>
                </div>
                <svg class="w-4 h-4 text-brand-muted group-hover:text-brand-primary group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            <a href="{{ route('public.profile.lecturers') }}" class="p-5 rounded-2xl bg-white border border-slate-200/80 hover:border-brand-primary/40 hover:shadow-md transition-all group flex items-center justify-between mt-2 sm:mt-0">
                <div>
                    <span class="text-xs font-bold text-brand-dark group-hover:text-brand-primary block">Dosen &amp; Pengajar</span>
                    <span class="text-[11px] text-brand-muted mt-1 block">Praktisi &amp; tenaga ahli</span>
                </div>
                <svg class="w-4 h-4 text-brand-muted group-hover:text-brand-primary group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</div>
@endsection

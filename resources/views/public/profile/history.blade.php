@extends('layouts.public')

@section('title', 'Sejarah Program Studi - D-IV TRM POLITALA')

@section('content')
<!-- Header Page -->
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-24 sm:pt-28 lg:pt-32 pb-8 sm:pb-10 lg:pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Profil</span>
            <span>/</span>
            <span class="text-brand-dark">Sejarah</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4 mt-3 sm:mt-4">
            <div class="space-y-1.5">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">
                    {{ $profile->title ?? 'Sejarah Program Studi' }}
                </h1>
                <p class="text-sm sm:text-base text-brand-muted">
                    Latar belakang pendirian, legalitas resmi, dan tonggak akselerasi D-IV Teknologi Rekayasa Multimedia
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>SK Resmi Kemendiktisaintek</span>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12 lg:py-14 space-y-12 sm:space-y-14">
    <!-- Key Identifiers / Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-xs space-y-1 mt-2 sm:mt-0">
            <span class="text-[11px] font-bold uppercase tracking-wider text-brand-muted block">Tahun Pendirian</span>
            <div class="text-2xl font-black text-brand-primary mt-2">{{ data_get($profile, 'meta.established_year', '2026') }}</div>
            <p class="text-xs text-brand-muted mt-1.5">Angkatan Perdana Mahasiswa Baru</p>
        </div>
        <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-xs space-y-1 mt-2 sm:mt-0">
            <span class="text-[11px] font-bold uppercase tracking-wider text-brand-muted block">Jenjang Pendidikan</span>
            <div class="text-2xl font-black text-brand-dark mt-2">Sarjana Terapan</div>
            <p class="text-xs text-brand-muted mt-1.5">Diploma IV (Level 6 KKNI)</p>
        </div>
        <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-xs space-y-1 mt-2 sm:mt-0">
            <span class="text-[11px] font-bold uppercase tracking-wider text-brand-muted block">Gelar Lulusan</span>
            <div class="text-xl font-black text-brand-secondary mt-2">{{ data_get($profile, 'meta.degree_title', 'S.Tr.Kom.') }}</div>
            <p class="text-xs text-brand-muted mt-1.5">Sarjana Terapan Komputer</p>
        </div>
        <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-xs space-y-1 mt-2 sm:mt-0">
            <span class="text-[11px] font-bold uppercase tracking-wider text-brand-muted block">Legalitas Izin</span>
            <div class="text-xs font-bold text-brand-dark truncate mt-2" title="{{ data_get($profile, 'meta.sk_number', 'SK Kemendiktisaintek RI No. 124/D/OT/2026') }}">
                {{ data_get($profile, 'meta.sk_number', 'SK Kemendiktisaintek') }}
            </div>
            <p class="text-xs text-emerald-600 font-semibold mt-1.5">Izin Operasional Resmi</p>
        </div>
    </div>

    <!-- Intro Narrative -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-8 sm:p-12 shadow-xs space-y-6 text-slate-700 leading-relaxed text-sm sm:text-base mt-12 sm:mt-16">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-light text-brand-primary text-xs font-bold uppercase tracking-wider">
            <span class="w-1.5 h-1.5 rounded-full bg-brand-primary"></span>
            <span>Latar Belakang &amp; Semangat Pendirian</span>
        </div>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-brand-dark tracking-tight leading-snug mt-4 sm:mt-6">
            Menjawab Disrupsi Industri Kreatif &amp; Teknologi Interaktif Modern
        </h2>

        @if(!empty($profile->content))
            <div class="space-y-4 text-slate-600 leading-relaxed mt-6 sm:mt-8">
                @foreach(explode("\n\n", $profile->content) as $paragraph)
                    @if(trim($paragraph))
                        <p class="mt-4 leading-relaxed">{!! nl2br(e(trim($paragraph))) !!}</p>
                    @endif
                @endforeach
            </div>
        @else
            <div class="space-y-4 text-slate-600 leading-relaxed mt-6 sm:mt-8">
                <p class="mt-4 leading-relaxed">
                    Program Studi Sarjana Terapan (D-IV) <strong>Teknologi Rekayasa Multimedia</strong> di Politeknik Negeri Tanah Laut didirikan sebagai respon strategis terhadap akselerasi industri kreatif digital, teknologi game komersial, animasi komputer 3D, serta kebutuhan mendesak talenta multimedia interaktif di Kalimantan Selatan dan Indonesia.
                </p>
                <p class="mt-4 leading-relaxed">
                    Dengan berkembangnya ekosistem media imersif (Virtual &amp; Augmented Reality), institusi memandang pentingnya kehadiran program studi vokasi yang memadukan keahlian <em>rekayasa perangkat lunak</em> dengan <em>estetika multimedia kreatif</em> berbasis praktik langsung (hands-on) 70% dan kolaborasi industri sejak semester awal.
                </p>
            </div>
        @endif

        <!-- 3 Pilar Filosofi -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-8 border-t border-slate-100 mt-10 sm:mt-14">
            <div class="p-5 rounded-2xl bg-brand-surface border border-slate-200/70 space-y-1.5 mt-2 sm:mt-0">
                <div class="w-8 h-8 rounded-xl bg-brand-primary/10 text-brand-primary flex items-center justify-center font-bold text-sm">
                    01
                </div>
                <h3 class="font-bold text-sm text-brand-dark mt-3">Vokasi Berbasis Proyek (PBL)</h3>
                <p class="text-xs text-brand-muted leading-relaxed mt-2">70% kurikulum merupakan pengerjaan proyek riil portofolio siap industri komersial.</p>
            </div>
            <div class="p-5 rounded-2xl bg-brand-surface border border-slate-200/70 space-y-1.5 mt-2 sm:mt-0">
                <div class="w-8 h-8 rounded-xl bg-brand-secondary/10 text-brand-secondary flex items-center justify-center font-bold text-sm">
                    02
                </div>
                <h3 class="font-bold text-sm text-brand-dark mt-3">Sinergi Coding &amp; Seni Digital</h3>
                <p class="text-xs text-brand-muted leading-relaxed mt-2">Kombinasi logika software engineering dengan estetika visual 3D, UI/UX, dan audio.</p>
            </div>
            <div class="p-5 rounded-2xl bg-brand-surface border border-slate-200/70 space-y-1.5 mt-2 sm:mt-0">
                <div class="w-8 h-8 rounded-xl bg-brand-complimentary/10 text-brand-complimentary flex items-center justify-center font-bold text-sm">
                    03
                </div>
                <h3 class="font-bold text-sm text-brand-dark mt-3">Kemitraan Studio &amp; DUDI</h3>
                <p class="text-xs text-brand-muted leading-relaxed mt-2">Penyelarasan kurikulum bersama asosiasi game &amp; studio animasi nasional sejak inisiasi.</p>
            </div>
        </div>
    </div>

    <!-- Timeline Perjalanan (Interactive Linimasa) -->
    <div class="space-y-8 mt-14 sm:mt-20" x-data="{ activeMilestone: 2 }">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-2">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-secondary/10 text-brand-secondary text-xs font-bold uppercase tracking-wider mb-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-secondary"></span>
                    <span>Linimasa Perjalanan</span>
                </div>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-brand-dark tracking-tight mt-3">
                    Tonggak Sejarah &amp; Rencana Akselerasi
                </h3>
            </div>
            <span class="text-xs text-brand-muted font-medium mt-2 sm:mt-0">
                Klik kartu atau tahun untuk melihat rincian tonggak
            </span>
        </div>

        @php
            $defaultTimeline = [
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
            ];

            $milestones = !empty($timeline) && is_array($timeline) ? $timeline : $defaultTimeline;
        @endphp

        <!-- Timeline Vertical Tree with Interactivity -->
        <div class="relative border-l-2 border-brand-primary/30 ml-4 sm:ml-6 space-y-12 pb-4 mt-10 sm:mt-12">
            @foreach($milestones as $idx => $m)
                @php
                    $isCompleted = ($m['status'] ?? '') === 'completed';
                    $isCurrent = ($m['status'] ?? '') === 'current';
                    $isUpcoming = ($m['status'] ?? '') === 'upcoming';
                @endphp
                <div class="relative pl-6 sm:pl-10 group cursor-pointer transition-all duration-300 mt-8 sm:mt-10"
                     @click="activeMilestone = {{ $idx }}">
                    
                    <!-- Bullet Node Indicator -->
                    <span class="absolute -left-[11px] top-2 w-5 h-5 rounded-full border-4 border-white shadow-sm flex items-center justify-center transition-transform group-hover:scale-125
                        {{ $isCurrent ? 'bg-brand-complimentary ring-4 ring-brand-complimentary/20 animate-pulse' : ($isCompleted ? 'bg-brand-primary' : 'bg-slate-300') }}"
                        :class="{ 'scale-125 ring-4 ring-brand-primary/30': activeMilestone === {{ $idx }} }">
                    </span>

                    <!-- Milestone Content Card -->
                    <div class="bg-white p-6 sm:p-8 rounded-3xl border shadow-xs transition-all duration-300 relative overflow-hidden mt-1"
                         :class="activeMilestone === {{ $idx }} ? 'border-brand-primary ring-2 ring-brand-primary/10 shadow-md bg-gradient-to-br from-white via-brand-surface to-white' : 'border-slate-200/80 hover:border-brand-primary/50 hover:shadow-md'">
                        
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-4">
                            <div class="flex items-center gap-2">
                                <span class="px-3 py-1 rounded-xl text-xs font-black shadow-xs tracking-wider
                                    {{ $isCurrent ? 'bg-brand-complimentary text-white' : ($isCompleted ? 'bg-brand-primary text-white' : 'bg-slate-100 text-slate-700') }}">
                                    {{ $m['year'] ?? 'Tahun' }}
                                </span>
                                @if(!empty($m['badge']))
                                    <span class="px-2.5 py-0.5 rounded-lg text-[11px] font-bold bg-brand-surface border border-slate-200 text-brand-dark">
                                        {{ $m['badge'] }}
                                    </span>
                                @endif
                            </div>

                            @if($isCurrent)
                                <span class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-complimentary">
                                    <span class="w-2 h-2 rounded-full bg-brand-complimentary animate-ping"></span>
                                    <span>Tonggak Aktif Saat Ini</span>
                                </span>
                            @elseif($isCompleted)
                                <span class="text-xs font-semibold text-emerald-600 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Terealisasi</span>
                                </span>
                            @else
                                <span class="text-xs font-semibold text-brand-muted">
                                    Fase Mendatang
                                </span>
                            @endif
                        </div>

                        <h4 class="text-base sm:text-lg font-bold text-brand-dark group-hover:text-brand-primary transition-colors mt-3">
                            {{ $m['title'] ?? 'Tonggak Pencapaian' }}
                        </h4>

                        <p class="mt-3 text-xs sm:text-sm text-brand-muted leading-relaxed">
                            {{ $m['description'] ?? '-' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Related Navigation Links -->
    <div class="pt-8 border-t border-slate-200 mt-16 sm:mt-24">
        <h4 class="text-xs font-bold uppercase tracking-wider text-brand-muted mb-4 mt-2">Informasi Terkait Profil TRM:</h4>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
            <a href="{{ route('public.profile.vision-mission') }}" class="p-5 rounded-2xl bg-white border border-slate-200/80 hover:border-brand-primary/40 hover:shadow-md transition-all group flex items-center justify-between mt-2 sm:mt-0">
                <div>
                    <span class="text-xs font-bold text-brand-dark group-hover:text-brand-primary block">Visi &amp; Misi</span>
                    <span class="text-[11px] text-brand-muted mt-1 block">Arah pengembangan 2030</span>
                </div>
                <svg class="w-4 h-4 text-brand-muted group-hover:text-brand-primary group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            <a href="{{ route('public.profile.structure') }}" class="p-5 rounded-2xl bg-white border border-slate-200/80 hover:border-brand-primary/40 hover:shadow-md transition-all group flex items-center justify-between mt-2 sm:mt-0">
                <div>
                    <span class="text-xs font-bold text-brand-dark group-hover:text-brand-primary block">Struktur Organisasi</span>
                    <span class="text-[11px] text-brand-muted mt-1 block">Tata kelola prodi</span>
                </div>
                <svg class="w-4 h-4 text-brand-muted group-hover:text-brand-primary group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            <a href="{{ route('public.profile.lecturers') }}" class="p-5 rounded-2xl bg-white border border-slate-200/80 hover:border-brand-primary/40 hover:shadow-md transition-all group flex items-center justify-between mt-2 sm:mt-0">
                <div>
                    <span class="text-xs font-bold text-brand-dark group-hover:text-brand-primary block">Dosen &amp; Pengajar</span>
                    <span class="text-[11px] text-brand-muted mt-1 block">Praktisi &amp; akademisi</span>
                </div>
                <svg class="w-4 h-4 text-brand-muted group-hover:text-brand-primary group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</div>
@endsection

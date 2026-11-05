@extends('layouts.public')

@section('title', ($profile->title ?? 'Struktur Organisasi') . ' - D-4 TRM POLITALA')

@section('content')
<!-- Header Page -->
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-32 sm:pt-36 lg:pt-40 pb-12 lg:pb-16 mt-2 sm:mt-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-4 mt-2">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Profil</span>
            <span>/</span>
            <span class="text-brand-dark">Struktur Organisasi</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4 mt-6 sm:mt-8">
            <div class="space-y-2">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight mt-1">
                    {{ $profile->title ?? 'Struktur Organisasi Program Studi' }}
                </h1>
                <p class="text-sm sm:text-base text-brand-muted mt-3">
                    Bagan tata kelola kelembagaan, pembagian tugas fungsional, dan kepemimpinan instruksional D-IV TRM POLITALA
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-2 mt-4 sm:mt-0">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ $academicYear ?? 'Tahun Akademik 2026/2027' }}</span>
                </span>
                <span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-brand-primary/10 text-brand-primary border border-brand-primary/20">
                    {{ $skNumber ?? 'SK Resmi Direktur POLITALA' }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12" x-data="{ viewMode: 'tree' }">
    <!-- View Switcher & Description -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-200 pb-6">
        <div>
            <h2 class="text-lg sm:text-xl font-extrabold text-brand-dark">Tata Kelola &amp; Bagan Hirarki</h2>
            <p class="text-xs sm:text-sm text-brand-muted mt-0.5">Integrasi langsung data personil Dosen Pengajar dan Tenaga Kependidikan</p>
        </div>

        <!-- Mode Toggle Tabs -->
        <div class="inline-flex items-center p-1.5 rounded-2xl bg-slate-100 border border-slate-200 text-xs font-bold shrink-0 self-start sm:self-auto">
            <button type="button" @click="viewMode = 'tree'" :class="viewMode === 'tree' ? 'bg-white text-brand-primary shadow-xs' : 'text-slate-600 hover:text-brand-dark'" class="px-3.5 py-1.5 rounded-xl transition-all flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span>Bagan Pohon (Tree)</span>
            </button>
            <button type="button" @click="viewMode = 'list'" :class="viewMode === 'list' ? 'bg-white text-brand-primary shadow-xs' : 'text-slate-600 hover:text-brand-dark'" class="px-3.5 py-1.5 rounded-xl transition-all flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                <span>Daftar Penugasan</span>
            </button>
        </div>
    </div>

    <!-- VIEW MODE 1: VISUAL TREE CHART -->
    <div x-show="viewMode === 'tree'" class="space-y-10">
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-10 shadow-xs relative overflow-hidden">
            <!-- Mobile Horizontal Scroll Helper Banner -->
            <div class="lg:hidden mb-6 p-3 rounded-xl bg-brand-surface text-brand-muted text-xs flex items-center justify-between">
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-brand-primary animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    <span>Geser ke samping untuk melihat keseluruhan bagan</span>
                </span>
                <span class="font-bold text-[10px] text-brand-primary">Diagram Responsif</span>
            </div>

            <div class="overflow-x-auto pb-8 pt-4">
                <div class="min-w-[860px] mx-auto flex flex-col items-center">
                    
                    <!-- LEVEL 0: Pimpinan Jurusan (Atasan Prodi) -->
                    <div class="flex flex-col items-center">
                        <div class="w-80 rounded-2xl bg-slate-900 text-white p-5 text-center shadow-lg border border-slate-800 relative group hover:border-brand-sky/50 transition-all">
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-slate-800 text-brand-sky border border-slate-700 inline-block mb-2">
                                Pimpinan Jurusan
                            </span>
                            <h3 class="font-extrabold text-sm text-white leading-snug">{{ $departmentHead['name'] }}</h3>
                            <p class="text-xs text-brand-sky/90 font-medium mt-0.5">{{ $departmentHead['title'] }}</p>
                            @if(!empty($departmentHead['nip']))
                                <p class="text-[11px] text-slate-400 font-mono mt-1">NIP. {{ $departmentHead['nip'] }}</p>
                            @endif
                        </div>

                        <!-- Connector Trunk to Level 1 -->
                        <div class="w-0.5 h-10 bg-slate-300 my-0"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-brand-primary ring-4 ring-brand-primary/20"></div>
                        <div class="w-0.5 h-4 bg-slate-300 my-0"></div>
                    </div>

                    <!-- LEVEL 1: Kaprodi with Left & Right Wings (GKM & Tata Usaha) -->
                    <div class="w-full flex items-center justify-center gap-6 relative mt-1">
                        <!-- LEFT WING: GKM (Penjaminan Mutu) -->
                        <div class="w-64 text-center">
                            <div class="p-4 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-brand-secondary/40 transition-all space-y-1.5">
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-700 inline-block">
                                    Unsur Pengawasan
                                </span>
                                <h4 class="font-extrabold text-xs text-brand-dark leading-tight">{{ $gkm['name'] }}</h4>
                                <p class="text-[11px] text-brand-primary font-semibold">{{ $gkm['title'] }}</p>
                                <p class="text-[10px] text-brand-muted">{{ $gkm['institution'] }}</p>
                            </div>
                        </div>

                        <!-- Horizontal Dotted Connector Left to Center -->
                        <div class="w-12 h-0.5 border-t-2 border-dashed border-slate-300"></div>

                        <!-- CENTER ROOT: Koordinator Program Studi (Kaprodi) -->
                        <div class="w-88 rounded-3xl bg-gradient-to-br from-brand-primary to-brand-secondary text-white p-6 text-center shadow-xl border-2 border-white/20 relative group scale-105 z-10">
                            <div class="absolute -top-3.5 left-1/2 -translate-x-1/2">
                                <span class="px-3.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-400 text-slate-900 shadow-md flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span>Pimpinan Program Studi</span>
                                </span>
                            </div>

                            <div class="flex items-center justify-center gap-3.5 mt-2">
                                <div class="w-14 h-14 rounded-2xl overflow-hidden bg-white/10 border-2 border-white/30 shrink-0 flex items-center justify-center shadow-inner">
                                    @if(!empty($kaprodi?->photo))
                                        <img src="{{ $kaprodi->photo_url }}" alt="{{ $kaprodi->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="text-white font-black text-lg">
                                            {{ strtoupper(substr($kaprodi?->name ?? 'KP', 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="text-left space-y-0.5">
                                    <h3 class="font-black text-base text-white leading-tight">
                                        {{ $kaprodi?->name ?? 'Dr. H. Rian Hidayat, M.Kom.' }}
                                    </h3>
                                    <p class="text-xs text-brand-cream font-semibold">
                                        {{ $kaprodi?->position ?? 'Koordinator Program Studi D-IV TRM' }}
                                    </p>
                                    @if(!empty($kaprodi?->nip_nidn))
                                        <p class="text-[11px] text-white/70 font-mono">
                                            NIP. {{ $kaprodi->nip_nidn }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Horizontal Dotted Connector Center to Right -->
                        <div class="w-12 h-0.5 border-t-2 border-dashed border-slate-300"></div>

                        <!-- RIGHT WING: Tata Usaha & Administrasi -->
                        <div class="w-64 text-center">
                            <div class="p-4 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-brand-primary/40 transition-all space-y-1.5">
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider bg-brand-primary/10 text-brand-primary inline-block">
                                    Layanan Operasional
                                </span>
                                <h4 class="font-extrabold text-xs text-brand-dark leading-tight">
                                    {{ $adminStaff?->name ?? 'Dewi Anggraini, S.AP.' }}
                                </h4>
                                <p class="text-[11px] text-brand-secondary font-semibold">
                                    {{ $adminStaff?->position ?? 'Staf Administrasi & Layanan Akademik' }}
                                </p>
                                <p class="text-[10px] text-brand-muted">Tata Usaha &amp; Layanan Mahasiswa</p>
                            </div>
                        </div>
                    </div>

                    <!-- Trunk Connector from Level 1 to Level 2 Branches -->
                    <div class="w-0.5 h-12 bg-slate-300 my-0"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-brand-secondary ring-4 ring-brand-secondary/20"></div>

                    <!-- Horizontal Crossbar for 3 Pillars -->
                    <div class="w-[84%] h-0.5 bg-slate-300 relative">
                        <!-- Drop connector pins -->
                        <div class="absolute left-0 top-0 w-0.5 h-8 bg-slate-300"></div>
                        <div class="absolute left-1/2 -translate-x-1/2 top-0 w-0.5 h-8 bg-slate-300"></div>
                        <div class="absolute right-0 top-0 w-0.5 h-8 bg-slate-300"></div>
                    </div>

                    <!-- LEVEL 2: 3 Major Functional Pillars -->
                    <div class="w-full grid grid-cols-3 gap-6 pt-8 mt-0 items-start">
                        
                        <!-- PILAR 1: Laboratorium & Studio Multimedia -->
                        <div class="flex flex-col items-center space-y-4">
                            <!-- Ka Lab Card -->
                            <div class="w-full bg-white rounded-2xl border-2 border-brand-primary/30 p-5 shadow-xs hover:shadow-md transition-all text-center space-y-2 group">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-brand-primary/10 text-brand-primary inline-block">
                                    Kepala Studio &amp; Lab
                                </span>
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-100 mx-auto flex items-center justify-center border border-slate-200">
                                    @if(!empty($kaLab?->photo))
                                        <img src="{{ $kaLab->photo_url }}" alt="{{ $kaLab->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="font-bold text-xs text-brand-primary">{{ strtoupper(substr($kaLab?->name ?? 'KL', 0, 2)) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-xs text-brand-dark leading-tight group-hover:text-brand-primary transition-colors">
                                        {{ $kaLab?->name ?? 'Fathurrahman, M.Sn.' }}
                                    </h4>
                                    <p class="text-[11px] text-brand-muted mt-0.5">{{ $kaLab?->position ?? 'Kepala Studio Animasi & Motion Capture' }}</p>
                                    @if(!empty($kaLab?->nip_nidn))
                                        <p class="text-[10px] text-slate-400 font-mono mt-0.5">NIP. {{ $kaLab->nip_nidn }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Drop line to PLP -->
                            <div class="w-0.5 h-5 bg-slate-300 my-0"></div>

                            <!-- PLP Sub-Card -->
                            <div class="w-[90%] bg-brand-surface rounded-xl border border-slate-200 p-3.5 text-center space-y-1">
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider bg-slate-200 text-slate-700 inline-block">
                                    Pranata Laboratorium (PLP)
                                </span>
                                <h5 class="font-bold text-xs text-brand-dark leading-tight">{{ $plp?->name ?? 'Ahmad Fauzi, A.Md.Kom.' }}</h5>
                                <p class="text-[10px] text-brand-muted">Teknisi Perangkat Grafis &amp; Server Render</p>
                            </div>
                        </div>

                        <!-- PILAR 2: Kurikulum & MBKM / Kemitraan DUDI -->
                        <div class="flex flex-col items-center space-y-4">
                            <!-- Koord MBKM Card -->
                            <div class="w-full bg-white rounded-2xl border-2 border-brand-primary/30 p-5 shadow-xs hover:shadow-md transition-all text-center space-y-2 group">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-brand-primary/10 text-brand-primary inline-block">
                                    Koordinator MBKM &amp; Magang
                                </span>
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-100 mx-auto flex items-center justify-center border border-slate-200">
                                    @if(!empty($koordMbkm?->photo))
                                        <img src="{{ $koordMbkm->photo_url }}" alt="{{ $koordMbkm->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="font-bold text-xs text-brand-primary">{{ strtoupper(substr($koordMbkm?->name ?? 'KM', 0, 2)) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-xs text-brand-dark leading-tight group-hover:text-brand-primary transition-colors">
                                        {{ $koordMbkm?->name ?? 'Siti Nur Aisyah, M.T.' }}
                                    </h4>
                                    <p class="text-[11px] text-brand-muted mt-0.5">{{ $koordMbkm?->position ?? 'Koordinator MBKM & Kurikulum' }}</p>
                                    @if(!empty($koordMbkm?->nip_nidn))
                                        <p class="text-[10px] text-slate-400 font-mono mt-0.5">NIP. {{ $koordMbkm->nip_nidn }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Drop line to Kemitraan Sub-card -->
                            <div class="w-0.5 h-5 bg-slate-300 my-0"></div>

                            <!-- Kemitraan Sub-Card -->
                            <div class="w-[90%] bg-brand-surface rounded-xl border border-slate-200 p-3.5 text-center space-y-1">
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider bg-slate-200 text-slate-700 inline-block">
                                    Kemitraan Industri Kreatif
                                </span>
                                <h5 class="font-bold text-xs text-brand-dark leading-tight">Studio Game &amp; Animasi Nasional</h5>
                                <p class="text-[10px] text-brand-muted">Teaching Factory &amp; Magang Bersertifikat</p>
                            </div>
                        </div>

                        <!-- PILAR 3: Kemahasiswaan & Riset Studio Game -->
                        <div class="flex flex-col items-center space-y-4">
                            <!-- Pembina Kemahasiswaan Card -->
                            <div class="w-full bg-white rounded-2xl border-2 border-brand-primary/30 p-5 shadow-xs hover:shadow-md transition-all text-center space-y-2 group">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-brand-primary/10 text-brand-primary inline-block">
                                    Pembina Studio Game &amp; Ormawa
                                </span>
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-100 mx-auto flex items-center justify-center border border-slate-200">
                                    @if(!empty($pembinaKemahasiswaan?->photo))
                                        <img src="{{ $pembinaKemahasiswaan->photo_url }}" alt="{{ $pembinaKemahasiswaan->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="font-bold text-xs text-brand-primary">{{ strtoupper(substr($pembinaKemahasiswaan?->name ?? 'PK', 0, 2)) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-xs text-brand-dark leading-tight group-hover:text-brand-primary transition-colors">
                                        {{ $pembinaKemahasiswaan?->name ?? 'Bambang Trianto, S.Kom., M.Cs.' }}
                                    </h4>
                                    <p class="text-[11px] text-brand-muted mt-0.5">{{ $pembinaKemahasiswaan?->position ?? 'Pembina Studio Game & Kemahasiswaan' }}</p>
                                    @if(!empty($pembinaKemahasiswaan?->nip_nidn))
                                        <p class="text-[10px] text-slate-400 font-mono mt-0.5">NIP. {{ $pembinaKemahasiswaan->nip_nidn }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Drop line to Kemahasiswaan Sub-card -->
                            <div class="w-0.5 h-5 bg-slate-300 my-0"></div>

                            <!-- Inkubator Sub-Card -->
                            <div class="w-[90%] bg-brand-surface rounded-xl border border-slate-200 p-3.5 text-center space-y-1">
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider bg-slate-200 text-slate-700 inline-block">
                                    Inkubasi Kreatif &amp; Riset Terapan
                                </span>
                                <h5 class="font-bold text-xs text-brand-dark leading-tight">Pengembangan Karya Game &amp; VR</h5>
                                <p class="text-[10px] text-brand-muted">Hilirisasi Produk &amp; Sertifikasi BNSP</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- VIEW MODE 2: TABULAR / FUNCTIONAL DIRECTORY LIST -->
    <div x-show="viewMode === 'list'" class="space-y-6" style="display: none;">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Pimpinan Jurusan -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-xs space-y-3">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-slate-900 text-white">
                    Pimpinan Jurusan
                </span>
                <div>
                    <h3 class="font-extrabold text-base text-brand-dark">{{ $departmentHead['name'] }}</h3>
                    <p class="text-xs font-semibold text-brand-primary">{{ $departmentHead['title'] }}</p>
                    <p class="text-xs text-brand-muted">{{ $departmentHead['institution'] }}</p>
                    <p class="text-[11px] text-slate-400 font-mono mt-1">NIP. {{ $departmentHead['nip'] }}</p>
                </div>
            </div>

            <!-- Kaprodi -->
            <div class="bg-white rounded-3xl border border-brand-primary p-6 shadow-xs space-y-3 bg-gradient-to-br from-brand-primary/5 to-white">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-brand-primary text-white">
                    Koordinator Program Studi
                </span>
                <div>
                    <h3 class="font-extrabold text-base text-brand-dark">{{ $kaprodi?->name ?? 'Dr. H. Rian Hidayat, M.Kom.' }}</h3>
                    <p class="text-xs font-semibold text-brand-primary">{{ $kaprodi?->position ?? 'Koordinator Prodi D-IV TRM' }}</p>
                    <p class="text-xs text-brand-muted">Jurusan Komputer &amp; Bisnis POLITALA</p>
                    <p class="text-[11px] text-slate-500 font-mono mt-1">NIP. {{ $kaprodi?->nip_nidn ?? '-' }}</p>
                </div>
            </div>

            <!-- GKM -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-xs space-y-3">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-slate-100 text-slate-700">
                    Penjaminan Mutu
                </span>
                <div>
                    <h3 class="font-extrabold text-base text-brand-dark">{{ $gkm['name'] }}</h3>
                    <p class="text-xs font-semibold text-brand-secondary">{{ $gkm['title'] }}</p>
                    <p class="text-xs text-brand-muted">{{ $gkm['institution'] }}</p>
                    <p class="text-[11px] text-slate-400 mt-1">{{ $gkm['nip'] }}</p>
                </div>
            </div>

            <!-- Kepala Laboratorium -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-xs space-y-3">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-brand-primary-light text-brand-primary">
                    Kepala Studio &amp; Laboratorium
                </span>
                <div>
                    <h3 class="font-extrabold text-base text-brand-dark">{{ $kaLab?->name ?? 'Fathurrahman, M.Sn.' }}</h3>
                    <p class="text-xs font-semibold text-brand-primary">{{ $kaLab?->position ?? 'Kepala Studio Animasi & Motion Capture' }}</p>
                    <p class="text-[11px] text-slate-400 font-mono mt-1">NIP. {{ $kaLab?->nip_nidn ?? '-' }}</p>
                </div>
            </div>

            <!-- Pranata Laboratorium Pendidikan -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-xs space-y-3">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-slate-100 text-slate-700">
                    Pranata Laboratorium (PLP)
                </span>
                <div>
                    <h3 class="font-extrabold text-base text-brand-dark">{{ $plp?->name ?? 'Ahmad Fauzi, A.Md.Kom.' }}</h3>
                    <p class="text-xs font-semibold text-brand-secondary">{{ $plp?->position ?? 'Pranata Laboratorium Pendidikan' }}</p>
                    <p class="text-[11px] text-slate-400 font-mono mt-1">NIP. {{ $plp?->nip_nidn ?? '-' }}</p>
                </div>
            </div>

            <!-- Koordinator MBKM -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-xs space-y-3">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-brand-primary-light text-brand-primary">
                    Koordinator MBKM &amp; Kemitraan
                </span>
                <div>
                    <h3 class="font-extrabold text-base text-brand-dark">{{ $koordMbkm?->name ?? 'Siti Nur Aisyah, M.T.' }}</h3>
                    <p class="text-xs font-semibold text-brand-primary">{{ $koordMbkm?->position ?? 'Koordinator Kurikulum & MBKM' }}</p>
                    <p class="text-[11px] text-slate-400 font-mono mt-1">NIP. {{ $koordMbkm?->nip_nidn ?? '-' }}</p>
                </div>
            </div>

            <!-- Pembina Kemahasiswaan -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-xs space-y-3">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-brand-primary-light text-brand-primary">
                    Pembina Kemahasiswaan &amp; Studio Game
                </span>
                <div>
                    <h3 class="font-extrabold text-base text-brand-dark">{{ $pembinaKemahasiswaan?->name ?? 'Bambang Trianto, S.Kom., M.Cs.' }}</h3>
                    <p class="text-xs font-semibold text-brand-primary">{{ $pembinaKemahasiswaan?->position ?? 'Pembina Studio Game & Kemahasiswaan' }}</p>
                    <p class="text-[11px] text-slate-400 font-mono mt-1">NIP. {{ $pembinaKemahasiswaan?->nip_nidn ?? '-' }}</p>
                </div>
            </div>

            <!-- Administrasi & Tata Usaha -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-xs space-y-3">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-slate-100 text-slate-700">
                    Administrasi &amp; Tata Usaha
                </span>
                <div>
                    <h3 class="font-extrabold text-base text-brand-dark">{{ $adminStaff?->name ?? 'Dewi Anggraini, S.AP.' }}</h3>
                    <p class="text-xs font-semibold text-brand-secondary">{{ $adminStaff?->position ?? 'Staf Administrasi Akademik' }}</p>
                    <p class="text-[11px] text-slate-400 font-mono mt-1">NIP. {{ $adminStaff?->nip_nidn ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Kelompok Bidang Keahlian (KBK) & Unit Khusus -->
    @if(!empty($customUnits) && is_array($customUnits))
        <div class="pt-6 space-y-6">
            <div>
                <span class="text-xs font-bold text-brand-primary uppercase tracking-wider">Gugus Keahlian</span>
                <h3 class="text-xl sm:text-2xl font-extrabold text-brand-dark mt-1">Kelompok Bidang Keahlian (KBK)</h3>
                <p class="text-xs sm:text-sm text-brand-muted mt-0.5">Pengelompokan instruksional dan konsorsium riset terapan dosen TRM POLITALA</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($customUnits as $u)
                    <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs hover:border-brand-primary/40 transition-all space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-brand-primary/10 text-brand-primary">
                                Bidang Keilmuan
                            </span>
                            @php
                                $unitLeader = $u['leader'] ?? $u['head'] ?? null;
                                $unitName = $u['unit'] ?? $u['name'] ?? '';
                                $unitDesc = $u['desc'] ?? $u['description'] ?? '';
                            @endphp
                            @if(!empty($unitLeader))
                                <span class="text-xs font-bold text-brand-secondary flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>{{ $unitLeader }}</span>
                                </span>
                            @endif
                        </div>
                        <h4 class="font-extrabold text-base text-brand-dark">{{ $unitName }}</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">{{ $unitDesc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Official Document Notice & Action -->
    <div class="p-6 rounded-3xl bg-brand-surface border border-slate-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-2xl bg-brand-primary text-white flex items-center justify-center shrink-0 shadow-xs">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-sm text-brand-dark">Dokumen Tata Kelola Resmi</h4>
                <p class="text-xs text-brand-muted mt-0.5">
                    Ditetapkan berdasarkan {{ $skNumber ?? 'SK Direktur Politeknik Negeri Tanah Laut' }} untuk operasional Program Studi Sarjana Terapan TRM.
                </p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('public.profile.lecturers') }}" class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-xs font-bold text-brand-dark hover:bg-slate-50 transition-colors">
                Lihat Direktori Dosen
            </a>
            <a href="{{ route('public.profile.staff') }}" class="px-4 py-2 rounded-xl bg-brand-primary hover:bg-brand-primary-hover text-white text-xs font-bold transition-colors">
                Lihat Tenaga Kependidikan
            </a>
        </div>
    </div>
</div>
@endsection

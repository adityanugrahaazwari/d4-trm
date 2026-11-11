@extends('layouts.public')

@section('title', 'Fasilitas & Laboratorium Terpadu - D-IV TRM POLITALA')

@section('content')
<!-- Header Page -->
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-24 sm:pt-28 lg:pt-32 pb-8 sm:pb-10 lg:pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary transition-colors">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Profil</span>
            <span>/</span>
            <span class="text-brand-dark">Fasilitas &amp; Lab</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-6 mt-3 sm:mt-4">
            <div class="max-w-3xl space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-brand-primary/10 text-brand-primary border border-brand-primary/20">
                    <span class="w-2 h-2 rounded-full bg-brand-primary animate-pulse"></span>
                    <span>Pusat Praktikum &amp; Riset Terapan Vokasi</span>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-brand-dark tracking-tight leading-tight">
                    Fasilitas &amp; Laboratorium Terpadu
                </h1>
                <p class="text-sm sm:text-base text-brand-muted leading-relaxed">
                    Infrastruktur komputasi performa tinggi, studio penangkapan gerak (*motion capture*), studio cinema, dan ruang kolaborasi industri berstandar profesional untuk mencetak talenta unggul rekayasa multimedia.
                </p>
            </div>

            <!-- Header Quick Stats -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 w-full lg:w-auto">
                <div class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-xs text-center">
                    <span class="block text-2xl font-black text-brand-primary">{{ $facilities->count() }}</span>
                    <span class="text-[11px] font-semibold text-brand-muted">Lab &amp; Studio</span>
                </div>
                <div class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-xs text-center">
                    <span class="block text-2xl font-black text-brand-secondary">{{ $totalWorkstations ?? 200 }}+</span>
                    <span class="text-[11px] font-semibold text-brand-muted">Workstation Aktif</span>
                </div>
                <div class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-xs text-center col-span-2 sm:col-span-1">
                    <span class="block text-2xl font-black text-emerald-600">100%</span>
                    <span class="text-[11px] font-semibold text-brand-muted">OBE &amp; PBL Ready</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12 lg:py-14 space-y-12 sm:space-y-14" 
     x-data="{ 
         activeModal: false, 
         selectedLab: null,
         openDetail(item) {
             this.selectedLab = item;
             this.activeModal = true;
         }
     }">

    <!-- Filter & Search Bar -->
    <div class="bg-white rounded-3xl border border-slate-200/90 p-5 sm:p-6 shadow-xs space-y-5">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <!-- Category Filter Tabs -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('public.facilities.index', array_filter(['q' => $search, 'category' => 'all'])) }}"
                   class="px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 {{ ($category === 'all' || empty($category)) ? 'bg-brand-primary text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-brand-dark' }}">
                    <span>Semua Fasilitas</span>
                </a>

                @foreach($categories as $cat)
                    <a href="{{ route('public.facilities.index', array_filter(['q' => $search, 'category' => $cat])) }}"
                       class="px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 {{ $category === $cat ? 'bg-brand-primary text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-brand-dark' }}">
                        <span>{{ $cat }}</span>
                    </a>
                @endforeach
            </div>

            <!-- Search Form -->
            <form action="{{ route('public.facilities.index') }}" method="GET" class="w-full lg:w-80 relative">
                @if(!empty($category) && $category !== 'all')
                    <input type="hidden" name="category" value="{{ $category }}">
                @endif
                <input type="text" 
                       name="q" 
                       value="{{ $search }}" 
                       placeholder="Cari nama lab, hardware, software..."
                       class="w-full pl-10 pr-9 py-2.5 rounded-2xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary transition-all">
                <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                @if(!empty($search))
                    <a href="{{ route('public.facilities.index', array_filter(['category' => $category !== 'all' ? $category : null])) }}" 
                       class="absolute right-3 top-3 text-slate-400 hover:text-rose-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif
            </form>
        </div>

        @if(!empty($search) || ($category !== 'all' && !empty($category)))
            <div class="flex items-center justify-between pt-3 border-t border-slate-100 text-xs text-brand-muted">
                <div>
                    Menampilkan hasil filter: 
                    @if(!empty($search)) <strong>&ldquo;{{ $search }}&rdquo;</strong> @endif
                    @if(!empty($search) && $category !== 'all' && !empty($category)) &bull; @endif
                    @if($category !== 'all' && !empty($category)) Kategori <strong>{{ $category }}</strong> @endif
                    ({{ $facilities->count() }} fasilitas ditemukan)
                </div>
                <a href="{{ route('public.facilities.index') }}" class="text-brand-primary font-bold hover:underline">
                    Reset Filter
                </a>
            </div>
        @endif
    </div>

    <!-- Facilities Grid -->
    @if($facilities->isEmpty())
        <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-300 p-8 space-y-4">
            <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 mx-auto flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-brand-dark">Fasilitas Tidak Ditemukan</h3>
            <p class="text-xs text-brand-muted max-w-md mx-auto">
                Tidak ada fasilitas atau laboratorium yang sesuai dengan kata kunci atau kategori yang Anda pilih. Silakan reset filter pencarian.
            </p>
            <div>
                <a href="{{ route('public.facilities.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-primary text-white text-xs font-bold hover:bg-brand-primary-hover transition-colors shadow-xs">
                    Reset Semua Pencarian
                </a>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($facilities as $fac)
                <div class="group bg-white rounded-3xl border border-slate-200/90 overflow-hidden shadow-xs hover:border-brand-primary/40 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <!-- Thumbnail / Image Card -->
                        <div class="aspect-16/10 relative overflow-hidden bg-slate-900">
                            @if($fac->image_url)
                                <img src="{{ $fac->image_url }}" 
                                     alt="{{ $fac->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-slate-900 via-brand-dark to-slate-800 p-6 flex flex-col justify-between relative overflow-hidden">
                                    <div class="absolute -right-6 -bottom-6 w-32 h-32 rounded-full bg-brand-primary/10 blur-xl"></div>
                                    <div class="flex items-center justify-between relative z-10">
                                        <div class="w-10 h-10 rounded-xl bg-white/10 backdrop-blur-md text-brand-sky flex items-center justify-center border border-white/10">
                                            @if(str_contains(strtolower($fac->category ?? ''), 'studio'))
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                </svg>
                                            @elseif(str_contains(strtolower($fac->name ?? ''), 'game') || str_contains(strtolower($fac->name ?? ''), 'vr'))
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @elseif(str_contains(strtolower($fac->category ?? ''), 'sarana') || str_contains(strtolower($fac->category ?? ''), 'server'))
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <span class="text-[10px] font-mono tracking-widest text-slate-400 uppercase">D-4 TRM LAB</span>
                                    </div>
                                    <div class="relative z-10">
                                        <div class="text-xs font-bold text-slate-300">POLITEKNIK NEGERI TANAH LAUT</div>
                                        <div class="text-base font-extrabold text-white line-clamp-1">{{ $fac->name }}</div>
                                    </div>
                                </div>
                            @endif

                            <!-- Badges on Image -->
                            <div class="absolute top-3 left-3 right-3 flex items-center justify-between gap-2 pointer-events-none z-10">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider shadow-xs backdrop-blur-md
                                    @if(str_contains(strtolower($fac->category ?? ''), 'studio'))
                                        bg-purple-900/80 text-purple-200 border border-purple-500/30
                                    @elseif(str_contains(strtolower($fac->category ?? ''), 'sarana') || str_contains(strtolower($fac->category ?? ''), 'pbl'))
                                        bg-amber-900/80 text-amber-200 border border-amber-500/30
                                    @else
                                        bg-blue-900/80 text-blue-200 border border-blue-500/30
                                    @endif">
                                    {{ $fac->category ?? 'Laboratorium' }}
                                </span>

                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-900/80 text-emerald-200 border border-emerald-500/30 backdrop-blur-md shadow-xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                    <span>Tersedia</span>
                                </span>
                            </div>

                            <!-- Capacity Ribbon bottom on Image -->
                            <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-xs text-white z-10 pointer-events-none">
                                <span class="flex items-center gap-1.5 font-bold text-[11px] drop-shadow-md">
                                    <svg class="w-3.5 h-3.5 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <span class="line-clamp-1">{{ $fac->location ?? 'Gedung TI' }}</span>
                                </span>
                                <span class="px-2 py-0.5 rounded-md bg-white/20 backdrop-blur-md text-[10px] font-bold font-mono">
                                    {{ $fac->capacity }} Unit
                                </span>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-6 space-y-4">
                            <div>
                                <h3 class="font-extrabold text-lg text-brand-dark group-hover:text-brand-primary transition-colors leading-snug">
                                    {{ $fac->name }}
                                </h3>
                                <p class="text-xs text-brand-muted leading-relaxed mt-2 line-clamp-3">
                                    {{ $fac->description }}
                                </p>
                            </div>

                            <!-- Specifications Preview -->
                            @if(!empty($fac->specifications))
                                <div class="p-3.5 rounded-2xl bg-brand-surface/70 border border-slate-100 space-y-1.5">
                                    <div class="flex items-center gap-1.5 text-[11px] font-bold text-slate-900">
                                        <svg class="w-3.5 h-3.5 text-brand-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                        </svg>
                                        <span>Spesifikasi Hardware Unggulan:</span>
                                    </div>
                                    <p class="text-[11px] text-slate-600 leading-relaxed line-clamp-2">
                                        {{ $fac->specifications }}
                                    </p>
                                </div>
                            @endif

                            <!-- Software Stack Tags -->
                            @if(!empty($fac->software_list) && count($fac->software_list) > 0)
                                <div class="space-y-1.5">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Software &amp; Framework:</span>
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach(array_slice($fac->software_list, 0, 4) as $soft)
                                            <span class="px-2.5 py-0.5 rounded-lg bg-slate-100 text-slate-700 text-[10px] font-semibold border border-slate-200/60">
                                                {{ $soft }}
                                            </span>
                                        @endforeach
                                        @if(count($fac->software_list) > 4)
                                            <span class="px-2 py-0.5 rounded-lg bg-brand-primary/10 text-brand-primary text-[10px] font-bold">
                                                +{{ count($fac->software_list) - 4 }} lainnya
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Card Action Footer -->
                    <div class="p-6 pt-0 border-t border-slate-100 flex items-center justify-between gap-3 mt-4">
                        <button type="button" 
                                @click="openDetail({{ Js::from([
                                    'name' => $fac->name,
                                    'category' => $fac->category,
                                    'location' => $fac->location,
                                    'capacity' => $fac->capacity,
                                    'description' => $fac->description,
                                    'specifications' => $fac->specifications,
                                    'software' => $fac->software,
                                    'software_list' => $fac->software_list,
                                    'image_url' => $fac->image_url,
                                ]) }})"
                                class="w-full py-2.5 px-4 rounded-xl bg-brand-surface hover:bg-brand-primary hover:text-white text-brand-dark border border-slate-200 text-xs font-bold transition-all flex items-center justify-center gap-2 group/btn shadow-2xs">
                            <span>Detail Spesifikasi &amp; SOP</span>
                            <svg class="w-4 h-4 text-brand-muted group-hover/btn:text-white group-hover/btn:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Standar K3 & Tata Tertib Laboratorium Section -->
    <div class="pt-8 space-y-8">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold text-brand-primary uppercase tracking-wider">Keselamatan &amp; Budaya Kerja</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-brand-dark">Standar K3 &amp; Tata Tertib Laboratorium</h2>
            <p class="text-xs sm:text-sm text-brand-muted">
                Untuk menjamin keselamatan kerja, keawetan aset laboratorium, serta kondusifitas praktikum perkuliahan dan riset terapan.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs space-y-3 hover:border-brand-primary/40 transition-all">
                <div class="w-10 h-10 rounded-2xl bg-brand-primary-light text-brand-primary flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h4 class="font-bold text-sm text-brand-dark">Presensi &amp; Jam Praktikum</h4>
                <p class="text-xs text-brand-muted leading-relaxed">
                    Praktikum berlangsung sesuai jadwal akademik (08:00 - 17:00 WITA). Mahasiswa wajib mengenakan pakaian rapi berkerah dan jas praktikum resmi.
                </p>
            </div>

            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs space-y-3 hover:border-brand-primary/40 transition-all">
                <div class="w-10 h-10 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <h4 class="font-bold text-sm text-brand-dark">Peminjaman Perangkat Khusus</h4>
                <p class="text-xs text-brand-muted leading-relaxed">
                    Penggunaan VR Headset, MoCap Suit, Drawing Tablet, dan Kamera Cinema wajib mengisi formulir peminjaman dan verifikasi oleh PLP / Teknisi Lab.
                </p>
            </div>

            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs space-y-3 hover:border-brand-primary/40 transition-all">
                <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                    </svg>
                </div>
                <h4 class="font-bold text-sm text-brand-dark">Integritas Data &amp; Cloud Backup</h4>
                <p class="text-xs text-brand-muted leading-relaxed">
                    Workstation lab dilengkapi sistem pemulihan (*deep freeze*). Seluruh proyek mahasiswa wajib dicadangkan pada cloud storage atau NAS prodi.
                </p>
            </div>

            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs space-y-3 hover:border-brand-primary/40 transition-all">
                <div class="w-10 h-10 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                </div>
                <h4 class="font-bold text-sm text-brand-dark">Larangan Makanan &amp; Minuman</h4>
                <p class="text-xs text-brand-muted leading-relaxed">
                    Dilarang keras membawa cairan, makanan, serta merokok di seluruh area lab komputer dan studio produksi demi keamanan komponen kelistrikan.
                </p>
            </div>
        </div>
    </div>

    <!-- Management & Helpdesk Lab Card -->
    <div class="rounded-3xl bg-gradient-to-r from-brand-dark via-slate-900 to-brand-primary p-8 sm:p-12 text-white relative overflow-hidden shadow-xl">
        <div class="absolute right-0 top-0 w-96 h-96 bg-brand-primary/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
            <div class="space-y-3 max-w-2xl">
                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white/10 text-brand-cream border border-white/10">
                    Tata Kelola Sarana &amp; Laboratorium
                </span>
                <h3 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    Butuh Peminjaman Studio untuk Proyek atau Tugas Akhir?
                </h3>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                    Pengelolaan operasional laboratorium dan studio berada di bawah koordinasi Kepala Laboratorium serta didukung penuh oleh Pranata Laboratorium Pendidikan (PLP). Silakan ajukan izin peminjaman ruang atau alat melalui saluran resmi prodi.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <a href="{{ route('public.contact') }}" 
                   class="px-5 py-3 rounded-2xl bg-white text-brand-dark hover:bg-brand-cream text-xs font-bold transition-all shadow-md flex items-center gap-2">
                    <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <span>Hubungi Pengelola Lab</span>
                </a>
                <a href="{{ route('public.profile.structure') }}" 
                   class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 text-white border border-white/20 text-xs font-bold transition-all flex items-center gap-2">
                    <span>Lihat Struktur Organisasi</span>
                </a>
            </div>
        </div>
    </div>

    <!-- DETAIL MODAL DIALOG (Alpine.js) -->
    <div x-show="activeModal" 
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto" 
         role="dialog" 
         aria-modal="true"
         @keydown.escape.window="activeModal = false">
        
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <!-- Backdrop -->
            <div x-show="activeModal" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="activeModal = false" 
                 class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal Content Card -->
            <div x-show="activeModal" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block w-full max-w-2xl text-left align-middle transition-all transform bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-200 z-10 relative">
                
                <template x-if="selectedLab">
                    <div>
                        <!-- Modal Header Banner -->
                        <div class="p-6 sm:p-8 bg-gradient-to-r from-brand-dark to-slate-900 text-white relative">
                            <button type="button" 
                                    @click="activeModal = false"
                                    class="absolute top-5 right-5 w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-brand-primary text-white" x-text="selectedLab.category"></span>
                            <h3 class="text-xl sm:text-2xl font-extrabold text-white mt-2" x-text="selectedLab.name"></h3>
                            <div class="flex flex-wrap items-center gap-4 text-xs text-slate-300 mt-2 font-medium">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                    <span x-text="selectedLab.location"></span>
                                </span>
                                <span>&bull;</span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span x-text="selectedLab.capacity + ' Unit Workstation'"></span>
                                </span>
                            </div>
                        </div>

                        <!-- Modal Body -->
                        <div class="p-6 sm:p-8 space-y-6 max-h-[70vh] overflow-y-auto">
                            <!-- Image if available -->
                            <template x-if="selectedLab.image_url">
                                <div class="rounded-2xl overflow-hidden border border-slate-200">
                                    <img :src="selectedLab.image_url" :alt="selectedLab.name" class="w-full h-56 object-cover">
                                </div>
                            </template>

                            <!-- Description -->
                            <div>
                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Fungsi &amp; Deskripsi Ruangan</h4>
                                <p class="text-xs sm:text-sm text-slate-700 leading-relaxed" x-text="selectedLab.description"></p>
                            </div>

                            <!-- Hardware Specs -->
                            <div class="p-4 rounded-2xl bg-brand-surface border border-slate-200 space-y-2">
                                <h4 class="text-xs font-bold text-brand-dark flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                    </svg>
                                    <span>Spesifikasi Perangkat Keras / Alat Utama</span>
                                </h4>
                                <p class="text-xs text-slate-700 leading-relaxed" x-text="selectedLab.specifications || 'Workstation Standar Multimedia & Komputasi Grafis'"></p>
                            </div>

                            <!-- Software Suite -->
                            <div>
                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Software &amp; Tools Berlisensi</h4>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="(soft, sIdx) in (selectedLab.software_list || [])" :key="sIdx">
                                        <span class="px-3 py-1 rounded-xl bg-slate-100 text-slate-700 text-xs font-bold border border-slate-200" x-text="soft"></span>
                                    </template>
                                </div>
                            </div>

                            <!-- Ketentuan Singkat -->
                            <div class="p-4 rounded-2xl bg-amber-50/70 border border-amber-200 text-xs text-amber-900 space-y-1">
                                <div class="font-bold flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Ketentuan Pemakaian:</span>
                                </div>
                                <p class="leading-relaxed">
                                    Wajib mematuhi SOP Laboratorium TRM POLITALA. Penggunaan di luar jadwal praktikum reguler memerlukan izin tertulis dari Kepala Laboratorium atau PLP minimal H-1 sebelum kegiatan.
                                </p>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="p-4 sm:p-6 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3">
                            <button type="button" 
                                    @click="activeModal = false"
                                    class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors">
                                Tutup
                            </button>
                            <a href="{{ route('public.contact') }}" 
                               class="px-4 py-2 rounded-xl bg-brand-primary text-white text-xs font-bold hover:bg-brand-primary-hover transition-colors shadow-xs">
                                Form Izin Lab
                            </a>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>
@endsection

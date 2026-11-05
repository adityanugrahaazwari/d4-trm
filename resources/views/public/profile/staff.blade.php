@extends('layouts.public')

@section('title', 'Tenaga Kependidikan - D-4 TRM POLITALA')

@section('content')
<!-- Header Page -->
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-32 sm:pt-36 lg:pt-40 pb-12 lg:pb-16 mt-2 sm:mt-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-4 mt-2">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Profil</span>
            <span>/</span>
            <span class="text-brand-dark">Tenaga Kependidikan</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4 mt-6 sm:mt-8">
            <div class="space-y-2">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight mt-1">Tenaga Kependidikan</h1>
                <p class="text-sm sm:text-base text-brand-muted mt-3">Pranata laboratorium pendidikan (PLP), staf administrasi akademik, dan teknisi sistem studio multimedia</p>
            </div>
            <div class="flex items-center gap-2 mt-4 sm:mt-0">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ count($staffList) }} Tenaga Kependidikan</span>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-10">
    <!-- Search Bar -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-4 sm:p-5 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
        <form method="GET" action="{{ route('public.profile.staff') }}" class="relative w-full sm:w-96 flex items-center gap-2">
            <div class="relative w-full">
                <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari nama staf, NIP, posisi..." class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <button type="submit" class="px-4 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-primary-hover text-white text-xs font-bold shrink-0 transition-colors">
                Cari
            </button>
            @if(!empty($search))
                <a href="{{ route('public.profile.staff') }}" class="px-3 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold shrink-0 transition-colors">
                    Reset
                </a>
            @endif
        </form>

        <div class="text-xs text-brand-muted font-medium">
            Menampilkan <span class="font-bold text-brand-dark">{{ count($staffList) }}</span> personel layanan akademik &amp; teknisi
        </div>
    </div>

    <!-- Staff Cards Grid -->
    @if(count($staffList) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($staffList as $s)
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs hover:border-brand-primary/40 hover:shadow-lg transition-all duration-300 flex flex-col justify-between space-y-5 group">
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <!-- Avatar / Foto -->
                            <div class="w-16 h-16 rounded-2xl overflow-hidden bg-brand-sky-light text-brand-primary flex items-center justify-center font-bold text-lg shrink-0 border border-slate-200 shadow-2xs">
                                @if(!empty($s->photo))
                                    <img src="{{ $s->photo_url }}" alt="{{ $s->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-tr from-brand-primary/10 to-brand-surface text-brand-primary font-black text-base">
                                        {{ strtoupper(substr($s->name, 0, 2)) }}
                                    </div>
                                @endif
                            </div>

                            <div class="space-y-1">
                                <span class="inline-block px-2.5 py-0.5 rounded-lg text-[10px] font-bold uppercase tracking-wider bg-brand-primary-light text-brand-primary">
                                    {{ $s->position ?? 'Tenaga Kependidikan' }}
                                </span>
                                <h3 class="font-extrabold text-base text-brand-dark leading-snug group-hover:text-brand-primary transition-colors">
                                    {{ $s->name }}
                                </h3>
                                @if(!empty($s->nip_nidn))
                                    <p class="text-xs text-brand-muted font-mono">
                                        {{ str_starts_with($s->nip_nidn, 'NIP') ? $s->nip_nidn : 'NIP: ' . $s->nip_nidn }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        @if(!empty($s->expertise))
                            <div class="pt-3 border-t border-slate-100">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Tugas &amp; Tanggung Jawab:</span>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    {{ $s->expertise }}
                                </p>
                            </div>
                        @endif

                        @if(!empty($s->education))
                            <div class="text-xs text-slate-500 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-brand-secondary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                </svg>
                                <span>{{ $s->education }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Footer: Kontak -->
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                        @if(!empty($s->email))
                            <a href="mailto:{{ $s->email }}" class="text-brand-primary hover:underline flex items-center gap-1.5 font-medium truncate max-w-[170px]">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="truncate">{{ $s->email }}</span>
                            </a>
                        @else
                            <span class="text-slate-400 text-[11px]">-</span>
                        @endif

                        @if(!empty($s->phone))
                            <span class="text-[11px] text-slate-500 font-medium">
                                {{ $s->phone }}
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-3xl border border-slate-200/80 p-12 text-center space-y-3">
            <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 mx-auto flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <h4 class="font-bold text-base text-brand-dark">Tidak Ada Data Staf Ditemukan</h4>
            <p class="text-xs text-brand-muted max-w-md mx-auto">
                @if(!empty($search))
                    Tidak ditemukan tenaga kependidikan dengan kata kunci "{{ $search }}". Silakan gunakan kata kunci lain.
                @else
                    Data tenaga kependidikan belum ditambahkan.
                @endif
            </p>
            @if(!empty($search))
                <a href="{{ route('public.profile.staff') }}" class="inline-block mt-2 px-4 py-2 rounded-xl bg-brand-primary text-white text-xs font-bold">
                    Tampilkan Semua Staf
                </a>
            @endif
        </div>
    @endif
</div>
@endsection

@extends('layouts.public')

@section('title', 'Dosen Pengajar - D-4 TRM POLITALA')

@section('content')
<!-- Header Page -->
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-32 sm:pt-36 lg:pt-40 pb-12 lg:pb-16 mt-2 sm:mt-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-4 mt-2">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Profil</span>
            <span>/</span>
            <span class="text-brand-dark">Dosen Pengajar</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4 mt-6 sm:mt-8">
            <div class="space-y-2">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight mt-1">Dosen &amp; Tenaga Pengajar</h1>
                <p class="text-sm sm:text-base text-brand-muted mt-3">Profil pendidik, instruktur laboratorium, dan praktisi industri Program Studi Sarjana Terapan TRM</p>
            </div>
            <div class="flex items-center gap-2 mt-4 sm:mt-0">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ count($lecturers) }} Dosen Pengajar Aktif</span>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-10">
    <!-- Search Bar -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-4 sm:p-5 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
        <form method="GET" action="{{ route('public.profile.lecturers') }}" class="relative w-full sm:w-96 flex items-center gap-2">
            <div class="relative w-full">
                <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari nama dosen, NIP, keahlian..." class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <button type="submit" class="px-4 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-primary-hover text-white text-xs font-bold shrink-0 transition-colors">
                Cari
            </button>
            @if(!empty($search))
                <a href="{{ route('public.profile.lecturers') }}" class="px-3 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold shrink-0 transition-colors">
                    Reset
                </a>
            @endif
        </form>

        <div class="text-xs text-brand-muted font-medium">
            Menampilkan <span class="font-bold text-brand-dark">{{ count($lecturers) }}</span> staf pengajar terverifikasi
        </div>
    </div>

    <!-- Lecturer Cards Grid -->
    @if(count($lecturers) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($lecturers as $d)
                @php
                    $isLeader = str_contains(strtolower($d->position ?? ''), 'koordinator') || str_contains(strtolower($d->position ?? ''), 'kaprodi');
                @endphp
                <div class="bg-white rounded-3xl border border-slate-200/80 overflow-hidden shadow-xs hover:border-brand-primary/40 hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <!-- Foto Dosen -->
                        <div class="aspect-4/5 bg-slate-100 relative overflow-hidden flex items-center justify-center border-b border-slate-100">
                            @if(!empty($d->photo))
                                <img src="{{ $d->photo_url }}" alt="{{ $d->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center p-6 bg-gradient-to-tr from-brand-primary/10 via-brand-surface to-slate-100 text-brand-primary">
                                    <div class="w-20 h-20 rounded-full bg-brand-primary/10 flex items-center justify-center mb-2 font-black text-xl">
                                        {{ strtoupper(substr($d->name, 0, 2)) }}
                                    </div>
                                    <span class="text-[11px] font-bold text-brand-secondary">Dosen TRM POLITALA</span>
                                </div>
                            @endif

                            @if($isLeader)
                                <div class="absolute top-3 right-3">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-brand-primary text-white shadow-xs">
                                        Pimpinan Prodi
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Info Dosen -->
                        <div class="p-5 space-y-3">
                            <span class="inline-block px-2.5 py-0.5 rounded-lg text-[10px] font-bold uppercase tracking-wider bg-brand-primary-light text-brand-primary">
                                {{ $d->position ?? 'Dosen Pengajar' }}
                            </span>

                            <div>
                                <h3 class="font-extrabold text-base text-brand-dark leading-snug group-hover:text-brand-primary transition-colors">
                                    {{ $d->name }}
                                </h3>
                                @if(!empty($d->nip_nidn))
                                    <p class="text-xs text-brand-muted font-mono mt-1">
                                        {{ str_starts_with($d->nip_nidn, 'NIP') ? $d->nip_nidn : 'NIP/NIDN: ' . $d->nip_nidn }}
                                    </p>
                                @endif
                            </div>

                            @if(!empty($d->education))
                                <div class="pt-2 border-t border-slate-100 text-xs flex items-start gap-1.5 text-slate-600">
                                    <svg class="w-4 h-4 text-brand-secondary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                    </svg>
                                    <span class="leading-tight">{{ $d->education }}</span>
                                </div>
                            @endif

                            @if(!empty($d->expertise))
                                <div class="pt-2 text-xs">
                                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block mb-1">Bidang Keahlian:</span>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(explode(',', $d->expertise) as $exp)
                                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 text-[11px] font-medium">
                                                {{ trim($exp) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Footer Kartu: Kontak -->
                    <div class="p-5 border-t border-slate-100 bg-slate-50/50 flex flex-col gap-1.5">
                        @if(!empty($d->email))
                            <a href="mailto:{{ $d->email }}" class="text-xs text-brand-primary hover:underline flex items-center gap-1.5 font-medium truncate">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="truncate">{{ $d->email }}</span>
                            </a>
                        @endif
                        @if(!empty($d->phone))
                            <span class="text-[11px] text-slate-500 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span>{{ $d->phone }}</span>
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
            <h4 class="font-bold text-base text-brand-dark">Tidak Ada Data Dosen Ditemukan</h4>
            <p class="text-xs text-brand-muted max-w-md mx-auto">
                @if(!empty($search))
                    Tidak ditemukan data dosen dengan kata kunci "{{ $search }}". Silakan gunakan kata kunci lain atau reset pencarian.
                @else
                    Data dosen pengajar belum ditambahkan.
                @endif
            </p>
            @if(!empty($search))
                <a href="{{ route('public.profile.lecturers') }}" class="inline-block mt-2 px-4 py-2 rounded-xl bg-brand-primary text-white text-xs font-bold">
                    Tampilkan Semua Dosen
                </a>
            @endif
        </div>
    @endif
</div>
@endsection

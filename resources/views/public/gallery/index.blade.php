@extends('layouts.public')

@section('title', 'Galeri Kegiatan - D-4 TRM POLITALA')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Dokumentasi</span>
            <span>/</span>
            <span class="text-brand-dark">Galeri</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Galeri Kegiatan &amp; Dokumentasi</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Arsip visual aktivitas praktikum, seminar, pameran inovasi, dan kemitraan vokasi</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi Galeri]
            </span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-10" x-data="{ activeFilter: 'all' }">
    <!-- Album Category Filter -->
    <div class="flex items-center gap-2 border-b border-slate-200 pb-4 overflow-x-auto scrollbar-none">
        <button @click="activeFilter = 'all'" :class="activeFilter === 'all' ? 'bg-brand-primary text-white shadow-sm' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap">Semua Dokumentasi</button>
        <button @click="activeFilter = 'praktikum'" :class="activeFilter === 'praktikum' ? 'bg-brand-primary text-white shadow-sm' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap">Praktikum Lab</button>
        <button @click="activeFilter = 'workshop'" :class="activeFilter === 'workshop' ? 'bg-brand-primary text-white shadow-sm' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap">Workshop &amp; Kuliah Tamu</button>
        <button @click="activeFilter = 'kemitraan'" :class="activeFilter === 'kemitraan' ? 'bg-brand-primary text-white shadow-sm' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap">Kunjungan Industri DUDI</button>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @for ($g = 1; $g <= 6; $g++)
            <div class="group bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs hover:border-brand-primary/40 hover:shadow-md transition-all">
                <div class="aspect-4/3 bg-slate-100 flex items-center justify-center text-slate-400 relative overflow-hidden">
                    <span class="text-xs font-medium">[Dokumentasi Foto #{{ $g }}]</span>
                    <div class="absolute inset-0 bg-brand-dark/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white">
                        <svg class="w-8 h-8 transform scale-75 group-hover:scale-100 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
                        </svg>
                    </div>
                </div>
                <div class="p-5 space-y-1">
                    <span class="text-[10px] uppercase font-bold text-brand-secondary tracking-wider block">
                        Dokumentasi Kegiatan
                    </span>
                    <h3 class="font-bold text-sm text-brand-dark leading-snug">
                        [Foto Contoh {{ $g }}] Aktivitas Praktikum Produksi Aset 3D &amp; Motion Capture di Studio TRM
                    </h3>
                    <p class="text-xs text-brand-muted">Diambil pada Oktober 2026 di Kampus POLITALA</p>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection

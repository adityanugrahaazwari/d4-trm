@extends('layouts.public')

@section('title', 'Kurikulum Program Studi - D-4 TRM POLITALA')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Akademik</span>
            <span>/</span>
            <span class="text-brand-dark">Kurikulum</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Struktur Kurikulum</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Kurikulum Sarjana Terapan D-4 TRM berbasis Outcome-Based Education (OBE) dan Project-Based Learning</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi Kurikulum]
            </span>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-12">
    <!-- Ringkasan Bobot SKS -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs text-center space-y-1">
            <span class="text-xs uppercase font-bold text-brand-muted">Total Beban Studi</span>
            <div class="text-3xl font-extrabold text-brand-primary">144 SKS</div>
            <p class="text-xs text-slate-500">Masa studi normal 8 Semester (4 Tahun)</p>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs text-center space-y-1">
            <span class="text-xs uppercase font-bold text-brand-muted">Praktik &amp; PBL</span>
            <div class="text-3xl font-extrabold text-brand-secondary">62%</div>
            <p class="text-xs text-slate-500">Praktikum lab, studio &amp; proyek industri</p>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs text-center space-y-1">
            <span class="text-xs uppercase font-bold text-brand-muted">Teori &amp; Konsep</span>
            <div class="text-3xl font-extrabold text-brand-dark">38%</div>
            <p class="text-xs text-slate-500">Fondasi matematika, logika &amp; rekayasa</p>
        </div>
    </div>

    <!-- Alur Tahapan Perkuliahan -->
    <div class="space-y-6">
        <h2 class="text-2xl font-bold text-brand-dark">Fase Perkuliahan 4 Tahun</h2>
        
        <div class="space-y-4">
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col md:flex-row gap-6 items-start md:items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-primary-light text-brand-primary flex items-center justify-center font-bold text-lg shrink-0">
                        T1
                    </div>
                    <div>
                        <span class="text-xs font-bold text-brand-secondary uppercase">Tahun 1 (Semester 1–2)</span>
                        <h3 class="font-bold text-base text-brand-dark">Fundamental Computing &amp; Multimedia Foundation</h3>
                        <p class="text-xs text-brand-muted mt-1">Dasar pemrograman, matematika diskrit, desain grafis 2D, tipografi digital, dan logika algoritma.</p>
                    </div>
                </div>
                <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold whitespace-nowrap">36 SKS</span>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col md:flex-row gap-6 items-start md:items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-sky-light text-brand-secondary flex items-center justify-center font-bold text-lg shrink-0">
                        T2
                    </div>
                    <div>
                        <span class="text-xs font-bold text-brand-secondary uppercase">Tahun 2 (Semester 3–4)</span>
                        <h3 class="font-bold text-base text-brand-dark">Core Interactive Media &amp; 3D Modeling</h3>
                        <p class="text-xs text-brand-muted mt-1">Pemodelan 3D, animasi karakter, pemrograman web multimedia, UI/UX prototyping, dan audio engineering.</p>
                    </div>
                </div>
                <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold whitespace-nowrap">38 SKS</span>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col md:flex-row gap-6 items-start md:items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-lg shrink-0">
                        T3
                    </div>
                    <div>
                        <span class="text-xs font-bold text-emerald-600 uppercase">Tahun 3 (Semester 5–6)</span>
                        <h3 class="font-bold text-base text-brand-dark">Advanced Game Development &amp; Immersive Tech (VR/AR)</h3>
                        <p class="text-xs text-brand-muted mt-1">Pengembangan game engine (Unity/Unreal), virtual &amp; augmented reality, computer vision, dan proyek kolaborasi DUDI.</p>
                    </div>
                </div>
                <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold whitespace-nowrap">40 SKS</span>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col md:flex-row gap-6 items-start md:items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-lg shrink-0">
                        T4
                    </div>
                    <div>
                        <span class="text-xs font-bold text-amber-600 uppercase">Tahun 4 (Semester 7–8)</span>
                        <h3 class="font-bold text-base text-brand-dark">Magang Industri (MBKM) &amp; Tugas Akhir Skripsi Terapan</h3>
                        <p class="text-xs text-brand-muted mt-1">Praktik kerja industri 1 semester penuh, seminar proposal, dan pameran karya produk Tugas Akhir.</p>
                    </div>
                </div>
                <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold whitespace-nowrap">30 SKS</span>
            </div>
        </div>
    </div>

    <!-- CTA Unduh Dokumen -->
    <div class="bg-brand-surface rounded-2xl border border-slate-200/80 p-8 flex flex-col sm:flex-row items-center justify-between gap-6">
        <div>
            <h3 class="font-bold text-base text-brand-dark">Dokumen Buku Pedoman Kurikulum</h3>
            <p class="text-xs text-brand-muted mt-1">Unduh draf kurikulum operasional lengkap tahun akademik 2026/2027 format PDF.</p>
        </div>
        <button type="button" class="px-5 py-2.5 rounded-xl bg-brand-primary text-white text-xs font-bold hover:bg-brand-primary-hover shadow-sm transition-all whitespace-nowrap">
            Unduh Draf Kurikulum (PDF)
        </button>
    </div>
</div>
@endsection

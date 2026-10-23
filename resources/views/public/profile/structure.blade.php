@extends('layouts.public')

@section('title', 'Struktur Organisasi - D-4 TRM POLITALA')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Profil</span>
            <span>/</span>
            <span class="text-brand-dark">Struktur Organisasi</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Struktur Organisasi</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Bagan tata kelola dan susunan penugasan Program Studi D-4 TRM</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi]
            </span>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-12">
    <!-- Visual Org Chart Tree -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-8 sm:p-12 shadow-xs space-y-10">
        <!-- Level 1: Ketua Jurusan -->
        <div class="flex justify-center">
            <div class="w-72 bg-brand-primary text-white p-5 rounded-2xl text-center shadow-md">
                <span class="text-[10px] uppercase font-bold tracking-wider text-brand-sky block">Ketua Jurusan</span>
                <h3 class="font-bold text-sm mt-1">[Nama Ketua Jurusan, M.Kom.]</h3>
                <p class="text-xs text-brand-sky/80 mt-0.5">Jurusan Komputer &amp; Bisnis</p>
            </div>
        </div>

        <!-- Vertical Connector -->
        <div class="w-0.5 h-8 bg-slate-300 mx-auto -my-2"></div>

        <!-- Level 2: Kaprodi & GKM -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto">
            <div class="bg-brand-secondary text-white p-5 rounded-2xl text-center shadow-md">
                <span class="text-[10px] uppercase font-bold tracking-wider text-brand-cream block">Koordinator Program Studi</span>
                <h3 class="font-bold text-sm mt-1">[Nama Koordinator Prodi TRM, M.Kom.]</h3>
                <p class="text-xs text-brand-cream/80 mt-0.5">D-4 Teknik Rekayasa Multimedia</p>
            </div>
            <div class="bg-slate-800 text-white p-5 rounded-2xl text-center shadow-md">
                <span class="text-[10px] uppercase font-bold tracking-wider text-brand-sky block">Gugus Kendali Mutu (GKM)</span>
                <h3 class="font-bold text-sm mt-1">[Nama Penjamin Mutu, M.T.]</h3>
                <p class="text-xs text-slate-400 mt-0.5">Penjaminan Mutu Internal</p>
            </div>
        </div>

        <!-- Vertical Connector -->
        <div class="w-0.5 h-8 bg-slate-300 mx-auto -my-2"></div>

        <!-- Level 3: Bidang Pelaksana -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-brand-surface border border-slate-200 p-5 rounded-xl text-center space-y-1">
                <span class="text-[10px] font-bold uppercase text-brand-primary tracking-wider block">Kepala Laboratorium</span>
                <h4 class="font-bold text-xs text-brand-dark">[Nama Kepala Lab, M.Kom.]</h4>
                <p class="text-[11px] text-brand-muted">Lab Multimedia &amp; Game</p>
            </div>

            <div class="bg-brand-surface border border-slate-200 p-5 rounded-xl text-center space-y-1">
                <span class="text-[10px] font-bold uppercase text-brand-primary tracking-wider block">Pembina Kemahasiswaan</span>
                <h4 class="font-bold text-xs text-brand-dark">[Nama Pembina Ormawa, M.T.]</h4>
                <p class="text-[11px] text-brand-muted">Minat, Bakat &amp; Penalaran</p>
            </div>

            <div class="bg-brand-surface border border-slate-200 p-5 rounded-xl text-center space-y-1">
                <span class="text-[10px] font-bold uppercase text-brand-primary tracking-wider block">Koordinator Kurikulum &amp; PBL</span>
                <h4 class="font-bold text-xs text-brand-dark">[Nama Koord. Akademik, M.Cs.]</h4>
                <p class="text-[11px] text-brand-muted">Pengembangan Instruksional</p>
            </div>

            <div class="bg-brand-surface border border-slate-200 p-5 rounded-xl text-center space-y-1">
                <span class="text-[10px] font-bold uppercase text-brand-primary tracking-wider block">Koordinator Magang &amp; DUDI</span>
                <h4 class="font-bold text-xs text-brand-dark">[Nama Koord. Kerjasama, M.Kom.]</h4>
                <p class="text-[11px] text-brand-muted">Kemitraan Industri</p>
            </div>
        </div>
    </div>
</div>
@endsection

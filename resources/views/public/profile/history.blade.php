@extends('layouts.public')

@section('title', 'Sejarah Program Studi - D-IV TRM POLITALA')

@section('content')
<!-- Header Page -->
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-28 sm:pt-32 lg:pt-36 pb-12 lg:pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Profil</span>
            <span>/</span>
            <span class="text-brand-dark">Sejarah</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Sejarah Program Studi</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Latar belakang pendirian dan tonggak perkembangan D-IV Teknik Rekayasa Multimedia</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi]
            </span>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-12">
    <!-- Intro Narrative -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-8 sm:p-10 shadow-xs space-y-6 text-slate-700 leading-relaxed text-sm sm:text-base">
        <h2 class="text-xl sm:text-2xl font-bold text-brand-primary">Latar Belakang Pendirian</h2>
        <p>
            Program Studi Sarjana Terapan (D-IV) <strong>Teknik Rekayasa Multimedia</strong> di Politeknik Negeri Tanah Laut didirikan sebagai respon strategis terhadap akselerasi industri kreatif digital, teknologi game, animasi nasional, serta kebutuhan talenta multimedia interaktif di Kalimantan Selatan dan Indonesia.
        </p>
        <p>
            Dengan berkembangnya teknologi media imersif (AR/VR), animasi komputer, dan platform konten digital, institusi memandang pentingnya kehadiran program studi vokasi yang memadukan keahlian <em>rekayasa perangkat lunak</em> dengan <em>estetika multimedia kreatif</em> berbasis praktik langsung (hands-on).
        </p>
    </div>

    <!-- Timeline Perjalanan -->
    <div class="space-y-6">
        <h3 class="text-xl font-bold text-brand-dark">Tonggak Perjalanan Program Studi</h3>
        <div class="relative border-l-2 border-brand-secondary/30 ml-4 sm:ml-6 space-y-8 pb-4">
            <!-- Timeline Item 1 -->
            <div class="relative pl-6 sm:pl-8">
                <span class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-brand-primary border-4 border-white shadow-xs"></span>
                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-2">
                    <span class="inline-block px-2.5 py-0.5 rounded text-xs font-bold bg-brand-primary-light text-brand-primary">Tahun 2024</span>
                    <h4 class="text-base font-bold text-brand-dark">Penyusunan Naskah Akademik &amp; Analisis Kebutuhan Industri</h4>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                        Inisiasi awal pembentukan tim kurikulum untuk menyusun profil lulusan bersama asosiasi industri animasi, game developer, dan institusi vokasi terkait.
                    </p>
                </div>
            </div>

            <!-- Timeline Item 2 -->
            <div class="relative pl-6 sm:pl-8">
                <span class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-brand-secondary border-4 border-white shadow-xs"></span>
                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-2">
                    <span class="inline-block px-2.5 py-0.5 rounded text-xs font-bold bg-brand-sky-light text-brand-secondary">Tahun 2025</span>
                    <h4 class="text-base font-bold text-brand-dark">Pengusulan Izin Operasional &amp; Pembangunan Laboratorium</h4>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                        Pemberkasan izin pembukaan program studi ke Kemendiktisaintek serta pengadaan fasilitas workstation komputer grafis berstandar tinggi.
                    </p>
                </div>
            </div>

            <!-- Timeline Item 3 -->
            <div class="relative pl-6 sm:pl-8">
                <span class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-emerald-500 border-4 border-white shadow-xs"></span>
                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-2">
                    <span class="inline-block px-2.5 py-0.5 rounded text-xs font-bold bg-emerald-50 text-emerald-700">Tahun 2026</span>
                    <h4 class="text-base font-bold text-brand-dark">Penerbitan SK Resmi &amp; Peluncuran Portal Informasi</h4>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                        Program Studi resmi siap menerima angkatan perdana melalui berbagai jalur seleksi nasional dan mandiri Politeknik Negeri Tanah Laut.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.public')

@section('title', 'Berita Program Studi - D-IV TRM POLITALA')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-28 sm:pt-32 lg:pt-36 pb-12 lg:pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Informasi</span>
            <span>/</span>
            <span class="text-brand-dark">Berita</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Berita &amp; Artikel Terkini</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Kabar kegiatan, riset, kerja sama industri, dan wawasan teknologi multimedia terapan</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi Berita]
            </span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-12">
    <!-- Search & Category Filters -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 border-b border-slate-200 pb-6">
        <div class="flex items-center gap-2 overflow-x-auto w-full sm:w-auto">
            <button class="px-4 py-2 rounded-xl text-xs font-bold bg-brand-primary text-white shadow-sm">Semua</button>
            <button class="px-4 py-2 rounded-xl text-xs font-bold bg-white text-slate-700 hover:bg-slate-100 border border-slate-200">Akademik</button>
            <button class="px-4 py-2 rounded-xl text-xs font-bold bg-white text-slate-700 hover:bg-slate-100 border border-slate-200">Workshop &amp; Riset</button>
            <button class="px-4 py-2 rounded-xl text-xs font-bold bg-white text-slate-700 hover:bg-slate-100 border border-slate-200">Kemitraan DUDI</button>
        </div>
        <div class="relative w-full sm:w-72">
            <input type="text" placeholder="Cari berita..." class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-primary/20">
            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    <!-- Featured News Hero Card -->
    <a href="{{ route('public.news.show', 'd4-trm-politala-jalin-kerjasama-dengan-studio-game-nasional') }}" class="group block rounded-3xl bg-white border border-slate-200/80 hover:border-brand-primary/40 hover:shadow-lg transition-all overflow-hidden shadow-xs grid grid-cols-1 lg:grid-cols-12 gap-0">
        <div class="lg:col-span-7 bg-slate-100 aspect-16/9 lg:aspect-auto flex items-center justify-center text-slate-400 relative">
            <span class="text-xs font-medium">[Foto Utama Berita Unggulan]</span>
            <span class="absolute top-4 left-4 text-[10px] uppercase font-bold tracking-wider text-white bg-brand-primary px-3 py-1 rounded-full shadow-sm">
                Berita Utama
            </span>
        </div>
        <div class="lg:col-span-5 p-8 sm:p-10 flex flex-col justify-between space-y-6">
            <div class="space-y-3">
                <div class="flex items-center gap-2 text-xs text-brand-muted">
                    <span>{{ date('d F Y') }}</span>
                    <span>&bull;</span>
                    <span class="text-brand-secondary font-bold">Kemitraan DUDI</span>
                </div>
                <h2 class="text-xl sm:text-2xl font-extrabold text-brand-dark leading-snug group-hover:text-brand-primary transition-colors">
                    [Contoh Berita] D-IV TRM POLITALA Jalin Kerjasama dengan Studio Game Nasional untuk Penguatan MBKM Vokasi
                </h2>
                <p class="text-xs sm:text-sm text-brand-muted leading-relaxed line-clamp-3">
                    Program Studi D-IV Teknik Rekayasa Multimedia mengukuhkan sinergi kurikulum berbasis industri melalui kesepakatan magang bersertifikat dan praktisi mengajar langsung dari industri kreatif...
                </p>
            </div>
            <div class="flex items-center gap-2 text-xs font-bold text-brand-primary group-hover:translate-x-1 transition-transform">
                <span>Baca Berita Selengkapnya</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </div>
        </div>
    </a>

    <!-- News Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @php
            $newsList = [
                ['title' => '[Contoh Berita] Workshop Animasi 3D & Rigging Karakter Bersama Praktisi Industri Film', 'slug' => 'workshop-animasi-3d-rigging-karakter', 'cat' => 'Workshop & Riset', 'date' => '22 Okt 2026', 'desc' => 'Pelatihan intensif pemodelan karakter dan pipeline animasi 3D menggunakan Blender dan Maya untuk mahasiswa.'],
                ['title' => '[Contoh Berita] Persiapan Pelaksanaan Uji Kompetensi Skema Junior Game Programmer BNSP', 'slug' => 'uji-kompetensi-junior-game-programmer', 'cat' => 'Akademik', 'date' => '19 Okt 2026', 'desc' => 'Standarisasi kompetensi lulusan sarjana terapan vokasi melalui skema sertifikasi profesi bidang pemrograman game.'],
                ['title' => '[Contoh Berita] Pengadaan Workstation Komputer Grafis Terkini di Lab Multimedia TRM', 'slug' => 'pengadaan-workstation-komputer-grafis', 'cat' => 'Fasilitas', 'date' => '15 Okt 2026', 'desc' => 'Dukungan kartu grafis RTX dan layar color-accurate untuk mendukung praktikum rendering 3D dan game development.'],
                ['title' => '[Contoh Berita] Sosialisasi Jalur Penerimaan Mahasiswa Baru Sarjana Terapan Tahun 2027', 'slug' => 'sosialisasi-jalur-penerimaan-mahasiswa-baru-2027', 'cat' => 'Akademik', 'date' => '10 Okt 2026', 'desc' => 'Informasi jalur SNBP, SNBT, dan Jalur Mandiri Konsorsium Vokasi bagi siswa SMA/SMK sederajat.'],
                ['title' => '[Contoh Berita] Seminar Tren Media Imersif: Potensi Virtual Reality dalam Sektor Industri', 'slug' => 'seminar-tren-media-imersif-vr', 'cat' => 'Workshop & Riset', 'date' => '05 Okt 2026', 'desc' => 'Eksplorasi penggunaan simulasi virtual untuk keselamatan kerja K3 pertambangan dan simulasi operasional alat berat.'],
                ['title' => '[Contoh Berita] Dosen TRM Rilis Kajian Penerapan UI/UX Berbasis Budaya Lokal Banjar', 'slug' => 'dosen-trm-kajian-uiux-budaya-lokal-banjar', 'cat' => 'Riset Dosen', 'date' => '01 Okt 2026', 'desc' => 'Publikasi ilmiah penggabungan ornamen khas kearifan lokal Kalimantan Selatan ke dalam elemen desain visual modern.'],
            ];
        @endphp

        @foreach ($newsList as $item)
            <article class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs hover:border-brand-primary/40 hover:shadow-md transition-all flex flex-col justify-between">
                <div>
                    <a href="{{ route('public.news.show', $item['slug']) }}" class="block aspect-16/9 bg-slate-100 flex items-center justify-center text-slate-400 relative hover:opacity-90 transition-opacity">
                        <span class="text-xs font-medium">[Thumbnail Berita]</span>
                    </a>
                    <div class="p-6 space-y-3">
                        <div class="flex items-center gap-2 text-xs text-brand-muted">
                            <span>{{ $item['date'] }}</span>
                            <span>&bull;</span>
                            <span class="text-brand-secondary font-bold">{{ $item['cat'] }}</span>
                        </div>
                        <h3 class="font-bold text-base text-brand-dark leading-snug line-clamp-2 hover:text-brand-primary transition-colors">
                            <a href="{{ route('public.news.show', $item['slug']) }}">{{ $item['title'] }}</a>
                        </h3>
                        <p class="text-xs text-brand-muted leading-relaxed line-clamp-2">
                            {{ $item['desc'] }}
                        </p>
                    </div>
                </div>
                <div class="p-6 pt-0 border-t border-slate-100 mt-4">
                    <a href="{{ route('public.news.show', $item['slug']) }}" class="text-xs font-bold text-brand-primary hover:underline inline-flex items-center gap-1">
                        <span>Baca Selengkapnya</span>
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </article>
        @endforeach
    </div>

    <!-- Pagination Mockup -->
    <div class="pt-8 flex items-center justify-center gap-2 text-xs font-bold">
        <button disabled class="px-4 py-2 rounded-xl bg-slate-100 text-slate-400 cursor-not-allowed">Sebelumnya</button>
        <button class="px-4 py-2 rounded-xl bg-brand-primary text-white shadow-sm">1</button>
        <button class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-brand-dark hover:bg-slate-50">2</button>
        <button class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-brand-dark hover:bg-slate-50">Selanjutnya</button>
    </div>
</div>
@endsection

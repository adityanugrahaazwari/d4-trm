@extends('layouts.public')

@section('title', 'Sambutan Ketua Program Studi - D-4 TRM POLITALA')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-28 sm:pt-32 lg:pt-36 pb-12 lg:pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Profil</span>
            <span>/</span>
            <span class="text-brand-dark">Sambutan Kaprodi</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Sambutan Ketua Program Studi</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Pesan dari pimpinan Program Studi D-4 Teknik Rekayasa Multimedia</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi]
            </span>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="bg-white rounded-3xl border border-slate-200/80 p-8 sm:p-12 shadow-xs grid grid-cols-1 md:grid-cols-12 gap-10 items-start">
        <!-- Kaprodi Photo & Profile -->
        <div class="md:col-span-4 space-y-4 text-center md:text-left">
            <div class="aspect-4/5 rounded-2xl bg-gradient-to-tr from-slate-200 to-slate-100 flex flex-col items-center justify-center p-6 border border-slate-200 text-slate-400">
                <svg class="w-24 h-24 opacity-40 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-xs font-medium text-slate-500">[Foto Resmi Kaprodi]</span>
            </div>
            <div>
                <div class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200 mb-1">
                    [Nama Simulasi]
                </div>
                <h3 class="font-bold text-base text-brand-dark">[Nama Ketua Program Studi, M.Kom.]</h3>
                <p class="text-xs text-brand-muted">Koordinator Program Studi D-4 TRM</p>
                <p class="text-xs text-slate-500 mt-1">Jurusan Komputer dan Bisnis, POLITALA</p>
            </div>
        </div>

        <!-- Sambutan Message Content -->
        <div class="md:col-span-8 space-y-6 text-slate-700 leading-relaxed text-sm sm:text-base">
            <div class="border-b border-slate-100 pb-4">
                <h2 class="text-xl sm:text-2xl font-bold text-brand-primary">Assalamu’alaikum Warahmatullahi Wabarakatuh &amp; Salam Sejahtera,</h2>
            </div>
            
            <p>
                Selamat datang di website resmi Program Studi Sarjana Terapan (D-4) <strong>Teknik Rekayasa Multimedia (TRM)</strong> Politeknik Negeri Tanah Laut.
            </p>

            <p>
                Era transformasi digital saat ini menuntut sinergi antara kemampuan rekayasa perangkat lunak dan kepekaan seni multimedia. TRM POLITALA hadir dengan visi mencetak sarjana terapan yang tidak hanya memahami teori komputasi, tetapi juga mahir merancang game, memproduksi aset 3D &amp; animasi, serta membangun solusi virtual dan augmented reality yang relevan dengan kebutuhan dunia kerja saat ini.
            </p>

            <p>
                Melalui kurikulum berbasis <em>Teaching Factory</em> dan <em>Project-Based Learning</em>, mahasiswa kami dipersiapkan sejak semester awal untuk mengerjakan proyek nyata bersama mitra industri. Kami berkomitmen untuk menyediakan iklim akademik yang kolaboratif, fasilitas laboratorium berteknologi terkini, dan bimbingan dosen yang berdedikasi.
            </p>

            <p>
                Kami mengajak seluruh calon mahasiswa, mitra industri, dan masyarakat untuk bersama-sama mengembangkan ekosistem multimedia terapan yang unggul dan berdaya saing.
            </p>

            <div class="pt-6 border-t border-slate-100 flex flex-col items-start gap-1">
                <span class="text-xs text-slate-500">Wassalamu’alaikum Warahmatullahi Wabarakatuh.</span>
                <span class="font-bold text-sm text-brand-dark mt-2">[Tanda Tangan Digital Kaprodi]</span>
                <span class="text-xs text-brand-muted">Koordinator Program Studi D-4 TRM</span>
            </div>
        </div>
    </div>
</div>
@endsection

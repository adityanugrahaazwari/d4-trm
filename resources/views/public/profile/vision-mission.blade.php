@extends('layouts.public')

@section('title', 'Visi & Misi - D-4 TRM POLITALA')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Profil</span>
            <span>/</span>
            <span class="text-brand-dark">Visi &amp; Misi</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Visi, Misi &amp; Tujuan</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Arah strategis dan komitmen pengembangan keilmuan vokasi multimedia</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi]
            </span>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-12">
    <!-- Visi Box -->
    <div class="rounded-3xl bg-gradient-to-br from-brand-primary to-brand-primary-dark text-white p-8 sm:p-12 shadow-lg relative overflow-hidden">
        <div class="relative z-10 space-y-4">
            <span class="inline-flex px-3 py-1 rounded-full bg-brand-cream text-brand-dark text-xs font-bold uppercase tracking-wider">
                Visi Program Studi (Tahun 2035)
            </span>
            <blockquote class="text-xl sm:text-2xl lg:text-3xl font-extrabold leading-snug">
                "Menjadi pusat pendidikan vokasi unggulan dan rujukan di bidang teknologi rekayasa multimedia terapan yang berdaya saing global, inovatif, dan berakhlak mulia."
            </blockquote>
        </div>
    </div>

    <!-- Misi Cards Grid -->
    <div class="space-y-6">
        <div class="space-y-1">
            <h2 class="text-2xl font-bold text-brand-dark">Misi Program Studi</h2>
            <p class="text-sm text-brand-muted">Empat pilar utama pelaksanaan Tridharma Perguruan Tinggi di D-4 TRM POLITALA</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-7 rounded-2xl border border-slate-200/80 shadow-xs flex gap-4">
                <div class="w-10 h-10 rounded-xl bg-brand-primary-light text-brand-primary flex items-center justify-center font-bold text-lg shrink-0">
                    1
                </div>
                <div class="space-y-2">
                    <h3 class="font-bold text-base text-brand-dark">Pendidikan Vokasi Selaras Industri</h3>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                        Menyelenggarakan pendidikan sarjana terapan berbasis Project-Based Learning yang mengintegrasikan rekayasa sistem komputer dan kreativitas multimedia sesuai kebutuhan industri.
                    </p>
                </div>
            </div>

            <div class="bg-white p-7 rounded-2xl border border-slate-200/80 shadow-xs flex gap-4">
                <div class="w-10 h-10 rounded-xl bg-brand-primary-light text-brand-primary flex items-center justify-center font-bold text-lg shrink-0">
                    2
                </div>
                <div class="space-y-2">
                    <h3 class="font-bold text-base text-brand-dark">Penelitian Terapan yang Bermanfaat</h3>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                        Mengembangkan penelitian terapan dan karya inovasi tepat guna di bidang animasi, game teknologi, simulasi virtual, dan media interaktif.
                    </p>
                </div>
            </div>

            <div class="bg-white p-7 rounded-2xl border border-slate-200/80 shadow-xs flex gap-4">
                <div class="w-10 h-10 rounded-xl bg-brand-primary-light text-brand-primary flex items-center justify-center font-bold text-lg shrink-0">
                    3
                </div>
                <div class="space-y-2">
                    <h3 class="font-bold text-base text-brand-dark">Pengabdian Masyarakat Nyata</h3>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                        Menerapkan produk teknologi multimedia untuk membantu transformasi digital masyarakat, UMKM daerah, instansi pemerintah, dan institusi pendidikan.
                    </p>
                </div>
            </div>

            <div class="bg-white p-7 rounded-2xl border border-slate-200/80 shadow-xs flex gap-4">
                <div class="w-10 h-10 rounded-xl bg-brand-primary-light text-brand-primary flex items-center justify-center font-bold text-lg shrink-0">
                    4
                </div>
                <div class="space-y-2">
                    <h3 class="font-bold text-base text-brand-dark">Kemitraan Strategis DUDI</h3>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                        Memperkuat kolaborasi sinergis dengan Dunia Usaha dan Dunia Industri (DUDI) baik skala lokal, nasional, maupun internasional dalam skema magang, riset bersama, dan sertifikasi profesi.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tujuan Program Studi -->
    <div class="bg-brand-surface rounded-2xl border border-slate-200/80 p-8 space-y-4">
        <h3 class="text-lg font-bold text-brand-dark">Tujuan Program Studi D-4 TRM</h3>
        <ul class="space-y-2.5 text-xs sm:text-sm text-slate-700 list-disc list-inside">
            <li>Menghasilkan lulusan yang menguasai keahlian rekayasa multimedia siap kerja dengan sertifikasi kompetensi bertaraf nasional dan internasional.</li>
            <li>Menghasilkan produk riset terapan bidang game, animasi, dan media imersif yang bernilai paten dan bernilai komersial bagi industri.</li>
            <li>Mewujudkan tata kelola program studi yang transparan, akuntabel, dan berdaya saing berlandaskan penjaminan mutu berkelanjutan.</li>
        </ul>
    </div>
</div>
@endsection

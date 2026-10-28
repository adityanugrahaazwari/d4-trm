@extends('layouts.public')

@section('title', 'Kalender Akademik - D-IV TRM POLITALA')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-28 sm:pt-32 lg:pt-36 pb-12 lg:pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Akademik</span>
            <span>/</span>
            <span class="text-brand-dark">Kalender Akademik</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Kalender Akademik</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Jadwal kegiatan perkuliahan, registrasi, ujian, dan libur tahun akademik 2026/2027</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi Kalender]
            </span>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-10">
    <!-- Download Banner -->
    <div class="bg-brand-primary-light rounded-2xl border border-brand-primary/20 p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-brand-primary text-white flex items-center justify-center font-bold shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-sm text-brand-dark">Unduh Kalender Akademik Resmi POLITALA</h3>
                <p class="text-xs text-brand-muted">Format PDF resmi disahkan oleh Wakil Direktur Bidang Akademik.</p>
            </div>
        </div>
        <button type="button" class="px-4 py-2.5 rounded-xl bg-brand-primary text-white text-xs font-bold hover:bg-brand-primary-hover shadow-sm transition-all whitespace-nowrap">
            Unduh Berkas PDF
        </button>
    </div>

    <!-- Timeline Semester Ganjil -->
    <div class="space-y-4">
        <h2 class="text-xl font-bold text-brand-dark flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-brand-primary"></span>
            <span>Semester Ganjil 2026/2027</span>
        </h2>

        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs divide-y divide-slate-100 overflow-hidden text-xs sm:text-sm">
            <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div class="space-y-1">
                    <h4 class="font-bold text-brand-dark">Registrasi Ulang &amp; Pembayaran UKT</h4>
                    <p class="text-xs text-brand-muted">Pengisian Kartu Rencana Studi (KRS) online</p>
                </div>
                <div class="text-xs font-bold text-brand-secondary bg-brand-sky-light px-3 py-1.5 rounded-lg whitespace-nowrap">
                    01 Agustus â€“ 15 Agustus 2026
                </div>
            </div>

            <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div class="space-y-1">
                    <h4 class="font-bold text-brand-dark">Pengenalan Kehidupan Kampus Mahasiswa Baru (PKKMB)</h4>
                    <p class="text-xs text-brand-muted">Orientasi mahasiswa baru Politeknik Negeri Tanah Laut</p>
                </div>
                <div class="text-xs font-bold text-brand-primary bg-brand-primary-light px-3 py-1.5 rounded-lg whitespace-nowrap">
                    18 Agustus â€“ 22 Agustus 2026
                </div>
            </div>

            <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div class="space-y-1">
                    <h4 class="font-bold text-brand-dark">Perkuliahan &amp; Praktikum Tengah Semester I</h4>
                    <p class="text-xs text-brand-muted">Pekan perkuliahan aktif minggu 1 s.d. 8</p>
                </div>
                <div class="text-xs font-bold text-slate-700 bg-slate-100 px-3 py-1.5 rounded-lg whitespace-nowrap">
                    25 Agustus â€“ 17 Oktober 2026
                </div>
            </div>

            <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div class="space-y-1">
                    <h4 class="font-bold text-brand-dark">Ujian Tengah Semester (UTS) / Evaluasi Proyek</h4>
                    <p class="text-xs text-brand-muted">Penilaian berbasis uji teori dan review portofolio project</p>
                </div>
                <div class="text-xs font-bold text-amber-800 bg-amber-50 px-3 py-1.5 rounded-lg whitespace-nowrap">
                    20 Oktober â€“ 31 Oktober 2026
                </div>
            </div>

            <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div class="space-y-1">
                    <h4 class="font-bold text-brand-dark">Ujian Akhir Semester (UAS) &amp; Pameran Produk Karya</h4>
                    <p class="text-xs text-brand-muted">Showcase produk multimedia akhir semester mahasiswa</p>
                </div>
                <div class="text-xs font-bold text-emerald-800 bg-emerald-50 px-3 py-1.5 rounded-lg whitespace-nowrap">
                    22 Desember 2026 â€“ 05 Januari 2027
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

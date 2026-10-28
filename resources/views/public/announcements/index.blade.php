@extends('layouts.public')

@section('title', 'Pengumuman Akademik - D-IV TRM POLITALA')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-28 sm:pt-32 lg:pt-36 pb-12 lg:pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Informasi</span>
            <span>/</span>
            <span class="text-brand-dark">Pengumuman</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Pengumuman Resmi</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Surat edaran, jadwal registrasi, dan pemberitahuan penting untuk sivitas akademika</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi Pengumuman]
            </span>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-6">
    @php
        $announcements = [
            ['title' => '[Pengumuman] Jadwal Registrasi & Pengisian KRS Semester Genap TA 2026/2027', 'date' => '20 Okt 2026', 'num' => 'No: 042/PL34/AK/2026', 'tag' => 'Penting', 'file' => 'Edaran_KRS_Genap_2026.pdf'],
            ['title' => '[Pengumuman] Pendaftaran Calon Asisten Laboratorium Multimedia & Komputasi', 'date' => '17 Okt 2026', 'num' => 'No: 039/PL34.1/TRM/2026', 'tag' => 'Rekrutmen', 'file' => 'Syarat_Asisten_Lab_2026.pdf'],
            ['title' => '[Pengumuman] Jadwal Pelaksanaan Ujian Sertifikasi Kompetensi Junior Animator', 'date' => '12 Okt 2026', 'num' => 'No: 035/LSP-POLITALA/2026', 'tag' => 'Sertifikasi', 'file' => 'Jadwal_Sertifikasi_LSP.pdf'],
            ['title' => '[Pengumuman] Batas Waktu Pengajuan Bebas Tanggungan Perpustakaan & Lab', 'date' => '05 Okt 2026', 'num' => 'No: 031/PL34/BAAK/2026', 'tag' => 'Administrasi', 'file' => 'Edaran_Bebas_Tanggungan.pdf'],
            ['title' => '[Pengumuman] Sosialisasi Beasiswa Prestasi Mahasiswa Vokasi Berkelanjutan', 'date' => '28 Sep 2026', 'num' => 'No: 028/PL34/KM/2026', 'tag' => 'Beasiswa', 'file' => 'Panduan_Beasiswa_2026.pdf'],
        ];
    @endphp

    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs divide-y divide-slate-100 overflow-hidden">
        @foreach ($announcements as $a)
            <div class="p-6 sm:p-7 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-slate-50/80 transition-colors">
                <div class="space-y-1.5">
                    <div class="flex items-center gap-2 text-xs">
                        <span class="px-2.5 py-0.5 rounded-full font-bold text-[10px] bg-brand-primary-light text-brand-primary">
                            {{ $a['tag'] }}
                        </span>
                        <span class="text-brand-muted">{{ $a['date'] }}</span>
                        <span class="text-slate-300">&bull;</span>
                        <span class="font-mono text-slate-500">{{ $a['num'] }}</span>
                    </div>
                    <h3 class="font-bold text-base text-brand-dark hover:text-brand-primary transition-colors cursor-pointer">
                        {{ $a['title'] }}
                    </h3>
                </div>
                <button type="button" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-brand-dark hover:border-brand-primary hover:text-brand-primary hover:bg-brand-primary-light transition-all whitespace-nowrap">
                    <svg class="w-4 h-4 text-brand-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Unduh PDF</span>
                </button>
            </div>
        @endforeach
    </div>
</div>
@endsection

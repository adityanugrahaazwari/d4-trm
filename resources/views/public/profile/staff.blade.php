@extends('layouts.public')

@section('title', 'Tenaga Kependidikan - D-4 TRM POLITALA')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Profil</span>
            <span>/</span>
            <span class="text-brand-dark">Tenaga Kependidikan</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Tenaga Kependidikan</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Staf administrasi, pranata laboratorium pendidikan, dan teknisi sistem pendukung</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi Tendik]
            </span>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-10">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $staff = [
                ['name' => '[Nama Pranata Lab 1, A.Md.Kom.]', 'nip' => '199508102022031008', 'unit' => 'Pranata Laboratorium Pendidikan (PLP)', 'desc' => 'Pengelolaan perangkat keras, workstation grafis & server lab multimedia.'],
                ['name' => '[Nama Pranata Lab 2, S.Kom.]', 'nip' => '199604152023022009', 'unit' => 'Teknisi Studio Audio & Video', 'desc' => 'Pemeliharaan kamera cinema, lighting studio, dan perangkat audio recording.'],
                ['name' => '[Nama Staf Administrasi, S.AP.]', 'nip' => '199312012020122010', 'unit' => 'Administrasi Akademik & Kemahasiswaan', 'desc' => 'Layanan surat pengantar, registrasi mahasiswa, dan tata naskah dinas prodi.'],
            ];
        @endphp

        @foreach ($staff as $s)
            <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-xs flex flex-col justify-between space-y-4">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-brand-sky-light text-brand-primary flex items-center justify-center font-bold text-lg shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-brand-secondary uppercase tracking-wider block">
                            {{ $s['unit'] }}
                        </span>
                        <h3 class="font-bold text-sm text-brand-dark leading-tight">{{ $s['name'] }}</h3>
                        <p class="text-xs text-brand-muted mt-0.5">NIP: {{ $s['nip'] }}</p>
                    </div>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                    {{ $s['desc'] }}
                </p>
            </div>
        @endforeach
    </div>
</div>
@endsection

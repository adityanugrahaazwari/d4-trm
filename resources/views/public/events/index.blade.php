@extends('layouts.public')

@section('title', 'Agenda Kegiatan - D-IV TRM POLITALA')
@section('meta_description', 'Jadwal seminar, kuliah pakar, workshop kreatif, expo karya mahasiswa, dan pameran teknologi multimedia D-IV TRM POLITALA.')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-28 sm:pt-32 lg:pt-36 pb-12 lg:pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Informasi</span>
            <span>/</span>
            <span class="text-brand-dark">Agenda</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Agenda Kegiatan</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Jadwal seminar, kuliah pakar, workshop kreatif, dan pameran teknologi multimedia</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi Agenda]
            </span>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-6">
    @php
        $events = [
            [
                'slug' => 'kuliah-pakar-pipeline-animasi-3d-studio-hollywood',
                'day' => '28',
                'month' => 'OKT',
                'year' => '2026',
                'title' => '[Agenda] Kuliah Pakar: Pipeline Animasi 3D Studio Hollywood',
                'time' => '09:00 - 12:00 WITA',
                'loc' => 'Auditorium POLITALA & Zoom',
                'speaker' => 'Senior 3D Artist dari Studio Internasional',
                'tag' => 'Kuliah Pakar',
                'status' => 'Pendaftaran Dibuka'
            ],
            [
                'slug' => 'workshop-pembuatan-game-interaktif-unreal-engine-5',
                'day' => '05',
                'month' => 'NOV',
                'year' => '2026',
                'title' => '[Agenda] Workshop Pembuatan Game Interaktif Menggunakan Unreal Engine 5',
                'time' => '08:30 - 16:00 WITA',
                'loc' => 'Lab Komputasi Multimedia TRM',
                'speaker' => 'Lead Gameplay Programmer',
                'tag' => 'Workshop',
                'status' => 'Pendaftaran Dibuka'
            ],
            [
                'slug' => 'seminar-nasional-vokasi-teknologi-imersif-industri-5',
                'day' => '14',
                'month' => 'NOV',
                'year' => '2026',
                'title' => '[Agenda] Seminar Nasional Vokasi: Masa Depan Teknologi Imersif di Era Industri 5.0',
                'time' => '09:00 - 14:00 WITA',
                'loc' => 'Gedung TI Lt. 3 POLITALA',
                'speaker' => 'Praktisi VR/AR & Akademisi',
                'tag' => 'Seminar',
                'status' => 'Segera Dibuka'
            ],
            [
                'slug' => 'multimedia-expo-pameran-desain-interaktif-mahasiswa',
                'day' => '02',
                'month' => 'DES',
                'year' => '2026',
                'title' => '[Agenda] Multimedia Expo & Pameran Desain Interaktif Mahasiswa',
                'time' => '08:00 - 17:00 WITA',
                'loc' => 'Plaza Terbuka Kampus POLITALA',
                'speaker' => 'Karya Mahasiswa & Industri Tamu',
                'tag' => 'Pameran',
                'status' => 'Segera Dibuka'
            ],
        ];
    @endphp

    <div class="space-y-4">
        @foreach ($events as $ev)
            <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-xs flex flex-col sm:flex-row items-start sm:items-center gap-6 hover:border-brand-primary/40 hover:shadow-md transition-all group/card">
                <!-- Date Box Badge -->
                <a href="{{ route('public.events.show', $ev['slug']) }}" class="w-16 h-16 rounded-2xl bg-brand-primary-light border border-brand-primary/20 text-brand-primary flex flex-col items-center justify-center font-black shrink-0 group-hover/card:scale-105 group-hover/card:bg-brand-primary group-hover/card:text-white transition-all shadow-2xs">
                    <span class="text-xl leading-none">{{ $ev['day'] }}</span>
                    <span class="text-[10px] uppercase font-bold tracking-wider mt-0.5">{{ $ev['month'] }}</span>
                </a>

                <!-- Event Details -->
                <div class="flex-1 space-y-1.5">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-brand-sky-light text-brand-primary border border-brand-sky/40">
                            {{ $ev['tag'] }}
                        </span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $ev['status'] === 'Pendaftaran Dibuka' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600' }}">
                            {{ $ev['status'] }}
                        </span>
                    </div>

                    <h3 class="font-bold text-base text-brand-dark hover:text-brand-primary transition-colors">
                        <a href="{{ route('public.events.show', $ev['slug']) }}">
                            {{ $ev['title'] }}
                        </a>
                    </h3>
                    <div class="flex flex-wrap items-center gap-4 text-xs text-brand-muted">
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-brand-secondary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $ev['time'] }}</span>
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-brand-secondary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ $ev['loc'] }}</span>
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 pt-0.5">Pemateri: <span class="font-medium text-slate-700">{{ $ev['speaker'] }}</span></p>
                </div>

                <!-- Action Button -->
                <a href="{{ route('public.events.show', $ev['slug']) }}" class="px-4 py-2.5 rounded-xl bg-brand-primary text-white text-xs font-bold hover:bg-brand-primary-hover shadow-sm transition-all whitespace-nowrap self-stretch sm:self-auto text-center inline-flex items-center justify-center gap-1.5 group/btn">
                    <span>Detail Agenda</span>
                    <svg class="w-3.5 h-3.5 transition-transform group-hover/btn:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection

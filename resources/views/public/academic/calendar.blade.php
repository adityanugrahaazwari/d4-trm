@extends('layouts.public')

@section('title', 'Kalender Akademik - D-IV TRM POLITALA')

@section('content')
<!-- Header Page -->
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-32 sm:pt-36 lg:pt-40 pb-12 lg:pb-16 mt-2 sm:mt-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-4 mt-2">
            <a href="{{ route('home') }}" class="hover:text-brand-primary transition-colors">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Akademik</span>
            <span>/</span>
            <span class="text-brand-dark">Kalender Akademik</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-6 mt-6 sm:mt-8">
            <div class="max-w-3xl space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-brand-primary/10 text-brand-primary border border-brand-primary/20">
                    <span class="w-2 h-2 rounded-full bg-brand-primary animate-pulse"></span>
                    <span>Tahun Akademik 2026/2027</span>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-brand-dark tracking-tight leading-tight">
                    Kalender Akademik Resmi
                </h1>
                <p class="text-sm sm:text-base text-brand-muted leading-relaxed">
                    Jadwal komprehensif pelaksanaan kegiatan perkuliahan, registrasi ulang KRS, masa ujian tengah/akhir semester, libur akademik, dan yudisium kelulusan mahasiswa TRM POLITALA.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <span class="px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 shadow-xs flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    SK Wadir I Bidang Akademik
                </span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 space-y-12">
    <!-- Download Banner Card -->
    <div class="bg-gradient-to-r from-brand-primary-light via-brand-surface to-white rounded-3xl border border-brand-primary/25 p-6 sm:p-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 shadow-xs">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-brand-primary text-white flex items-center justify-center font-bold shrink-0 shadow-md shadow-brand-primary/20">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="space-y-1">
                <h3 class="font-extrabold text-base text-brand-dark">Unduh Dokumen Kalender Akademik Resmi (PDF)</h3>
                <p class="text-xs text-brand-muted">
                    Bagan kalender akademik resmi Politeknik Negeri Tanah Laut tahun ajaran 2026/2027 format PDF cetak.
                </p>
            </div>
        </div>
        <a href="#unduh-dokumen" 
           onclick="alert('Berkas resmi Kalender Akademik 2026/2027 dapat diakses melalui portal akademik POLITALA.')"
           class="px-5 py-3 rounded-2xl bg-brand-primary text-white hover:bg-brand-primary-hover text-xs font-bold shadow-md transition-all whitespace-nowrap flex items-center gap-2 shrink-0">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            <span>Unduh Berkas PDF</span>
        </a>
    </div>

    <!-- Filter & Search Controls -->
    <div class="bg-white rounded-3xl border border-slate-200/90 p-5 sm:p-6 shadow-xs space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <!-- Semester Filter Tabs -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('public.academic.calendar', array_filter(['q' => $search, 'semester' => 'semua'])) }}"
                   class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ ($selectedSemester === 'semua' || empty($selectedSemester)) ? 'bg-brand-primary text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Semua Agenda
                </a>
                <a href="{{ route('public.academic.calendar', array_filter(['q' => $search, 'semester' => 'ganjil'])) }}"
                   class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ $selectedSemester === 'ganjil' ? 'bg-brand-primary text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Semester Ganjil
                </a>
                <a href="{{ route('public.academic.calendar', array_filter(['q' => $search, 'semester' => 'genap'])) }}"
                   class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ $selectedSemester === 'genap' ? 'bg-brand-primary text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Semester Genap
                </a>
            </div>

            <!-- Search Bar -->
            <form action="{{ route('public.academic.calendar') }}" method="GET" class="w-full sm:w-72 relative">
                @if(!empty($selectedSemester) && $selectedSemester !== 'semua')
                    <input type="hidden" name="semester" value="{{ $selectedSemester }}">
                @endif
                <input type="text" 
                       name="q" 
                       value="{{ $search }}" 
                       placeholder="Cari agenda, ujian, KRS..."
                       class="w-full pl-9 pr-8 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary transition-all">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                @if(!empty($search))
                    <a href="{{ route('public.academic.calendar', array_filter(['semester' => $selectedSemester !== 'semua' ? $selectedSemester : null])) }}" 
                       class="absolute right-2.5 top-2.5 text-slate-400 hover:text-rose-500">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif
            </form>
        </div>
    </div>

    <!-- Timeline List Section -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-extrabold text-brand-dark flex items-center gap-2.5">
                <span class="w-3.5 h-3.5 rounded-full bg-brand-primary"></span>
                <span>Rangkaian Agenda Akademik</span>
            </h2>
            <span class="text-xs text-brand-muted font-medium">{{ $calendars->count() }} kegiatan tercatat</span>
        </div>

        @if($calendars->isEmpty())
            <div class="text-center py-16 bg-white rounded-3xl border border-dashed border-slate-300 p-8 space-y-3">
                <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 mx-auto flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h4 class="font-bold text-sm text-brand-dark">Agenda Tidak Ditemukan</h4>
                <p class="text-xs text-brand-muted max-w-sm mx-auto">
                    Tidak ada agenda kalender akademik yang sesuai dengan kata kunci atau semester yang Anda pilih.
                </p>
                <a href="{{ route('public.academic.calendar') }}" class="inline-block px-4 py-2 rounded-xl bg-brand-primary text-white text-xs font-bold">
                    Reset Filter
                </a>
            </div>
        @else
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs divide-y divide-slate-100 overflow-hidden">
                @foreach ($calendars as $cal)
                    <div class="p-5 sm:p-6 flex flex-col md:flex-row md:items-center justify-between gap-4 hover:bg-slate-50/80 transition-colors">
                        <div class="space-y-1.5 flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider
                                    @if($cal->semester === 'ganjil')
                                        bg-blue-50 text-blue-700 border border-blue-200
                                    @elseif($cal->semester === 'genap')
                                        bg-purple-50 text-purple-700 border border-purple-200
                                    @else
                                        bg-emerald-50 text-emerald-700 border border-emerald-200
                                    @endif">
                                    Semester {{ ucfirst($cal->semester) }}
                                </span>
                                <span class="text-xs text-brand-muted font-mono">{{ $cal->academic_year }}</span>

                                @if($cal->is_ongoing)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 animate-pulse">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                        <span>Sedang Berjalan</span>
                                    </span>
                                @endif
                            </div>

                            <h3 class="font-extrabold text-base text-brand-dark leading-snug">
                                {{ $cal->title }}
                            </h3>

                            @if($cal->description)
                                <p class="text-xs text-brand-muted leading-relaxed max-w-2xl">
                                    {{ $cal->description }}
                                </p>
                            @endif
                        </div>

                        <!-- Date Badge -->
                        <div class="flex items-center gap-3 shrink-0 self-start md:self-center">
                            <div class="px-4 py-2.5 rounded-2xl bg-brand-surface border border-slate-200 text-brand-dark text-xs font-bold shadow-2xs flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-brand-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $cal->formatted_period }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

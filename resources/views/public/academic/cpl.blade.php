@extends('layouts.public')

@section('title', 'Capaian Pembelajaran Lulusan (CPL) - D-IV TRM POLITALA')

@section('content')
<!-- Header Page -->
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-24 sm:pt-28 lg:pt-32 pb-8 sm:pb-10 lg:pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary transition-colors">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Akademik</span>
            <span>/</span>
            <span class="text-brand-dark">Capaian Pembelajaran</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-6 mt-3 sm:mt-4">
            <div class="max-w-3xl space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-brand-primary/10 text-brand-primary border border-brand-primary/20">
                    <span class="w-2 h-2 rounded-full bg-brand-primary animate-pulse"></span>
                    <span>Standar Kerangka Kualifikasi Nasional Indonesia (KKNI Level 6)</span>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-brand-dark tracking-tight leading-tight">
                    Capaian Pembelajaran Lulusan (CPL)
                </h1>
                <p class="text-sm sm:text-base text-brand-muted leading-relaxed">
                    Standar kompetensi, kualifikasi, dan atribut lulusan Sarjana Terapan D-IV Teknologi Rekayasa Multimedia berbasis kurikulum Outcome-Based Education (OBE) yang selaras dengan kebutuhan dunia usaha dan dunia industri (DUDI).
                </p>
            </div>

            <!-- Quick Dimension Badges -->
            <div class="flex flex-wrap items-center gap-2">
                <span class="px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 shadow-xs">
                    {{ $totalCpl ?? 12 }} Butir CPL Terakreditasi
                </span>
                <span class="px-3.5 py-1.5 rounded-full text-xs font-semibold bg-brand-primary-light text-brand-primary border border-brand-primary/20">
                    4 Ranah Pembelajaran
                </span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12 lg:py-14 space-y-10 sm:space-y-12">
    <!-- OBE & KKNI Explanatory Banner -->
    <div class="p-6 sm:p-8 rounded-3xl bg-white border border-slate-200/90 shadow-xs grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="space-y-1.5">
            <span class="text-[10px] font-bold text-brand-primary uppercase tracking-wider">Standar Kualifikasi</span>
            <h3 class="font-extrabold text-base text-brand-dark">KKNI Level 6 Sarjana Terapan</h3>
            <p class="text-xs text-brand-muted leading-relaxed">
                Menghasilkan Sarjana Terapan Komputer (S.Tr.Kom.) dengan kemampuan manajerial, penguasaan konseptual, dan keterampilan teknis teruji.
            </p>
        </div>
        <div class="space-y-1.5">
            <span class="text-[10px] font-bold text-brand-secondary uppercase tracking-wider">Metode Pembelajaran</span>
            <h3 class="font-extrabold text-base text-brand-dark">OBE &amp; Project-Based Learning</h3>
            <p class="text-xs text-brand-muted leading-relaxed">
                Seluruh capaian diukur melalui portofolio karya nyata, tugas proyek industri, dan pengujian produk rekayasa multimedia.
            </p>
        </div>
        <div class="space-y-1.5">
            <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider">Validitas Industri</span>
            <h3 class="font-extrabold text-base text-brand-dark">Sertifikasi Kompetensi BNSP</h3>
            <p class="text-xs text-brand-muted leading-relaxed">
                Diselaraskan dengan Skema Sertifikasi Okupasi Nasional bidang Game Development, 3D Animation, dan Multimedia Designer.
            </p>
        </div>
    </div>

    <!-- CPL Categories Loop -->
    <div class="space-y-8">
        @php
            $dimensionMeta = [
                'sikap' => [
                    'title' => 'Ranah Sikap & Tata Nilai (Attitude)',
                    'desc' => 'Integritas moral, profesionalisme vokasi, kepatuhan HaKI, dan etika profesi di industri kreatif digital.',
                    'color' => 'blue',
                    'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'
                ],
                'pengetahuan' => [
                    'title' => 'Ranah Penguasaan Pengetahuan (Knowledge)',
                    'desc' => 'Penguasaan konsep teoretis matematika grafika, rendering pipeline, arsitektur game engine, dan UI/UX design.',
                    'color' => 'emerald',
                    'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'
                ],
                'keterampilan_umum' => [
                    'title' => 'Ranah Keterampilan Umum (General Skills)',
                    'desc' => 'Kemampuan berpikir logis, kritis, inovatif, komunikasi efektif, kepemimpinan tim, dan pengambilan keputusan berbasis data.',
                    'color' => 'amber',
                    'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'
                ],
                'keterampilan_khusus' => [
                    'title' => 'Ranah Keterampilan Khusus (Specific Skills)',
                    'desc' => 'Keahlian teknis rekayasa sistem game interaktif, simulasi VR/AR spasial, animasi 3D, dan aplikasi multimedia modern.',
                    'color' => 'purple',
                    'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'
                ],
            ];
        @endphp

        @foreach($dimensionMeta as $key => $meta)
            @php
                $items = $cpls->get($key, collect());
            @endphp

            @if($items->isNotEmpty())
                <div class="bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-8 shadow-xs space-y-6 hover:border-brand-primary/40 transition-all">
                    <!-- Category Header -->
                    <div class="flex items-start gap-4 pb-4 border-b border-slate-100">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0 shadow-xs
                            @if($meta['color'] === 'blue') bg-blue-50 text-blue-700
                            @elseif($meta['color'] === 'emerald') bg-emerald-50 text-emerald-700
                            @elseif($meta['color'] === 'amber') bg-amber-50 text-amber-700
                            @else bg-purple-50 text-purple-700
                            @endif">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $meta['icon'] }}" />
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <h2 class="text-lg sm:text-xl font-extrabold text-brand-dark">{{ $meta['title'] }}</h2>
                            <p class="text-xs text-brand-muted leading-relaxed">{{ $meta['desc'] }}</p>
                        </div>
                    </div>

                    <!-- Items List -->
                    <div class="space-y-3.5">
                        @foreach($items as $cpl)
                            <div class="p-4 rounded-2xl bg-brand-surface/60 border border-slate-100 hover:bg-brand-surface hover:border-slate-200 transition-all flex items-start gap-3.5">
                                <span class="px-2.5 py-1 rounded-xl font-mono text-xs font-black bg-brand-primary text-white shrink-0 shadow-2xs">
                                    {{ $cpl->code }}
                                </span>
                                <p class="text-xs sm:text-sm text-slate-700 leading-relaxed pt-0.5">
                                    {{ $cpl->description }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
@endsection

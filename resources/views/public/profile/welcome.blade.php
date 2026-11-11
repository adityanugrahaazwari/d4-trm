@extends('layouts.public')

@section('title', ($pageTitle ?? 'Sambutan Ketua Program Studi') . ' - D-4 TRM POLITALA')

@section('content')
<!-- Header Page -->
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-24 sm:pt-28 lg:pt-32 pb-8 sm:pb-10 lg:pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Profil</span>
            <span>/</span>
            <span class="text-brand-dark">Sambutan Kaprodi</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4 mt-3 sm:mt-4">
            <div class="space-y-1.5">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">
                    {{ $pageTitle ?? 'Sambutan Ketua Program Studi' }}
                </h1>
                <p class="text-sm sm:text-base text-brand-muted">
                    {{ $pageSubtitle ?? 'Pesan dan visi kepemimpinan Program Studi Sarjana Terapan Teknologi Rekayasa Multimedia' }}
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Pesan Resmi Pimpinan Prodi</span>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12 lg:py-14">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
        <!-- Kaprodi Photo & Profile Card (Left Column) -->
        <div class="lg:col-span-4 lg:sticky lg:top-28 space-y-6">
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-xs space-y-6 text-center sm:text-left">
                <!-- Foto Frame -->
                <div class="aspect-4/5 rounded-2xl overflow-hidden bg-gradient-to-tr from-brand-primary/10 via-brand-surface to-slate-100 border border-slate-200 relative group shadow-inner">
                    @if(!empty($kaprodiPhoto))
                        <img src="{{ $kaprodiPhoto }}" alt="{{ $kaprodiName }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center p-6 text-brand-primary/60">
                            <div class="w-24 h-24 rounded-full bg-brand-primary/10 flex items-center justify-center mb-3 text-brand-primary">
                                <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-brand-secondary">Foto Resmi Pimpinan</span>
                            <span class="text-[11px] text-brand-muted mt-0.5">D-IV TRM POLITALA</span>
                        </div>
                    @endif

                    <div class="absolute bottom-3 left-3 right-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-white/90 backdrop-blur-md text-[11px] font-bold text-brand-dark shadow-xs border border-white/60">
                            <svg class="w-3.5 h-3.5 text-brand-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Terverifikasi Pimpinan Prodi</span>
                        </span>
                    </div>
                </div>

                <!-- Informasi Kaprodi -->
                <div class="space-y-3">
                    <div>
                        <h2 class="font-extrabold text-lg sm:text-xl text-brand-dark tracking-tight">{{ $kaprodiName }}</h2>
                        <p class="text-xs font-semibold text-brand-primary mt-0.5">{{ $kaprodiPosition }}</p>
                        <p class="text-xs text-brand-muted mt-1">{{ $kaprodiDepartment }}</p>
                    </div>

                    <div class="pt-3 border-t border-slate-100 space-y-2 text-xs">
                        @if(!empty($kaprodiNip))
                            <div class="flex items-center justify-between text-slate-600 py-1 border-b border-slate-50">
                                <span class="text-brand-muted font-medium">NIP / NIDN</span>
                                <span class="font-bold text-brand-dark">{{ $kaprodiNip }}</span>
                            </div>
                        @endif

                        @if(!empty($period))
                            <div class="flex items-center justify-between text-slate-600 py-1 border-b border-slate-50">
                                <span class="text-brand-muted font-medium">Masa Jabatan</span>
                                <span class="font-semibold text-brand-secondary">{{ $period }}</span>
                            </div>
                        @endif

                        @if(!empty($kaprodiEmail))
                            <div class="flex items-center justify-between text-slate-600 py-1">
                                <span class="text-brand-muted font-medium">Email Kontak</span>
                                <a href="mailto:{{ $kaprodiEmail }}" class="font-medium text-brand-primary hover:underline truncate max-w-[170px]">
                                    {{ $kaprodiEmail }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Action Buttons -->
                <div class="pt-4 border-t border-slate-100 flex flex-col gap-2">
                    @if(!empty($kaprodiEmail))
                        <a href="mailto:{{ $kaprodiEmail }}" class="w-full py-2.5 px-4 rounded-xl bg-brand-primary hover:bg-brand-primary-hover text-white text-xs font-bold transition-all text-center flex items-center justify-center gap-2 shadow-xs">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>Hubungi Kaprodi</span>
                        </a>
                    @endif

                    <a href="{{ route('public.profile.lecturers') }}" class="w-full py-2 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-brand-dark text-xs font-semibold transition-all text-center flex items-center justify-center gap-2">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span>Direktori Dosen TRM</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sambutan Message Content (Right Column) -->
        <div class="lg:col-span-8 space-y-8">
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-10 shadow-xs space-y-8">
                <!-- Greeting Headline -->
                <div class="border-b border-slate-100 pb-5">
                    <span class="inline-block px-3 py-1 rounded-lg bg-brand-primary-light text-brand-primary text-xs font-bold uppercase tracking-wider mb-2">
                        Pesan Pembuka
                    </span>
                    <h2 class="text-xl sm:text-2xl font-extrabold text-brand-primary leading-tight">
                        {{ $greeting }}
                    </h2>
                </div>

                <!-- Highlight Quote Banner -->
                @if(!empty($quote))
                    <div class="relative rounded-2xl bg-gradient-to-r from-brand-primary/10 via-brand-surface to-white border-l-4 border-brand-primary p-6 sm:p-7">
                        <svg class="w-8 h-8 text-brand-primary/30 absolute top-4 right-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                        <p class="text-sm sm:text-base font-semibold text-brand-dark italic leading-relaxed pr-8">
                            "{{ $quote }}"
                        </p>
                        <span class="block text-xs font-bold text-brand-secondary mt-3">
                            &mdash; {{ $kaprodiName }}, {{ $kaprodiPosition }}
                        </span>
                    </div>
                @endif

                <!-- Uraian Isi Sambutan Lengkap -->
                <div class="space-y-4 text-slate-700 leading-relaxed text-sm sm:text-base">
                    @php
                        $paragraphs = preg_split('/\r\n|\r|\n/', (string) $content);
                    @endphp

                    @foreach($paragraphs as $p)
                        @if(trim($p) !== '')
                            <p class="text-justify sm:text-left">{{ trim($p) }}</p>
                        @endif
                    @endforeach
                </div>

                <!-- Pilar Prioritas & Program Unggulan Sambutan -->
                @if(!empty($keyPoints) && is_array($keyPoints))
                    <div class="pt-8 border-t border-slate-100 space-y-6">
                        <div>
                            <span class="text-xs font-bold text-brand-primary uppercase tracking-wider">Fokus Strategis</span>
                            <h3 class="text-lg sm:text-xl font-extrabold text-brand-dark mt-1">Pilar Keunggulan &amp; Prioritas Program Studi</h3>
                            <p class="text-xs sm:text-sm text-brand-muted mt-1">Komitmen utama TRM POLITALA dalam mendidik calon profesional multimedia.</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($keyPoints as $index => $point)
                                <div class="p-5 rounded-2xl bg-brand-surface/60 border border-slate-200/90 hover:border-brand-primary/50 transition-all space-y-2 group hover:bg-white shadow-2xs">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-brand-primary/10 text-brand-primary">
                                            {{ $point['badge'] ?? 'Pilar #' . ($index + 1) }}
                                        </span>
                                        <span class="text-[11px] font-bold text-slate-400 group-hover:text-brand-secondary">0{{ $index + 1 }}</span>
                                    </div>
                                    <h4 class="font-bold text-sm text-brand-dark group-hover:text-brand-primary transition-colors">
                                        {{ $point['title'] ?? '' }}
                                    </h4>
                                    <p class="text-xs text-slate-600 leading-relaxed">
                                        {{ $point['description'] ?? '' }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Opsional Video Sambutan -->
                @if(!empty($videoUrl))
                    <div class="pt-8 border-t border-slate-100 space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-xs font-bold text-brand-primary uppercase tracking-wider">Dokumentasi Audio Visual</span>
                                <h4 class="text-base sm:text-lg font-bold text-brand-dark mt-0.5">Video Sambutan Pimpinan Program Studi</h4>
                            </div>
                        </div>

                        @php
                            $embedUrl = null;
                            if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([\w-]{11})/', $videoUrl, $matches)) {
                                $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
                            }
                        @endphp

                        @if($embedUrl)
                            <div class="aspect-video rounded-2xl overflow-hidden border border-slate-200 shadow-xs bg-slate-900">
                                <iframe src="{{ $embedUrl }}" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        @else
                            <a href="{{ $videoUrl }}" target="_blank" rel="noopener noreferrer" class="p-4 rounded-2xl bg-brand-surface border border-slate-200 flex items-center justify-between hover:bg-slate-50 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="block text-xs font-bold text-brand-dark">Tonton Video Sambutan di Kanal Resmi</span>
                                        <span class="block text-[11px] text-brand-muted truncate max-w-sm sm:max-w-md">{{ $videoUrl }}</span>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-brand-primary flex items-center gap-1">
                                    <span>Buka</span>
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </span>
                            </a>
                        @endif
                    </div>
                @endif

                <!-- Formal Closing & Digital Signature -->
                <div class="pt-8 border-t border-slate-100 flex flex-col sm:flex-row items-start sm:items-end justify-between gap-6">
                    <div class="space-y-1">
                        <span class="text-xs text-brand-muted font-medium">{{ $closingGreeting ?? 'Wassalamu’alaikum Warahmatullahi Wabarakatuh.' }}</span>
                        <div class="pt-3">
                            <span class="font-bold text-sm sm:text-base text-brand-dark block">{{ $signatureName ?? $kaprodiName }}</span>
                            <span class="text-xs text-brand-muted block mt-0.5">{{ $signatureTitle ?? 'Koordinator Program Studi D-4 TRM' }}</span>
                            <span class="text-[11px] text-slate-500 block">{{ $kaprodiDepartment }}</span>
                        </div>
                    </div>

                    <!-- Digital Verification Seal -->
                    <div class="p-3.5 rounded-2xl bg-brand-surface border border-slate-200/80 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div class="text-[11px] leading-tight">
                            <span class="font-bold text-brand-dark block">Kanal Resmi Akademik</span>
                            <span class="text-brand-muted block text-[10px]">Politeknik Negeri Tanah Laut</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.public')

@section('title', ($news->title ?? 'Detail Berita') . ' - Berita TRM POLITALA')
@section('meta_description', Str::limit(strip_tags($news->excerpt ?? $news->content ?? ''), 160))

@section('content')
{{-- Breadcrumbs & Top Meta Header --}}
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-24 sm:pt-28 lg:pt-32 pb-8 sm:pb-10 lg:pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb Navigation --}}
        <nav class="flex flex-wrap items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-4">
            <a href="{{ route('home') }}" class="hover:text-brand-primary flex items-center gap-1.5 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Beranda</span>
            </a>
            <span class="text-slate-300">/</span>
            <a href="{{ route('public.news.index') }}" class="hover:text-brand-primary transition-colors">
                Berita &amp; Informasi
            </a>
            @if($news->category)
                <span class="text-slate-300">/</span>
                <a href="{{ route('public.news.index', ['category' => $news->category->slug]) }}" class="text-brand-secondary font-bold hover:underline">
                    {{ $news->category->name }}
                </a>
            @endif
        </nav>

        {{-- Category & Read Status Badges --}}
        <div class="flex flex-wrap items-center gap-2.5 mb-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-brand-primary text-white shadow-xs">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-sky animate-pulse"></span>
                {{ $news->category?->name ?? 'Informasi Resmi' }}
            </span>
            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Berita Resmi Prodi
            </span>
        </div>

        {{-- Main Headline --}}
        <h1 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-black text-brand-dark tracking-tight leading-tight sm:leading-snug max-w-5xl">
            {{ $news->title ?? 'Judul Berita' }}
        </h1>

        {{-- Article Metadata Bar --}}
        <div class="mt-6 pt-6 border-t border-slate-200/80 flex flex-wrap items-center justify-between gap-4 text-xs text-brand-muted">
            <div class="flex flex-wrap items-center gap-4 sm:gap-6">
                {{-- Author Info --}}
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-brand-primary to-brand-secondary text-white font-bold flex items-center justify-center text-xs shadow-xs">
                        TRM
                    </div>
                    <div>
                        <div class="font-bold text-brand-dark">{{ $news->author?->name ?? 'Humas & Publikasi TRM' }}</div>
                        <div class="text-[11px] text-brand-muted">Politeknik Negeri Tanah Laut</div>
                    </div>
                </div>

                <div class="hidden sm:block h-7 w-px bg-slate-200"></div>

                {{-- Date --}}
                <div class="flex items-center gap-1.5 font-medium text-slate-600">
                    <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>{{ $news->published_at ? $news->published_at->translatedFormat('l, d F Y') : date('l, d F Y') }}</span>
                </div>

                <div class="hidden sm:block h-7 w-px bg-slate-200"></div>

                {{-- Reading Time & Views --}}
                <div class="flex items-center gap-4">
                    @php
                        $wordCount = str_word_count(strip_tags((string) $news->content));
                        $minutes = max(1, ceil($wordCount / 180));
                    @endphp
                    <span class="flex items-center gap-1 font-medium text-slate-600">
                        <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ $minutes }} Menit Baca</span>
                    </span>
                    <span class="flex items-center gap-1 font-medium text-slate-600">
                        <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span>{{ number_format($news->views_count) }} Pembaca</span>
                    </span>
                </div>
            </div>

            {{-- Quick Action --}}
            <div class="flex items-center gap-2">
                <button onclick="window.print()" class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-brand-dark font-semibold transition-colors flex items-center gap-1.5 shadow-2xs" title="Cetak Artikel">
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    <span>Cetak</span>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Main Article Body & Sidebar --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
        
        {{-- Left Article Column (8 Columns) --}}
        <article class="lg:col-span-8 space-y-10">
            
            {{-- Featured Hero Image --}}
            <div class="space-y-3">
                @if(!empty($news->featured_image))
                    <div class="rounded-3xl overflow-hidden border border-slate-200 shadow-sm aspect-16/9">
                        <img src="{{ asset($news->featured_image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="rounded-3xl overflow-hidden border border-slate-200 bg-gradient-to-tr from-brand-primary-dark via-brand-primary to-slate-800 text-white relative shadow-sm aspect-16/9 flex flex-col justify-between p-8 sm:p-12">
                        <div class="absolute inset-0 bg-[radial-gradient(#3AA3A3_1px,transparent_1px)] [background-size:20px_20px] opacity-15 pointer-events-none"></div>
                        <div class="absolute -top-16 -right-16 w-64 h-64 rounded-full bg-brand-secondary/30 blur-3xl pointer-events-none"></div>

                        <div class="relative z-10 flex items-center justify-between">
                            <span class="px-3.5 py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-xs font-bold text-brand-cream flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                <span>Publikasi TRM POLITALA</span>
                            </span>
                            <span class="text-xs text-white/70 font-mono tracking-widest uppercase">{{ date('Y') }}/TRM-NEWS</span>
                        </div>

                        <div class="relative z-10 space-y-2">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-black/40 backdrop-blur-md text-[11px] text-brand-sky font-semibold border border-white/10">
                                <svg class="w-3.5 h-3.5 text-brand-cream" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                </svg>
                                <span>Program Studi Sarjana Terapan TRM</span>
                            </div>
                            <h3 class="text-lg sm:text-2xl font-extrabold text-white leading-tight">
                                {{ $news->title }}
                            </h3>
                        </div>
                    </div>
                @endif

                {{-- Photo Caption --}}
                <div class="flex items-start gap-2.5 px-3 py-2 text-xs text-brand-muted bg-slate-50 rounded-xl border border-slate-200/70">
                    <svg class="w-4 h-4 text-brand-primary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="leading-relaxed">
                        <strong class="text-brand-dark">Pelaihari, Tanah Laut</strong> &mdash; Dokumentasi resmi kegiatan Program Studi D-IV Teknologi Rekayasa Multimedia, Politeknik Negeri Tanah Laut.
                    </p>
                </div>
            </div>

            {{-- Lead Excerpt --}}
            @if(!empty($news->excerpt))
                <div class="p-6 rounded-2xl bg-gradient-to-r from-brand-primary/5 via-brand-surface to-white border-l-4 border-brand-primary text-brand-dark font-medium text-base sm:text-lg leading-relaxed shadow-2xs">
                    {{ $news->excerpt }}
                </div>
            @endif

            {{-- Main Article Text Content --}}
            <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed space-y-6 text-sm sm:text-base">
                @php
                    $paragraphs = array_filter(explode("\n", (string) $news->content), fn($p) => trim($p) !== '');
                @endphp

                @if(count($paragraphs) > 0)
                    @foreach($paragraphs as $idx => $para)
                        @if($idx === 0 && empty($news->excerpt))
                            <p class="text-base sm:text-lg font-medium text-brand-dark leading-relaxed">
                                <span class="float-left text-5xl font-black text-brand-primary leading-none pr-3 pt-1">{{ substr(trim($para), 0, 1) }}</span>
                                {{ substr(trim($para), 1) }}
                            </p>
                        @else
                            <p>{{ trim($para) }}</p>
                        @endif
                    @endforeach
                @else
                    <p>{{ $news->content }}</p>
                @endif
            </div>

            {{-- Tags Section --}}
            <div class="pt-6 border-t border-slate-200">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-xs font-bold text-brand-dark mr-1 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span>Tag Terkait:</span>
                    </span>
                    <a href="{{ route('public.news.index') }}" class="px-3 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-600 hover:bg-brand-primary hover:text-white transition-colors">#D4TRM</a>
                    <a href="{{ route('public.news.index') }}" class="px-3 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-600 hover:bg-brand-primary hover:text-white transition-colors">#Politala</a>
                    @if($news->category)
                        <a href="{{ route('public.news.index', ['category' => $news->category->slug]) }}" class="px-3 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-600 hover:bg-brand-primary hover:text-white transition-colors">
                            #{{ Str::studly($news->category->name) }}
                        </a>
                    @endif
                    <a href="{{ route('public.news.index') }}" class="px-3 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-600 hover:bg-brand-primary hover:text-white transition-colors">#VokasiKuat</a>
                    <a href="{{ route('public.news.index') }}" class="px-3 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-600 hover:bg-brand-primary hover:text-white transition-colors">#DigitalArtTech</a>
                </div>
            </div>

            {{-- Interactive Social Share Bar (Alpine.js) --}}
            @php
                $currentUrl = urlencode(url()->current());
                $shareTitle = urlencode($news->title);
            @endphp
            <div x-data="{ copied: false, copyUrl() { navigator.clipboard.writeText(window.location.href); this.copied = true; setTimeout(() => this.copied = false, 3000); } }" 
                 class="p-6 rounded-2xl bg-brand-surface border border-slate-200/80 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div>
                    <h4 class="font-bold text-sm text-brand-dark">Bagikan Informasi Ini</h4>
                    <p class="text-xs text-brand-muted">Sebarkan warta kegiatan multimedia vokasi kepada rekan Anda</p>
                </div>
                <div class="flex items-center gap-2">
                    {{-- WhatsApp --}}
                    <a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $currentUrl }}" target="_blank" rel="noopener noreferrer" 
                       class="w-10 h-10 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white flex items-center justify-center transition-colors shadow-2xs" title="Bagikan ke WhatsApp">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                    </a>

                    {{-- Facebook --}}
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $currentUrl }}" target="_blank" rel="noopener noreferrer"
                       class="w-10 h-10 rounded-xl bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center transition-colors shadow-2xs" title="Bagikan ke Facebook">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                        </svg>
                    </a>

                    {{-- LinkedIn --}}
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $currentUrl }}" target="_blank" rel="noopener noreferrer"
                       class="w-10 h-10 rounded-xl bg-sky-700 hover:bg-sky-800 text-white flex items-center justify-center transition-colors shadow-2xs" title="Bagikan ke LinkedIn">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                    </a>

                    {{-- Copy Link Button --}}
                    <button @click="copyUrl()" class="px-3.5 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-brand-dark text-xs font-bold transition-all flex items-center gap-1.5 shadow-2xs">
                        <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                        </svg>
                        <span x-text="copied ? 'Tersalin!' : 'Salin Tautan'"></span>
                    </button>
                </div>
            </div>

            {{-- Redaksi / Author Box --}}
            <div class="rounded-2xl bg-white border border-slate-200/80 p-6 sm:p-7 flex flex-col sm:flex-row items-center sm:items-start gap-5 shadow-xs">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-brand-primary to-brand-secondary text-white font-black text-xl flex items-center justify-center shrink-0 shadow-sm">
                    TRM
                </div>
                <div class="space-y-2 text-center sm:text-left flex-1">
                    <div class="flex flex-wrap items-center justify-center sm:justify-between gap-2">
                        <h4 class="font-extrabold text-base text-brand-dark">{{ $news->author?->name ?? 'Humas & Tim Publikasi TRM POLITALA' }}</h4>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-brand-primary-light text-brand-primary">Redaksi Resmi</span>
                    </div>
                    <p class="text-xs text-brand-muted leading-relaxed">
                        Dikelola oleh Tim Publikasi &amp; Hubungan Media Program Studi Sarjana Terapan Teknologi Rekayasa Multimedia, Politeknik Negeri Tanah Laut. Berkomitmen menyajikan warta akurat seputar riset terapan, kegiatan akademik, dan kemitraan industri.
                    </p>
                    <div class="pt-1 flex flex-wrap items-center justify-center sm:justify-start gap-4 text-xs font-semibold text-brand-primary">
                        <a href="mailto:trm@politala.ac.id" class="hover:underline flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>Kontak Redaksi: trm@politala.ac.id</span>
                        </a>
                        <span class="text-slate-300">&bull;</span>
                        <a href="{{ route('public.contact') }}" class="hover:underline">Sekretariat Prodi</a>
                    </div>
                </div>
            </div>

            {{-- Previous & Next Navigation --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                @if($prevNews)
                    <a href="{{ route('public.news.show', $prevNews->slug) }}" class="p-5 rounded-2xl bg-white border border-slate-200/80 hover:border-brand-primary/50 hover:shadow-md transition-all group flex flex-col justify-between space-y-3">
                        <span class="text-[11px] font-bold text-brand-muted uppercase tracking-wider flex items-center gap-1 group-hover:text-brand-primary transition-colors">
                            <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            <span>Berita Sebelumnya</span>
                        </span>
                        <h5 class="font-bold text-sm text-brand-dark group-hover:text-brand-primary transition-colors line-clamp-2">
                            {{ $prevNews->title }}
                        </h5>
                        <span class="text-[11px] text-slate-400">
                            {{ $prevNews->published_at ? $prevNews->published_at->translatedFormat('d M Y') : '' }}
                        </span>
                    </a>
                @else
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/50 text-slate-400 flex flex-col justify-center">
                        <span class="text-[11px] uppercase tracking-wider font-semibold">Tidak Ada Berita Sebelumnya</span>
                    </div>
                @endif

                @if($nextNews)
                    <a href="{{ route('public.news.show', $nextNews->slug) }}" class="p-5 rounded-2xl bg-white border border-slate-200/80 hover:border-brand-primary/50 hover:shadow-md transition-all group flex flex-col justify-between space-y-3 text-right">
                        <span class="text-[11px] font-bold text-brand-muted uppercase tracking-wider flex items-center justify-end gap-1 group-hover:text-brand-primary transition-colors">
                            <span>Berita Selanjutnya</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                        <h5 class="font-bold text-sm text-brand-dark group-hover:text-brand-primary transition-colors line-clamp-2">
                            {{ $nextNews->title }}
                        </h5>
                        <span class="text-[11px] text-slate-400">
                            {{ $nextNews->published_at ? $nextNews->published_at->translatedFormat('d M Y') : '' }}
                        </span>
                    </a>
                @else
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/50 text-slate-400 flex flex-col justify-center text-right">
                        <span class="text-[11px] uppercase tracking-wider font-semibold">Tidak Ada Berita Selanjutnya</span>
                    </div>
                @endif
            </div>

            {{-- Interactive Comments & Discussion (Alpine.js) --}}
            <section x-data="{
                comments: [
                    { id: 1, name: 'Ahmad Fauzan', role: 'Mahasiswa TRM Angkatan 2024', time: '1 jam yang lalu', text: 'Kabar perkembangan prodi yang sangat positif dan membanggakan!' },
                    { id: 2, name: 'Rina Kartika, S.Tr.Kom.', role: 'Alumni TRM', time: 'Kemarin', text: 'Semoga terus konsisten memperluas jaringan dan kualitas pembelajaran vokasi terapan.' }
                ],
                newName: '',
                newRole: 'Mahasiswa',
                newComment: '',
                submitted: false,
                addComment() {
                    if (this.newName.trim() === '' || this.newComment.trim() === '') return;
                    this.comments.unshift({
                        id: Date.now(),
                        name: this.newName,
                        role: this.newRole + ' TRM',
                        time: 'Baru saja',
                        text: this.newComment
                    });
                    this.newName = '';
                    this.newComment = '';
                    this.submitted = true;
                    setTimeout(() => this.submitted = false, 4000);
                }
            }" class="rounded-3xl bg-white border border-slate-200/80 p-6 sm:p-8 space-y-6 shadow-xs">
                
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-2">
                        <h3 class="font-extrabold text-base sm:text-lg text-brand-dark">Tanggapan &amp; Komentar</h3>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-brand-primary-light text-brand-primary" x-text="comments.length"></span>
                    </div>
                    <span class="text-xs text-brand-muted">Diskusi Akademik</span>
                </div>

                {{-- Alert Sukses --}}
                <div x-show="submitted" x-transition class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>Tanggapan Anda berhasil ditambahkan ke daftar diskusi!</span>
                </div>

                {{-- Form Kirim Tanggapan --}}
                <form @submit.prevent="addComment()" class="space-y-4 bg-brand-surface p-5 rounded-2xl border border-slate-200/80">
                    <h4 class="text-xs font-bold text-brand-dark uppercase tracking-wider">Tuliskan Tanggapan Anda</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap *</label>
                            <input x-model="newName" type="text" placeholder="Nama Anda" required class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20 focus:outline-none bg-white">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Status / Peran</label>
                            <select x-model="newRole" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20 focus:outline-none bg-white">
                                <option value="Mahasiswa">Mahasiswa</option>
                                <option value="Dosen">Dosen / Tenaga Pendidik</option>
                                <option value="Alumni">Alumni</option>
                                <option value="Praktisi Industri">Praktisi Industri</option>
                                <option value="Masyarakat Umum">Masyarakat Umum</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Komentar / Ulasan *</label>
                        <textarea x-model="newComment" rows="3" placeholder="Tuliskan apresiasi atau tanggapan Anda seputar berita ini..." required class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20 focus:outline-none bg-white"></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-primary-hover text-white text-xs font-bold transition-all shadow-xs flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            <span>Kirim Tanggapan</span>
                        </button>
                    </div>
                </form>

                {{-- List Komentar --}}
                <div class="space-y-4 pt-2">
                    <template x-for="item in comments" :key="item.id">
                        <div class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-2xs space-y-2">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full bg-brand-primary/10 text-brand-primary font-bold text-xs flex items-center justify-center" x-text="item.name.charAt(0)"></div>
                                    <div>
                                        <div class="font-bold text-xs text-brand-dark" x-text="item.name"></div>
                                        <div class="text-[10px] text-brand-muted" x-text="item.role"></div>
                                    </div>
                                </div>
                                <span class="text-[10px] text-slate-400 font-medium" x-text="item.time"></span>
                            </div>
                            <p class="text-xs text-slate-700 leading-relaxed pl-10" x-text="item.text"></p>
                        </div>
                    </template>
                </div>
            </section>

        </article>

        {{-- Right Sidebar Column (4 Columns) --}}
        <aside class="lg:col-span-4 space-y-8">
            
            {{-- Search News Widget --}}
            <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs space-y-3">
                <h4 class="font-extrabold text-sm text-brand-dark flex items-center gap-2">
                    <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span>Cari Berita TRM</span>
                </h4>
                <form action="{{ route('public.news.index') }}" method="GET" class="relative">
                    <input type="text" name="q" placeholder="Ketik kata kunci..." class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20 focus:outline-none bg-brand-surface">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </form>
            </div>

            {{-- Related & Trending News --}}
            <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs space-y-5">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h4 class="font-extrabold text-sm text-brand-dark flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-brand-primary"></span>
                        <span>Berita Terkait</span>
                    </h4>
                    <a href="{{ route('public.news.index') }}" class="text-xs font-bold text-brand-primary hover:underline">Semua</a>
                </div>

                <div class="space-y-4">
                    @forelse ($relatedNews as $item)
                        <a href="{{ route('public.news.show', $item->slug) }}" class="group flex gap-3.5 items-start">
                            <div class="w-16 h-16 rounded-xl bg-slate-100 shrink-0 border border-slate-200/80 overflow-hidden flex items-center justify-center text-slate-400 group-hover:border-brand-primary/40 transition-colors">
                                @if(!empty($item->featured_image))
                                    <img src="{{ asset($item->featured_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-5 h-5 text-slate-400 group-hover:text-brand-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                @endif
                            </div>
                            <div class="space-y-1 min-w-0">
                                <div class="flex items-center gap-1.5 text-[10px] text-brand-muted">
                                    <span class="font-bold text-brand-secondary">{{ $item->category?->name ?? 'Informasi' }}</span>
                                    <span>&bull;</span>
                                    <span>{{ $item->published_at ? $item->published_at->translatedFormat('d M Y') : date('d M Y') }}</span>
                                </div>
                                <h5 class="text-xs font-bold text-brand-dark group-hover:text-brand-primary transition-colors leading-snug line-clamp-2">
                                    {{ $item->title }}
                                </h5>
                            </div>
                        </a>
                    @empty
                        <p class="text-xs text-slate-500">Tidak ada berita terkait lainnya.</p>
                    @endforelse
                </div>
            </div>

            {{-- Quick Links to Pengumuman & Agenda --}}
            <div class="p-6 rounded-2xl bg-gradient-to-br from-brand-primary/5 via-brand-surface to-brand-sky/10 border border-brand-primary/20 shadow-xs space-y-4">
                <h4 class="font-extrabold text-sm text-brand-dark flex items-center gap-2 border-b border-slate-200/80 pb-2">
                    <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <span>Informasi Akademik Lainnya</span>
                </h4>
                
                <div class="space-y-2">
                    <a href="{{ route('public.announcements.index') }}" class="flex items-center justify-between p-3 rounded-xl bg-white border border-slate-200 hover:border-brand-primary/40 hover:shadow-xs transition-all group">
                        <div class="flex items-center gap-2.5">
                            <span class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-xs">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </span>
                            <div>
                                <div class="text-xs font-bold text-brand-dark group-hover:text-brand-primary transition-colors">Pengumuman Resmi</div>
                                <div class="text-[10px] text-brand-muted">Surat edaran &amp; registrasi</div>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 group-hover:translate-x-1 group-hover:text-brand-primary transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="{{ route('public.events.index') }}" class="flex items-center justify-between p-3 rounded-xl bg-white border border-slate-200 hover:border-brand-primary/40 hover:shadow-xs transition-all group">
                        <div class="flex items-center gap-2.5">
                            <span class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <div>
                                <div class="text-xs font-bold text-brand-dark group-hover:text-brand-primary transition-colors">Agenda Kegiatan</div>
                                <div class="text-[10px] text-brand-muted">Seminar, expo &amp; kuliah tamu</div>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 group-hover:translate-x-1 group-hover:text-brand-primary transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

        </aside>

    </div>
</div>
@endsection

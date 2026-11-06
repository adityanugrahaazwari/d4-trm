@extends('layouts.public')

@section('title', 'Berita & Informasi - D-IV TRM POLITALA')
@section('meta_description', 'Kumpulan berita terkini, inovasi riset, prestasi mahasiswa, dan kerjasama industri Program Studi Sarjana Terapan Teknik Rekayasa Multimedia POLITALA.')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-28 sm:pt-32 lg:pt-36 pb-12 lg:pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Informasi</span>
            <span>/</span>
            <span class="text-brand-dark">Berita</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Berita &amp; Artikel Terkini</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Kabar kegiatan, riset multimedia terapan, kemitraan DUDI, dan prestasi sivitas akademika</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                Publikasi Resmi Program Studi
            </span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-10">
    <!-- Search & Category Filters -->
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 border-b border-slate-200 pb-6">
        <!-- Category Filter Pills -->
        <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 scrollbar-none">
            <a href="{{ route('public.news.index', array_filter(['q' => $search])) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap {{ empty($selectedCategory) ? 'bg-brand-primary text-white shadow-sm' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                Semua Kategori
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('public.news.index', array_filter(['category' => $cat->slug, 'q' => $search])) }}" 
                   class="px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap flex items-center gap-1.5 {{ $selectedCategory === $cat->slug ? 'bg-brand-primary text-white shadow-sm' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                    <span>{{ $cat->name }}</span>
                    @if($cat->news_count > 0)
                        <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ $selectedCategory === $cat->slug ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}">
                            {{ $cat->news_count }}
                        </span>
                    @endif
                </a>
            @endforeach
        </div>

        <!-- Search Input -->
        <form method="GET" action="{{ route('public.news.index') }}" class="w-full md:w-80">
            @if(!empty($selectedCategory))
                <input type="hidden" name="category" value="{{ $selectedCategory }}">
            @endif
            <div class="relative">
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari berita..." 
                       class="w-full pl-9 pr-9 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-primary/20">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                @if(!empty($search))
                    <a href="{{ route('public.news.index', array_filter(['category' => $selectedCategory])) }}" class="absolute right-3 top-2.5 text-slate-400 hover:text-slate-600">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Featured News Hero Card (Displayed on Page 1 without search filters) -->
    @if($featuredNews && empty($search) && empty($selectedCategory))
        <a href="{{ route('public.news.show', $featuredNews->slug) }}" class="group block rounded-3xl bg-white border border-slate-200/80 hover:border-brand-primary/40 hover:shadow-xl transition-all overflow-hidden shadow-xs grid grid-cols-1 lg:grid-cols-12 gap-0">
            <div class="lg:col-span-7 bg-slate-100 aspect-16/9 lg:aspect-auto flex items-center justify-center relative overflow-hidden">
                @if(!empty($featuredNews->featured_image))
                    <img src="{{ asset($featuredNews->featured_image) }}" alt="{{ $featuredNews->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full min-h-[280px] bg-gradient-to-br from-brand-primary-dark via-brand-primary to-slate-900 flex items-center justify-center p-8 relative">
                        <div class="absolute inset-0 bg-[radial-gradient(#3AA3A3_1.2px,transparent_1.2px)] [background-size:20px_20px] opacity-20"></div>
                        <img src="{{ asset('assets/undraw_working-together_r43a.svg') }}" alt="Berita Unggulan" class="h-36 w-auto object-contain drop-shadow-md group-hover:scale-105 transition-transform duration-500 relative z-10">
                    </div>
                @endif
                <span class="absolute top-4 left-4 text-[10px] uppercase font-bold tracking-wider text-white bg-brand-primary px-3 py-1 rounded-full shadow-sm z-20">
                    Berita Utama
                </span>
            </div>
            <div class="lg:col-span-5 p-8 sm:p-10 flex flex-col justify-between space-y-6">
                <div class="space-y-3">
                    <div class="flex items-center gap-2 text-xs text-brand-muted">
                        <span>{{ $featuredNews->published_at ? $featuredNews->published_at->translatedFormat('d F Y') : date('d F Y') }}</span>
                        <span>&bull;</span>
                        <span class="text-brand-secondary font-bold">{{ $featuredNews->category?->name ?? 'Informasi' }}</span>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-extrabold text-brand-dark leading-snug group-hover:text-brand-primary transition-colors">
                        {{ $featuredNews->title }}
                    </h2>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed line-clamp-3">
                        {{ $featuredNews->excerpt ?? Str::limit(strip_tags($featuredNews->content), 160) }}
                    </p>
                </div>
                <div class="flex items-center gap-2 text-xs font-bold text-brand-primary group-hover:translate-x-1 transition-transform">
                    <span>Baca Berita Selengkapnya</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </div>
            </div>
        </a>
    @endif

    <!-- News Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse ($newsList as $index => $item)
            @php
                $fallbackSvgs = [
                    'assets/undraw_working-together_r43a.svg',
                    'assets/undraw_brainstorming_gny9.svg',
                    'assets/undraw_team-assignment_lzot.svg',
                    'assets/undraw_press-play_1y41.svg'
                ];
                $svgImage = $fallbackSvgs[$index % count($fallbackSvgs)];
            @endphp
            <article class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs hover:border-brand-primary/40 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <a href="{{ route('public.news.show', $item->slug) }}" class="block aspect-16/9 bg-slate-100 flex items-center justify-center text-slate-400 relative overflow-hidden">
                        @if(!empty($item->featured_image))
                            <img src="{{ asset($item->featured_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-slate-50 to-slate-100 flex items-center justify-center p-4">
                                <img src="{{ asset($svgImage) }}" alt="{{ $item->title }}" class="h-28 w-auto object-contain p-2 group-hover:scale-105 transition-transform duration-500">
                            </div>
                        @endif
                        <span class="absolute top-3 left-3 text-[10px] uppercase font-bold tracking-wider text-brand-primary bg-white/95 px-2.5 py-0.5 rounded border border-brand-primary/20 shadow-xs">
                            {{ $item->category?->name ?? 'Informasi' }}
                        </span>
                    </a>
                    <div class="p-6 space-y-3">
                        <div class="flex items-center gap-2 text-xs text-brand-muted">
                            <span>{{ $item->published_at ? $item->published_at->translatedFormat('d M Y') : date('d M Y') }}</span>
                            <span>&bull;</span>
                            <span class="text-brand-secondary font-bold">{{ $item->author?->name ?? 'Redaksi TRM' }}</span>
                        </div>
                        <h3 class="font-bold text-base text-brand-dark leading-snug line-clamp-2 group-hover:text-brand-primary transition-colors">
                            <a href="{{ route('public.news.show', $item->slug) }}">
                                {{ $item->title }}
                            </a>
                        </h3>
                        <p class="text-xs text-brand-muted leading-relaxed line-clamp-2">
                            {{ $item->excerpt ?? Str::limit(strip_tags($item->content), 120) }}
                        </p>
                    </div>
                </div>
                <div class="p-6 pt-0 border-t border-slate-100 mt-4 flex items-center justify-between">
                    <a href="{{ route('public.news.show', $item->slug) }}" class="text-xs font-bold text-brand-primary hover:underline inline-flex items-center gap-1 group/btn">
                        <span>Baca Selengkapnya</span>
                        <svg class="w-3.5 h-3.5 transition-transform group-hover/btn:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    <span class="text-[11px] text-slate-400 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span>{{ $item->views_count }}</span>
                    </span>
                </div>
            </article>
        @empty
            <div class="col-span-3 text-center py-16 px-4 bg-white rounded-3xl border border-slate-200 space-y-4">
                <div class="w-14 h-14 mx-auto rounded-full bg-slate-100 text-slate-400 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="space-y-1">
                    <h3 class="font-bold text-base text-brand-dark">Tidak ada artikel berita ditemukan</h3>
                    <p class="text-xs text-brand-muted">
                        @if(!empty($search) || !empty($selectedCategory))
                            Coba sesuaikan kata kunci pencarian atau pilih kategori lainnya.
                        @else
                            Belum ada artikel berita yang dipublikasikan saat ini.
                        @endif
                    </p>
                </div>
                @if(!empty($search) || !empty($selectedCategory))
                    <a href="{{ route('public.news.index') }}" class="inline-flex px-4 py-2 rounded-xl text-xs font-bold bg-brand-primary text-white hover:bg-brand-primary-hover shadow-xs">
                        Reset Filter
                    </a>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(method_exists($newsList, 'links'))
        <div class="pt-6">
            {{ $newsList->links() }}
        </div>
    @endif
</div>
@endsection

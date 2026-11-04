@extends('layouts.public')

@section('title', 'Berita Program Studi - D-IV TRM POLITALA')

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
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Kabar kegiatan, riset, kerja sama industri, dan wawasan teknologi multimedia terapan</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                Data Resmi Program Studi
            </span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-12">
    <!-- Search & Category Filters -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 border-b border-slate-200 pb-6">
        <div class="flex items-center gap-2 overflow-x-auto w-full sm:w-auto">
            <button class="px-4 py-2 rounded-xl text-xs font-bold bg-brand-primary text-white shadow-sm">Semua</button>
            <button class="px-4 py-2 rounded-xl text-xs font-bold bg-white text-slate-700 hover:bg-slate-100 border border-slate-200">Akademik</button>
            <button class="px-4 py-2 rounded-xl text-xs font-bold bg-white text-slate-700 hover:bg-slate-100 border border-slate-200">Workshop &amp; Riset</button>
            <button class="px-4 py-2 rounded-xl text-xs font-bold bg-white text-slate-700 hover:bg-slate-100 border border-slate-200">Kemitraan DUDI</button>
        </div>
        <div class="relative w-full sm:w-72">
            <input type="text" placeholder="Cari berita..." class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-primary/20">
            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    <!-- Featured News Hero Card -->
    <a href="{{ route('public.news.show', 'd4-trm-politala-jalin-kerjasama-dengan-studio-game-nasional') }}" class="group block rounded-3xl bg-white border border-slate-200/80 hover:border-brand-primary/40 hover:shadow-lg transition-all overflow-hidden shadow-xs grid grid-cols-1 lg:grid-cols-12 gap-0">
        <div class="lg:col-span-7 bg-slate-100 aspect-16/9 lg:aspect-auto flex items-center justify-center text-slate-400 relative">
            <span class="text-xs font-medium">[Foto Utama Berita Unggulan]</span>
            <span class="absolute top-4 left-4 text-[10px] uppercase font-bold tracking-wider text-white bg-brand-primary px-3 py-1 rounded-full shadow-sm">
                Berita Utama
            </span>
        </div>
        <div class="lg:col-span-5 p-8 sm:p-10 flex flex-col justify-between space-y-6">
            <div class="space-y-3">
                <div class="flex items-center gap-2 text-xs text-brand-muted">
                    <span>{{ date('d F Y') }}</span>
                    <span>&bull;</span>
                    <span class="text-brand-secondary font-bold">Kemitraan DUDI</span>
                </div>
                <h2 class="text-xl sm:text-2xl font-extrabold text-brand-dark leading-snug group-hover:text-brand-primary transition-colors">
                    [Contoh Berita] D-IV TRM POLITALA Jalin Kerjasama dengan Studio Game Nasional untuk Penguatan MBKM Vokasi
                </h2>
                <p class="text-xs sm:text-sm text-brand-muted leading-relaxed line-clamp-3">
                    Program Studi D-IV Teknik Rekayasa Multimedia mengukuhkan sinergi kurikulum berbasis industri melalui kesepakatan magang bersertifikat dan praktisi mengajar langsung dari industri kreatif...
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

    <!-- News Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse ($newsList as $item)
            <article class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs hover:border-brand-primary/40 hover:shadow-md transition-all flex flex-col justify-between">
                <div>
                    <a href="{{ route('public.news.show', $item->slug ?? $item['slug']) }}" class="block aspect-16/9 bg-slate-100 flex items-center justify-center text-slate-400 relative hover:opacity-90 transition-opacity">
                        @if(!empty($item->featured_image))
                            <img src="{{ asset($item->featured_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('assets/undraw_press-play_1y41.svg') }}" alt="Berita TRM" class="h-28 w-auto object-contain p-4">
                        @endif
                    </a>
                    <div class="p-6 space-y-3">
                        <div class="flex items-center gap-2 text-xs text-brand-muted">
                            <span>{{ !empty($item->published_at) ? $item->published_at->format('d M Y') : date('d M Y') }}</span>
                            <span>&bull;</span>
                            <span class="text-brand-secondary font-bold">{{ $item->category?->name ?? 'Informasi' }}</span>
                        </div>
                        <h3 class="font-bold text-base text-brand-dark leading-snug line-clamp-2 hover:text-brand-primary transition-colors">
                            <a href="{{ route('public.news.show', $item->slug ?? $item['slug']) }}">{{ $item->title ?? $item['title'] }}</a>
                        </h3>
                        <p class="text-xs text-brand-muted leading-relaxed line-clamp-2">
                            {{ $item->excerpt ?? Str::limit(strip_tags($item->content ?? ''), 120) }}
                        </p>
                    </div>
                </div>
                <div class="p-6 pt-0 border-t border-slate-100 mt-4">
                    <a href="{{ route('public.news.show', $item->slug ?? $item['slug']) }}" class="text-xs font-bold text-brand-primary hover:underline inline-flex items-center gap-1">
                        <span>Baca Selengkapnya</span>
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </article>
        @empty
            <div class="col-span-3 text-center py-12 text-slate-500">
                Belum ada artikel berita yang dipublikasikan saat ini.
            </div>
        @endforelse
    </div>

    @if(method_exists($newsList, 'links'))
        <div class="pt-8">
            {{ $newsList->links() }}
        </div>
    @endif
</div>
@endsection

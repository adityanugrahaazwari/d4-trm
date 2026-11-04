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
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                Data Resmi Program Studi
            </span>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-6">
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs divide-y divide-slate-100 overflow-hidden">
        @forelse ($announcements as $a)
            <div class="p-6 sm:p-7 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-slate-50/80 transition-colors">
                <div class="space-y-1.5">
                    <div class="flex items-center gap-2 text-xs">
                        <span class="px-2.5 py-0.5 rounded-full font-bold text-[10px] bg-brand-primary-light text-brand-primary">
                            {{ $a->status ?? 'Pengumuman' }}
                        </span>
                        <span class="text-brand-muted">{{ !empty($a->published_at) ? $a->published_at->format('d M Y') : date('d M Y') }}</span>
                    </div>
                    <h3 class="font-bold text-base text-brand-dark hover:text-brand-primary transition-colors">
                        {{ $a->title }}
                    </h3>
                    <p class="text-xs text-brand-muted line-clamp-2">
                        {{ Str::limit(strip_tags($a->content), 160) }}
                    </p>
                </div>
                @if(!empty($a->file_attachment))
                    <a href="{{ asset($a->file_attachment) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-brand-dark hover:border-brand-primary hover:text-brand-primary hover:bg-brand-primary-light transition-all whitespace-nowrap">
                        <svg class="w-4 h-4 text-brand-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Unduh Berkas</span>
                    </a>
                @endif
            </div>
        @empty
            <div class="p-8 text-center text-slate-500 text-sm">
                Belum ada pengumuman resmi yang dipublikasikan saat ini.
            </div>
        @endforelse
    </div>
</div>
@endsection

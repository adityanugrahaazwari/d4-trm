@extends('layouts.public')

@section('title', 'Pengumuman Resmi - D-IV TRM POLITALA')
@section('meta_description', 'Pemberitahuan resmi, jadwal registrasi, surat edaran, dan informasi penting untuk sivitas akademika D-IV Teknologi Rekayasa Multimedia POLITALA.')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-24 sm:pt-28 lg:pt-32 pb-8 sm:pb-10 lg:pb-12">
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
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Surat edaran, jadwal registrasi, sidang, dan pemberitahuan penting untuk sivitas akademika</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                Pemberitahuan Resmi
            </span>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
    
    <!-- Filter & Search Bar -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 border-b border-slate-200 pb-6">
        <!-- Status / Category Tabs -->
        <div class="flex items-center gap-2 overflow-x-auto w-full sm:w-auto pb-2 sm:pb-0 scrollbar-none">
            <a href="{{ route('public.announcements.index', array_filter(['q' => $search])) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap {{ empty($selectedStatus) ? 'bg-brand-primary text-white shadow-sm' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                Semua Status
            </a>
            @foreach($statuses as $st)
                <a href="{{ route('public.announcements.index', array_filter(['status' => $st, 'q' => $search])) }}" 
                   class="px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap {{ $selectedStatus === $st ? 'bg-brand-primary text-white shadow-sm' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                    {{ $st }}
                </a>
            @endforeach
        </div>

        <!-- Search Input -->
        <form method="GET" action="{{ route('public.announcements.index') }}" class="w-full sm:w-72">
            @if(!empty($selectedStatus))
                <input type="hidden" name="status" value="{{ $selectedStatus }}">
            @endif
            <div class="relative">
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari pengumuman..." 
                       class="w-full pl-9 pr-9 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-primary/20 bg-white">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                @if(!empty($search))
                    <a href="{{ route('public.announcements.index', array_filter(['status' => $selectedStatus])) }}" class="absolute right-3 top-2.5 text-slate-400 hover:text-slate-600">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Announcement List with Expandable Detail -->
    <div class="space-y-4">
        @forelse ($announcements as $a)
            @php
                $statusColor = match(strtolower($a->status ?? '')) {
                    'akademik' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                    'kemahasiswaan' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                    'laboratorium' => 'bg-amber-50 text-amber-700 border-amber-200',
                    default => 'bg-brand-sky-light text-brand-primary border-brand-sky/30',
                };
            @endphp
            <div id="ann-{{ $a->id }}" x-data="{ expanded: false }" class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-7 shadow-xs hover:border-brand-primary/40 hover:shadow-md transition-all space-y-4">
                
                {{-- Card Header --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="flex flex-wrap items-center gap-2.5 text-xs">
                        <span class="px-2.5 py-0.5 rounded-full font-bold text-[10px] border {{ $statusColor }}">
                            {{ $a->status ?? 'Pengumuman' }}
                        </span>
                        <span class="text-brand-muted flex items-center gap-1 text-[11px]">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ !empty($a->published_at) ? $a->published_at->translatedFormat('d F Y') : date('d F Y') }}</span>
                        </span>
                    </div>

                    @if(!empty($a->file_attachment))
                        <a href="{{ asset($a->file_attachment) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 text-xs font-semibold text-brand-dark hover:border-brand-primary hover:text-brand-primary hover:bg-brand-primary-light transition-all whitespace-nowrap self-start sm:self-auto shadow-2xs">
                            <svg class="w-3.5 h-3.5 text-brand-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>Unduh Lampiran</span>
                        </a>
                    @endif
                </div>

                {{-- Title --}}
                <h3 class="font-bold text-lg sm:text-xl text-brand-dark leading-snug">
                    {{ $a->title }}
                </h3>

                {{-- Content Preview / Full Text --}}
                <div class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    <div x-show="!expanded" class="line-clamp-2">
                        {{ strip_tags($a->content) }}
                    </div>
                    <div x-show="expanded" x-transition class="space-y-3 pt-2 text-slate-700 bg-slate-50 p-5 rounded-xl border border-slate-200/80 leading-relaxed font-normal">
                        @foreach(array_filter(explode("\n", (string) $a->content), fn($p) => trim($p) !== '') as $para)
                            <p>{{ trim($para) }}</p>
                        @endforeach
                    </div>
                </div>

                {{-- Card Footer Action --}}
                <div class="pt-2 border-t border-slate-100 flex items-center justify-between">
                    <button @click="expanded = !expanded" class="text-xs font-bold text-brand-primary hover:text-brand-primary-hover inline-flex items-center gap-1.5">
                        <span x-text="expanded ? 'Tutup Rincian' : 'Lihat Selengkapnya'"></span>
                        <svg class="w-3.5 h-3.5 transform transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div class="flex items-center gap-2">
                        <button onclick="window.print()" class="text-slate-400 hover:text-slate-600 p-1" title="Cetak Pemberitahuan">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        @empty
            <div class="p-12 text-center text-slate-500 bg-white rounded-3xl border border-slate-200 space-y-4">
                <div class="w-14 h-14 mx-auto rounded-full bg-slate-100 text-slate-400 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
                <div class="space-y-1">
                    <h3 class="font-bold text-base text-brand-dark">Tidak ada pengumuman ditemukan</h3>
                    <p class="text-xs text-brand-muted">
                        @if(!empty($search) || !empty($selectedStatus))
                            Coba sesuaikan kata kunci pencarian atau pilih kategori status lainnya.
                        @else
                            Belum ada pengumuman resmi yang dipublikasikan saat ini.
                        @endif
                    </p>
                </div>
                @if(!empty($search) || !empty($selectedStatus))
                    <a href="{{ route('public.announcements.index') }}" class="inline-flex px-4 py-2 rounded-xl text-xs font-bold bg-brand-primary text-white hover:bg-brand-primary-hover shadow-xs">
                        Reset Filter
                    </a>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(method_exists($announcements, 'links'))
        <div class="pt-6">
            {{ $announcements->links() }}
        </div>
    @endif
</div>
@endsection

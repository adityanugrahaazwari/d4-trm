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
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Agenda &amp; Kegiatan</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Jadwal seminar, kuliah pakar, workshop kreatif, dan expo teknologi multimedia vokasi</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                Kalender Kegiatan Resmi
            </span>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
    
    <!-- Filter Tabs & Search Bar -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 border-b border-slate-200 pb-6">
        <!-- Tab Pills -->
        <div class="flex items-center gap-2 overflow-x-auto w-full sm:w-auto pb-2 sm:pb-0 scrollbar-none">
            <a href="{{ route('public.events.index', array_filter(['tab' => 'mendatang', 'q' => $search])) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap flex items-center gap-1.5 {{ $tab === 'mendatang' ? 'bg-brand-primary text-white shadow-sm' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                <span>Akan Datang</span>
                @if(isset($counts['upcoming']))
                    <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ $tab === 'mendatang' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}">
                        {{ $counts['upcoming'] }}
                    </span>
                @endif
            </a>
            <a href="{{ route('public.events.index', array_filter(['tab' => 'selesai', 'q' => $search])) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap flex items-center gap-1.5 {{ $tab === 'selesai' ? 'bg-brand-primary text-white shadow-sm' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                <span>Telah Selesai</span>
                @if(isset($counts['past']))
                    <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ $tab === 'selesai' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}">
                        {{ $counts['past'] }}
                    </span>
                @endif
            </a>
            <a href="{{ route('public.events.index', array_filter(['tab' => 'semua', 'q' => $search])) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap flex items-center gap-1.5 {{ $tab === 'semua' ? 'bg-brand-primary text-white shadow-sm' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                <span>Semua Agenda</span>
                @if(isset($counts['all']))
                    <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ $tab === 'semua' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}">
                        {{ $counts['all'] }}
                    </span>
                @endif
            </a>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('public.events.index') }}" class="w-full sm:w-72">
            @if(!empty($tab))
                <input type="hidden" name="tab" value="{{ $tab }}">
            @endif
            <div class="relative">
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama agenda, lokasi..." 
                       class="w-full pl-9 pr-9 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-primary/20 bg-white">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                @if(!empty($search))
                    <a href="{{ route('public.events.index', array_filter(['tab' => $tab])) }}" class="absolute right-3 top-2.5 text-slate-400 hover:text-slate-600">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Event Cards List -->
    <div class="space-y-4">
        @forelse ($events as $ev)
            @php
                $statusStr = $ev->status ?? 'Pendaftaran Dibuka';
                $statusColor = match($statusStr) {
                    'Pendaftaran Dibuka' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                    'Segera Dibuka' => 'bg-amber-50 text-amber-700 border-amber-200',
                    'Selesai' => 'bg-slate-100 text-slate-600 border-slate-200',
                    default => 'bg-brand-sky-light text-brand-primary border-brand-sky/40',
                };
            @endphp
            <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-xs flex flex-col sm:flex-row items-start sm:items-center gap-6 hover:border-brand-primary/40 hover:shadow-md transition-all group/card">
                <!-- Date Box Badge -->
                <a href="{{ route('public.events.show', $ev->slug) }}" class="w-16 h-16 rounded-2xl bg-brand-primary-light border border-brand-primary/20 text-brand-primary flex flex-col items-center justify-center font-black shrink-0 group-hover/card:scale-105 group-hover/card:bg-brand-primary group-hover/card:text-white transition-all shadow-2xs">
                    <span class="text-xl leading-none">{{ $ev->day }}</span>
                    <span class="text-[10px] uppercase font-bold tracking-wider mt-0.5">{{ $ev->month }}</span>
                </a>

                <!-- Event Details -->
                <div class="flex-1 space-y-1.5 min-w-0">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-brand-sky-light text-brand-primary border border-brand-sky/40">
                            {{ $ev->tag ?? 'Agenda TRM' }}
                        </span>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $statusColor }}">
                            {{ $statusStr }}
                        </span>
                        @if($ev->event_date)
                            <span class="text-[11px] text-brand-muted">
                                {{ $ev->date_formatted }}
                            </span>
                        @endif
                    </div>

                    <h3 class="font-bold text-base sm:text-lg text-brand-dark hover:text-brand-primary transition-colors leading-snug">
                        <a href="{{ route('public.events.show', $ev->slug) }}">
                            {{ $ev->title }}
                        </a>
                    </h3>

                    <div class="flex flex-wrap items-center gap-4 text-xs text-brand-muted">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-brand-secondary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $ev->time }}</span>
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-brand-secondary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="truncate">{{ $ev->location }}</span>
                        </span>
                    </div>

                    @if(!empty($ev->speaker))
                        <p class="text-xs text-slate-500 pt-0.5 flex items-center gap-1">
                            <span class="text-brand-muted">Narasumber:</span>
                            <span class="font-semibold text-slate-700">{{ $ev->speaker }}</span>
                        </p>
                    @endif
                </div>

                <!-- Action Button -->
                <a href="{{ route('public.events.show', $ev->slug) }}" class="px-4 py-2.5 rounded-xl bg-brand-primary text-white text-xs font-bold hover:bg-brand-primary-hover shadow-sm transition-all whitespace-nowrap self-stretch sm:self-auto text-center inline-flex items-center justify-center gap-1.5 group/btn">
                    <span>Detail Agenda</span>
                    <svg class="w-3.5 h-3.5 transition-transform group-hover/btn:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        @empty
            <div class="p-12 text-center text-slate-500 bg-white rounded-3xl border border-slate-200 space-y-4">
                <div class="w-14 h-14 mx-auto rounded-full bg-slate-100 text-slate-400 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="space-y-1">
                    <h3 class="font-bold text-base text-brand-dark">Tidak ada agenda kegiatan ditemukan</h3>
                    <p class="text-xs text-brand-muted">
                        @if(!empty($search))
                            Tidak ada kegiatan yang sesuai dengan kata kunci "{{ $search }}".
                        @else
                            Belum ada agenda kegiatan pada kategori ini.
                        @endif
                    </p>
                </div>
                @if(!empty($search) || $tab !== 'mendatang')
                    <a href="{{ route('public.events.index') }}" class="inline-flex px-4 py-2 rounded-xl text-xs font-bold bg-brand-primary text-white hover:bg-brand-primary-hover shadow-xs">
                        Lihat Agenda Mendatang
                    </a>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(method_exists($events, 'links'))
        <div class="pt-6">
            {{ $events->links() }}
        </div>
    @endif
</div>
@endsection

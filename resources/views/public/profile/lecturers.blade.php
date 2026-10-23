@extends('layouts.public')

@section('title', 'Dosen Pengajar - D-4 TRM POLITALA')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Profil</span>
            <span>/</span>
            <span class="text-brand-dark">Dosen</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Dosen Pengajar</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Profil tenaga pendidik dan instruktur profesional bidang multimedia dan rekayasa perangkat lunak</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi Dosen]
            </span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-10">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $lecturers = [
                ['name' => '[Nama Dosen 1, S.Kom., M.Kom.]', 'nip' => '198801152019031001', 'role' => 'Lektor / Koordinator Prodi', 'expertise' => 'Game Programming & Engine Development', 'email' => 'dosen1@politala.ac.id'],
                ['name' => '[Nama Dosen 2, S.T., M.T.]', 'nip' => '199003202020121002', 'role' => 'Asisten Ahli', 'expertise' => '3D Modeling, Rigging & Animation', 'email' => 'dosen2@politala.ac.id'],
                ['name' => '[Nama Dosen 3, S.Kom., M.Cs.]', 'nip' => '199207052022032003', 'role' => 'Asisten Ahli', 'expertise' => 'Computer Vision, AR/VR & Immersive Tech', 'email' => 'dosen3@politala.ac.id'],
                ['name' => '[Nama Dosen 4, S.Sn., M.Ds.]', 'nip' => '199109122021072004', 'role' => 'Tenaga Pengajar', 'expertise' => 'UI/UX Design & Digital Concept Art', 'email' => 'dosen4@politala.ac.id'],
                ['name' => '[Nama Dosen 5, S.Kom., M.T.]', 'nip' => '198711282015041005', 'role' => 'Lektor', 'expertise' => 'Software Engineering & Interactive Media', 'email' => 'dosen5@politala.ac.id'],
                ['name' => '[Nama Dosen 6, S.T., M.Kom.]', 'nip' => '199302142023011006', 'role' => 'Tenaga Pengajar', 'expertise' => 'Audio Engineering & Sound Design', 'email' => 'dosen6@politala.ac.id'],
                ['name' => '[Nama Dosen 7, S.Kom., M.Kom.]', 'nip' => '199406182024022007', 'role' => 'Tenaga Pengajar', 'expertise' => 'Web Multimedia & Cloud Media Systems', 'email' => 'dosen7@politala.ac.id'],
                ['name' => '[Nama Dosen 8, S.Sn., M.Sn.]', 'nip' => '198905222018082008', 'role' => 'Asisten Ahli', 'expertise' => 'Video Editing, Motion Graphics & VFX', 'email' => 'dosen8@politala.ac.id'],
            ];
        @endphp

        @foreach ($lecturers as $d)
            <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs hover:border-brand-primary/40 hover:shadow-md transition-all flex flex-col justify-between">
                <div>
                    <div class="aspect-square bg-slate-100 flex items-center justify-center text-slate-400 border-b border-slate-100">
                        <svg class="w-16 h-16 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="p-5 space-y-2">
                        <span class="text-[10px] font-bold text-brand-secondary uppercase tracking-wider block">
                            {{ $d['role'] }}
                        </span>
                        <h3 class="font-bold text-sm text-brand-dark leading-snug">{{ $d['name'] }}</h3>
                        <p class="text-xs text-brand-muted">NIP: {{ $d['nip'] }}</p>
                        <div class="pt-2 text-xs text-slate-700">
                            <strong class="font-semibold block text-slate-900 mb-0.5">Bidang Keahlian:</strong>
                            <span class="text-slate-600">{{ $d['expertise'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="p-5 pt-0 border-t border-slate-100 mt-2">
                    <span class="text-xs text-brand-primary hover:underline flex items-center gap-1.5 font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $d['email'] }}</span>
                    </span>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center text-xs text-slate-400 italic">
        * Nama, NIP, dan rincian dosen di atas merupakan format data dummy untuk keperluan pratinjau layout. Data asli akan diintegrasikan dari sistem kepegawaian.
    </div>
</div>
@endsection

@extends('layouts.public')

@section('title', 'Fasilitas & Laboratorium - D-IV TRM POLITALA')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-28 sm:pt-32 lg:pt-36 pb-12 lg:pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Sarana</span>
            <span>/</span>
            <span class="text-brand-dark">Fasilitas</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Fasilitas &amp; Laboratorium</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Sarana praktikum berstandar industri untuk mendukung proses belajar dan produksi karya multimedia</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi Fasilitas]
            </span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-12">
    @php
        $facilities = [
            [
                'name' => 'Laboratorium Komputasi Multimedia & Grafika 2D/3D',
                'specs' => '32 Unit Workstation Core i7/Ryzen 7, RTX 4070 Ti, 32GB RAM, Monitor IPS 4K 100% sRGB',
                'software' => 'Adobe Creative Cloud, Blender 3D, Maya, ZBrush, Substance Painter',
                'desc' => 'Ruang praktikum terpusat untuk pemodelan objek 3D, digital sculpting, texturing, dan rendering aset animasi.'
            ],
            [
                'name' => 'Laboratorium Game Tech & Immersive Virtual Reality (VR/AR)',
                'specs' => 'Workstation High-End VR Ready, Meta Quest 3 VR Headset, HTC Vive Pro, Motion Capture Sensor Suite',
                'software' => 'Unreal Engine 5, Unity Pro, SteamVR SDK, Vuforia AR SDK',
                'desc' => 'Digunakan untuk eksplorasi simulasi virtual, pembuatan level game interaktif, dan pengujian gameplay multi-platform.'
            ],
            [
                'name' => 'Studio Animasi, Video Cinema & Green Screen',
                'specs' => 'Cyclorama Green Screen Wall, Cinema 4K Cameras, Studio Softbox Lighting Set, Teleprompter',
                'software' => 'DaVinci Resolve Studio, Adobe After Effects, Premiere Pro',
                'desc' => 'Fasilitas syuting video profesional, penangkapan gerak visual effect, siaran langsung (live streaming), dan chroma keying.'
            ],
            [
                'name' => 'Studio Audio Recording & Sound Design',
                'specs' => 'Acoustic Soundproof Room, Studio Condenser Mics, Audio Interface Focusrite, MIDI Controller Keyboard',
                'software' => 'Avid Pro Tools, FL Studio, Ableton Live, Adobe Audition',
                'desc' => 'Produksi voice over (dubbing), efek suara game (SFX), mixing foley, dan aransemen musik pengiring film animasi.'
            ],
            [
                'name' => 'Co-Working Space & Studio Proyek Industri (PBL Hub)',
                'specs' => 'Meja Kolaborasi Fleksibel, Smart TV Interactive 75-inch, Wi-Fi 6 Berkecepatan Tinggi, Papan Scrum Fisik',
                'software' => 'Figma Enterprise, Miro, Notion, GitHub Enterprise Workspace',
                'desc' => 'Ruang inkubasi tim mahasiswa untuk mengerjakan proyek ril kemitraan DUDI dengan metode kerja Agile/Scrum.'
            ],
            [
                'name' => 'Ruang Render Farm & Mini Server Multimedia',
                'specs' => 'Dedicated Rack Server Multi-GPU untuk Render Farm Terdistribusi dan Penyimpanan Cloud Lokal',
                'software' => 'Deadline Render Manager, Linux Proxmox VE, TrueNAS Core',
                'desc' => 'Menyediakan komputasi rendering animasi dan video skala besar tanpa membebani workstation mahasiswa saat produksi.'
            ]
        ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($facilities as $fac)
            <div class="bg-white rounded-3xl border border-slate-200/80 overflow-hidden shadow-xs hover:border-brand-primary/40 hover:shadow-md transition-all flex flex-col justify-between">
                <div>
                    <div class="aspect-16/10 bg-slate-100 flex items-center justify-center text-slate-400 border-b border-slate-100 relative">
                        <span class="text-xs font-medium">[Foto {{ $fac['name'] }}]</span>
                    </div>
                    <div class="p-6 space-y-4">
                        <h3 class="font-bold text-base text-brand-dark leading-snug">{{ $fac['name'] }}</h3>
                        <p class="text-xs text-brand-muted leading-relaxed">{{ $fac['desc'] }}</p>
                        
                        <div class="space-y-2 border-t border-slate-100 pt-3 text-xs">
                            <div>
                                <span class="font-bold text-slate-900 block mb-0.5">Spesifikasi Utama:</span>
                                <span class="text-slate-600">{{ $fac['specs'] }}</span>
                            </div>
                            <div>
                                <span class="font-bold text-slate-900 block mb-0.5">Software Utama:</span>
                                <span class="text-brand-secondary font-medium">{{ $fac['software'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-primary">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>Fasilitas Aktif Beroperasi</span>
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

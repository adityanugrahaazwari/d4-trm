@extends('layouts.public')

@section('title', 'Kurikulum & Mata Kuliah - D-IV TRM POLITALA')
@section('meta_description', 'Struktur kurikulum dan daftar sebaran mata kuliah Program Studi Sarjana Terapan (D-IV) Teknik Rekayasa Multimedia Politeknik Negeri Tanah Laut.')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-28 sm:pt-32 lg:pt-36 pb-12 lg:pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Akademik</span>
            <span>/</span>
            <span class="text-brand-dark">Kurikulum &amp; Mata Kuliah</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">
                    Kurikulum &amp; Mata Kuliah
                </h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted max-w-3xl leading-relaxed">
                    Struktur kurikulum Sarjana Terapan D-IV TRM berbasis Outcome-Based Education (OBE), Project-Based Learning (PBL), serta sebaran mata kuliah teori dan praktikum per semester (1–8).
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-3.5 py-1.5 rounded-full text-xs font-bold bg-brand-primary-light text-brand-primary border border-brand-primary/20">
                    Kurikulum Terapan 2026
                </span>
                <span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    144 SKS Penuh
                </span>
            </div>
        </div>

        <!-- Quick Jump Links -->
        <div class="mt-8 flex flex-wrap items-center gap-2 pt-4 border-t border-slate-200/60 text-xs font-medium">
            <span class="text-slate-400 font-semibold mr-1">Lompat ke:</span>
            <a href="#ringkasan-sks" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-slate-700 hover:text-brand-primary hover:border-brand-primary/40 transition-colors shadow-2xs">
                Ringkasan Bobot SKS
            </a>
            <a href="#fase-perkuliahan" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-slate-700 hover:text-brand-primary hover:border-brand-primary/40 transition-colors shadow-2xs">
                Fase Perkuliahan 4 Tahun
            </a>
            <a href="#mata-kuliah" class="px-3 py-1 rounded-lg bg-brand-primary text-white font-semibold hover:bg-brand-primary-hover transition-colors shadow-xs">
                Daftar Mata Kuliah (Semester 1–8) ↓
            </a>
            <a href="#unduh-dokumen" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-slate-700 hover:text-brand-primary hover:border-brand-primary/40 transition-colors shadow-2xs">
                Buku Pedoman Kurikulum (PDF)
            </a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-16">

    <!-- 1. Ringkasan Bobot SKS -->
    <section id="ringkasan-sks" class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-2 border-b border-slate-200/80 pb-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-brand-secondary">Struktur Komposisi</span>
                <h2 class="text-2xl font-bold text-brand-dark">Ringkasan Beban Studi</h2>
            </div>
            <p class="text-xs text-brand-muted">Jenjang D-IV / Sarjana Terapan (Gelar: S.Tr.Kom.)</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md hover:border-brand-primary/40 transition-all space-y-2">
                <span class="text-xs uppercase font-bold text-brand-muted">Total Beban Studi</span>
                <div class="text-3xl sm:text-4xl font-black text-brand-primary">144 SKS</div>
                <p class="text-xs text-slate-500 leading-relaxed">Masa studi normal 8 Semester (4 Tahun) dengan kurikulum selaras SKKNI &amp; DUDI.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md hover:border-brand-secondary/40 transition-all space-y-2">
                <span class="text-xs uppercase font-bold text-brand-muted">Praktik &amp; PBL</span>
                <div class="text-3xl sm:text-4xl font-black text-brand-secondary">62%</div>
                <p class="text-xs text-slate-500 leading-relaxed">Laboratorium workstation, studio animasi, game engine &amp; proyek riil industri.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md hover:border-brand-dark/40 transition-all space-y-2">
                <span class="text-xs uppercase font-bold text-brand-muted">Teori &amp; Konsep</span>
                <div class="text-3xl sm:text-4xl font-black text-brand-dark">38%</div>
                <p class="text-xs text-slate-500 leading-relaxed">Fondasi logika algoritma, matematika komputasi, seni visual &amp; etika profesi.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md hover:border-emerald-500/40 transition-all space-y-2">
                <span class="text-xs uppercase font-bold text-emerald-700">Magang Industri</span>
                <div class="text-3xl sm:text-4xl font-black text-emerald-600">1 Tahun</div>
                <p class="text-xs text-slate-500 leading-relaxed">Program MBKM Vokasi 2 semester: magang DUDI bersertifikat &amp; proyek tugas akhir.</p>
            </div>
        </div>
    </section>

    <!-- 2. Alur Tahapan Perkuliahan 4 Tahun -->
    <section id="fase-perkuliahan" class="space-y-6">
        <div class="border-b border-slate-200/80 pb-4">
            <span class="text-xs font-bold uppercase tracking-wider text-brand-secondary">Peta Jalan Akademik</span>
            <h2 class="text-2xl font-bold text-brand-dark">Fase Perkuliahan 4 Tahun</h2>
            <p class="text-xs sm:text-sm text-brand-muted mt-1">Tahapan progresif pembelajaran dari dasar komputasi multimedia hingga kesiapan kerja industri profesional.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Tahun 1 -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md hover:border-brand-primary/40 transition-all flex flex-col justify-between space-y-4">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-primary-light text-brand-primary flex items-center justify-center font-black text-base shrink-0 shadow-2xs">
                        T1
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-brand-secondary uppercase">Tahun 1 (Semester 1–2)</span>
                            <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 text-[10px] font-bold">40 SKS</span>
                        </div>
                        <h3 class="font-bold text-base text-brand-dark mt-1">Fundamental Computing &amp; Multimedia Foundation</h3>
                        <p class="text-xs text-brand-muted mt-2 leading-relaxed">
                            Penguasaan fondasi: algoritma pemrograman, matematika komputasi, tipografi digital, dasar pemodelan 3D, audio engineering dasar, dan etika profesi vokasi.
                        </p>
                    </div>
                </div>
                <div class="pt-3 border-t border-slate-100 flex flex-wrap gap-1.5 text-[11px] font-mono text-slate-600">
                    <span class="px-2 py-0.5 rounded bg-slate-50 border border-slate-200">Algoritma C#/C++</span>
                    <span class="px-2 py-0.5 rounded bg-slate-50 border border-slate-200">Blender Basics</span>
                    <span class="px-2 py-0.5 rounded bg-slate-50 border border-slate-200">UI/UX Foundations</span>
                </div>
            </div>

            <!-- Tahun 2 -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md hover:border-brand-sky/60 transition-all flex flex-col justify-between space-y-4">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center font-black text-base shrink-0 shadow-2xs">
                        T2
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-sky-700 uppercase">Tahun 2 (Semester 3–4)</span>
                            <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 text-[10px] font-bold">38 SKS</span>
                        </div>
                        <h3 class="font-bold text-base text-brand-dark mt-1">Core Interactive Media &amp; 3D Animation Pipeline</h3>
                        <p class="text-xs text-brand-muted mt-2 leading-relaxed">
                            Pemodelan 3D tingkat lanjut, rigging &amp; animasi karakter, pengenalan game engine (Unity &amp; Unreal), video effects (VFX), dan Proyek Terintegrasi Multimedia I (PBL).
                        </p>
                    </div>
                </div>
                <div class="pt-3 border-t border-slate-100 flex flex-wrap gap-1.5 text-[11px] font-mono text-slate-600">
                    <span class="px-2 py-0.5 rounded bg-slate-50 border border-slate-200">Game Engine Unity</span>
                    <span class="px-2 py-0.5 rounded bg-slate-50 border border-slate-200">Unreal Engine 5</span>
                    <span class="px-2 py-0.5 rounded bg-slate-50 border border-slate-200">Rigging &amp; MoCap</span>
                </div>
            </div>

            <!-- Tahun 3 -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md hover:border-emerald-500/40 transition-all flex flex-col justify-between space-y-4">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-black text-base shrink-0 shadow-2xs">
                        T3
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-emerald-700 uppercase">Tahun 3 (Semester 5–6)</span>
                            <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 text-[10px] font-bold">37 SKS</span>
                        </div>
                        <h3 class="font-bold text-base text-brand-dark mt-1">Advanced Game Dev, XR (VR/AR) &amp; Riset Terapan</h3>
                        <p class="text-xs text-brand-muted mt-2 leading-relaxed">
                            Teknologi imersif virtual reality / augmented reality, Game AI, mobile interactive apps, audio spasial, metodologi riset, dan mata kuliah pilihan spesialisasi.
                        </p>
                    </div>
                </div>
                <div class="pt-3 border-t border-slate-100 flex flex-wrap gap-1.5 text-[11px] font-mono text-slate-600">
                    <span class="px-2 py-0.5 rounded bg-slate-50 border border-slate-200">Meta Quest XR</span>
                    <span class="px-2 py-0.5 rounded bg-slate-50 border border-slate-200">Game AI Logic</span>
                    <span class="px-2 py-0.5 rounded bg-slate-50 border border-slate-200">PBL Industri II</span>
                </div>
            </div>

            <!-- Tahun 4 -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md hover:border-amber-500/40 transition-all flex flex-col justify-between space-y-4">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-black text-base shrink-0 shadow-2xs">
                        T4
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-amber-700 uppercase">Tahun 4 (Semester 7–8)</span>
                            <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 text-[10px] font-bold">29 SKS</span>
                        </div>
                        <h3 class="font-bold text-base text-brand-dark mt-1">Magang Industri MBKM &amp; Tugas Akhir Terapan</h3>
                        <p class="text-xs text-brand-muted mt-2 leading-relaxed">
                            Praktik kerja industri 1 semester penuh di studio game/animasi/agency DUDI, pameran produk capstone karya Tugas Akhir, serta sertifikasi kompetensi profesi.
                        </p>
                    </div>
                </div>
                <div class="pt-3 border-t border-slate-100 flex flex-wrap gap-1.5 text-[11px] font-mono text-slate-600">
                    <span class="px-2 py-0.5 rounded bg-slate-50 border border-slate-200">Magang DUDI 1 Sem</span>
                    <span class="px-2 py-0.5 rounded bg-slate-50 border border-slate-200">Tugas Akhir Capstone</span>
                    <span class="px-2 py-0.5 rounded bg-slate-50 border border-slate-200">Uji Kompetensi BNSP</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Sebaran Mata Kuliah Per Semester (Interactive Full Data) -->
    <section id="mata-kuliah" class="space-y-6 pt-4" x-data="{
        activeSemester: 1,
        searchQuery: '',
        courses: {
            1: [
                { code: 'TRM101', name: 'Algoritma & Pemrograman Multimedia', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM102', name: 'Dasar Desain Grafis & Tipografi Digital', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM103', name: 'Matematika Komputasi & Vektor', theory: 2, practice: 1, total: 3, type: 'Wajib' },
                { code: 'TRM104', name: 'Pengantar Teknologi Media Interaktif & Game', theory: 2, practice: 1, total: 3, type: 'Wajib' },
                { code: 'TRM105', name: 'Fotografi Digital & Sinematografi Dasar', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'WKW101', name: 'Pendidikan Pancasila & Kewarganegaraan', theory: 2, practice: 0, total: 2, type: 'Institusi' },
                { code: 'WKW102', name: 'Bahasa Indonesia Akademik & Teknis', theory: 2, practice: 0, total: 2, type: 'Institusi' },
                { code: 'WKW103', name: 'Bahasa Inggris Komunikasi Teknik', theory: 1, practice: 0, total: 1, type: 'Institusi' }
            ],
            2: [
                { code: 'TRM201', name: 'Pemrograman Berorientasi Objek Multimedia (C#/C++)', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM202', name: 'Desain Antarmuka & Pengalaman Pengguna (UI/UX)', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM203', name: 'Dasar Pemodelan 3D & Digital Asset (Blender)', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM204', name: 'Audio Engineering & Sound Design', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM205', name: 'Sistem Manajemen Basis Data Multimedia', theory: 2, practice: 1, total: 3, type: 'Wajib' },
                { code: 'TRM206', name: 'Animasi 2D Digital & Motion Graphics', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'WKW201', name: 'Pendidikan Agama', theory: 2, practice: 0, total: 2, type: 'Institusi' }
            ],
            3: [
                { code: 'TRM301', name: 'Pemodelan Karakter 3D & Digital Sculpting', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM302', name: 'Pemrograman Game 2D & Game Engine I (Unity)', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM303', name: 'Pengembangan Web Multimedia & Frontend Interaktif', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM304', name: 'Rigging & Animasi Karakter 3D', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM305', name: 'Visual Effects (VFX) & Compositing', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM306', name: 'Statistika & Probabilitas Komputasi', theory: 2, practice: 0, total: 2, type: 'Wajib' },
                { code: 'WKW301', name: 'Etika Profesi & Hukum Siber Multimedia', theory: 2, practice: 0, total: 2, type: 'Institusi' }
            ],
            4: [
                { code: 'TRM401', name: 'Pemrograman Game 3D & Game Engine II (Unreal Engine)', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM402', name: 'Virtual Reality (VR) & Augmented Reality (AR) Fundamental', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM403', name: 'Environment Art & Lighting 3D', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM404', name: 'Produksi Video Digital & Color Grading', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM405', name: 'Rekayasa Perangkat Lunak Multimedia', theory: 2, practice: 1, total: 3, type: 'Wajib' },
                { code: 'TRM406', name: 'Proyek Terintegrasi Multimedia I (PBL Studio)', theory: 1, practice: 3, total: 4, type: 'Wajib' }
            ],
            5: [
                { code: 'TRM501', name: 'Pengembangan Aplikasi Imersif Lanjut (Mixed Reality & XR)', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM502', name: 'Kecerdasan Buatan dalam Game (Game AI)', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM503', name: 'Mobile Interactive App Development', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM504', name: 'Computer Vision & Interaksi Manusia Komputer', theory: 2, practice: 1, total: 3, type: 'Wajib' },
                { code: 'TRM505', name: 'Manajemen Proyek Multimedia & Agile/Scrum', theory: 2, practice: 1, total: 3, type: 'Wajib' },
                { code: 'TRM506', name: 'Proyek Terintegrasi Multimedia II (PBL Industri)', theory: 1, practice: 3, total: 4, type: 'Wajib' }
            ],
            6: [
                { code: 'TRM601', name: 'Game Engine Architecture & Optimasi Kinerja', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM602', name: 'Desain Audio Spasial & Komposisi Interaktif', theory: 1, practice: 2, total: 3, type: 'Wajib' },
                { code: 'TRM603', name: 'Kewirausahaan Digital & Manajemen Bisnis Kreatif', theory: 2, practice: 1, total: 3, type: 'Wajib' },
                { code: 'TRM604', name: 'Metodologi Riset Terapan Multimedia', theory: 2, practice: 1, total: 3, type: 'Wajib' },
                { code: 'TRM605', name: 'MK Pilihan I: Virtual Production & MoCap Pipeline', theory: 1, practice: 2, total: 3, type: 'Pilihan' },
                { code: 'TRM606', name: 'MK Pilihan II: Technical Art & Shader Programming', theory: 1, practice: 2, total: 3, type: 'Pilihan' }
            ],
            7: [
                { code: 'TRM701', name: 'Magang Industri Bersertifikat (MBKM Vokasi DUDI)', theory: 0, practice: 16, total: 16, type: 'Wajib' },
                { code: 'TRM702', name: 'Portofolio Industri & Presentasi Proyek Mitra', theory: 0, practice: 4, total: 4, type: 'Wajib' }
            ],
            8: [
                { code: 'TRM801', name: 'Seminar Proposal Tugas Akhir', theory: 0, practice: 2, total: 2, type: 'Wajib' },
                { code: 'TRM802', name: 'Tugas Akhir / Skripsi Terapan (Capstone Multimedia Product)', theory: 0, practice: 6, total: 6, type: 'Wajib' },
                { code: 'TRM803', name: 'Uji Sertifikasi Kompetensi Profesi Multimedia', theory: 0, practice: 1, total: 1, type: 'Wajib' }
            ]
        },
        semesterFocus: {
            1: 'Fondasi Logika Komputasi, Desain Visual 2D & Sinematografi Dasar',
            2: 'Pemrograman Berorientasi Objek, Basis Data & Aset 3D Dasar',
            3: 'Pengembangan Game 2D Unity, Animasi Karakter 3D & Frontend Web',
            4: 'Unreal Engine 5, Virtual Reality (VR) & Proyek Terintegrasi Studio',
            5: 'Teknologi Imersif XR, Game AI & Proyek Terintegrasi Industri',
            6: 'Optimasi Arsitektur Engine, Audio Spasial & Peminatan Lanjut',
            7: 'Praktek Kerja Nyata di Industri / DUDI Selama 1 Semester Penuh (MBKM)',
            8: 'Penyelesaian Karya Tugas Akhir Capstone & Uji Sertifikasi Profesi'
        },
        get currentCourses() {
            let list = this.courses[this.activeSemester] || [];
            if (!this.searchQuery.trim()) return list;
            const q = this.searchQuery.toLowerCase();
            return list.filter(item => 
                item.name.toLowerCase().includes(q) || 
                item.code.toLowerCase().includes(q) ||
                item.type.toLowerCase().includes(q)
            );
        },
        get totalSemesterSks() {
            const list = this.courses[this.activeSemester] || [];
            return list.reduce((sum, item) => sum + item.total, 0);
        },
        get totalTheorySks() {
            const list = this.courses[this.activeSemester] || [];
            return list.reduce((sum, item) => sum + item.theory, 0);
        },
        get totalPracticeSks() {
            const list = this.courses[this.activeSemester] || [];
            return list.reduce((sum, item) => sum + item.practice, 0);
        }
    }">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-slate-200/80 pb-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-brand-secondary">Daftar Mata Kuliah</span>
                <h2 class="text-2xl font-bold text-brand-dark">Sebaran Mata Kuliah Per Semester</h2>
                <p class="text-xs sm:text-sm text-brand-muted mt-1">Pilih semester untuk melihat rincian mata kuliah, bobot SKS teori/praktik, dan sifat mata kuliah.</p>
            </div>
            
            <!-- Live Search in Table -->
            <div class="relative w-full sm:w-72">
                <input type="text" 
                       x-model="searchQuery" 
                       placeholder="Cari nama atau kode MK..." 
                       class="w-full pl-9 pr-4 py-2 rounded-xl text-xs bg-white border border-slate-200 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary/20 focus:outline-hidden transition-all shadow-2xs">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <!-- Semester Tabs Bar with Horizontal Scroll (Scroll-X) -->
        <div class="relative" 
             x-data="{
                canScrollLeft: false,
                canScrollRight: true,
                checkScroll() {
                    const el = this.$refs.semesterScroll;
                    if (!el) return;
                    this.canScrollLeft = el.scrollLeft > 15;
                    this.canScrollRight = el.scrollLeft < (el.scrollWidth - el.clientWidth - 15);
                },
                scrollPrev() {
                    this.$refs.semesterScroll.scrollBy({ left: -260, behavior: 'smooth' });
                },
                scrollNext() {
                    this.$refs.semesterScroll.scrollBy({ left: 260, behavior: 'smooth' });
                }
             }" 
             x-init="setTimeout(() => checkScroll(), 150)" 
             @resize.window.debounce.100ms="checkScroll()">

            <!-- Left Scroll Arrow Button -->
            <button type="button" 
                    x-show="canScrollLeft" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-75"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-75"
                    @click="scrollPrev()" 
                    aria-label="Scroll pilihan semester ke kiri"
                    class="absolute -left-3 top-1/2 -translate-y-1/2 z-20 w-8 h-8 rounded-full bg-white text-brand-dark hover:text-brand-primary shadow-md border border-slate-200 flex items-center justify-center transition-all hover:scale-110 active:scale-95" 
                    style="display: none;">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Right Scroll Arrow Button -->
            <button type="button" 
                    x-show="canScrollRight" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-75"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-75"
                    @click="scrollNext()" 
                    aria-label="Scroll pilihan semester ke kanan"
                    class="absolute -right-3 top-1/2 -translate-y-1/2 z-20 w-8 h-8 rounded-full bg-white text-brand-dark hover:text-brand-primary shadow-md border border-slate-200 flex items-center justify-center transition-all hover:scale-110 active:scale-95">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Scrollable Tab Buttons Track -->
            <div x-ref="semesterScroll"
                 @scroll.passive="checkScroll()"
                 class="flex items-center gap-2.5 overflow-x-auto pb-3 pt-1 border-b border-slate-200/80 scroll-smooth snap-x custom-scroll-x">
                @for ($sem = 1; $sem <= 8; $sem++)
                    <button type="button" 
                            @click="activeSemester = {{ $sem }}; $el.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });" 
                            :class="activeSemester === {{ $sem }} 
                                ? 'bg-brand-primary text-white shadow-sm ring-2 ring-brand-primary/30 font-bold' 
                                : 'bg-white text-slate-700 hover:bg-slate-100 hover:text-brand-primary border border-slate-200/80 font-medium'"
                            class="shrink-0 snap-start px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center gap-2 shadow-2xs">
                        <span>Semester {{ $sem }}</span>
                        <span :class="activeSemester === {{ $sem }} ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600'" 
                              class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold">
                            @switch($sem)
                                @case(1) 20 @break
                                @case(2) 20 @break
                                @case(3) 19 @break
                                @case(4) 19 @break
                                @case(5) 19 @break
                                @case(6) 18 @break
                                @case(7) 20 @break
                                @case(8) 9 @break
                            @endswitch SKS
                        </span>
                    </button>
                @endfor
            </div>
        </div>

        <!-- Semester Info Banner -->
        <div class="bg-gradient-to-r from-brand-primary-light via-white to-brand-surface p-4 sm:p-5 rounded-2xl border border-brand-primary/20 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 rounded-full bg-brand-primary text-white text-[11px] font-bold" x-text="'Semester ' + activeSemester"></span>
                    <span class="text-xs font-bold text-brand-dark">Fokus Pembelajaran:</span>
                </div>
                <p class="text-xs text-brand-muted leading-relaxed" x-text="semesterFocus[activeSemester]"></p>
            </div>
            
            <div class="flex items-center gap-3 shrink-0 text-xs">
                <div class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-center shadow-2xs">
                    <span class="block text-[10px] uppercase font-bold text-slate-400">Teori</span>
                    <span class="font-extrabold text-brand-dark" x-text="totalTheorySks + ' SKS'"></span>
                </div>
                <div class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-center shadow-2xs">
                    <span class="block text-[10px] uppercase font-bold text-slate-400">Praktik</span>
                    <span class="font-extrabold text-brand-secondary" x-text="totalPracticeSks + ' SKS'"></span>
                </div>
                <div class="px-3 py-1.5 rounded-xl bg-brand-primary text-white text-center shadow-xs">
                    <span class="block text-[10px] uppercase font-bold text-brand-sky">Total SKS</span>
                    <span class="font-black text-brand-cream" x-text="totalSemesterSks + ' SKS'"></span>
                </div>
            </div>
        </div>

        <!-- Course Table -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
            <div class="overflow-x-auto custom-scroll-x">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 border-b border-slate-200/80 text-slate-600 uppercase tracking-wider font-bold">
                        <tr>
                            <th class="py-3.5 px-6 w-32">Kode MK</th>
                            <th class="py-3.5 px-4">Nama Mata Kuliah</th>
                            <th class="py-3.5 px-4 text-center w-28">Teori (SKS)</th>
                            <th class="py-3.5 px-4 text-center w-28">Praktik (SKS)</th>
                            <th class="py-3.5 px-4 text-center w-28">Total SKS</th>
                            <th class="py-3.5 px-6 text-center w-28">Sifat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        <template x-for="c in currentCourses" :key="c.code">
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3.5 px-6 font-mono font-bold text-brand-primary" x-text="c.code"></td>
                                <td class="py-3.5 px-4">
                                    <span class="font-bold text-brand-dark block text-xs sm:text-sm" x-text="c.name"></span>
                                </td>
                                <td class="py-3.5 px-4 text-center text-slate-600" x-text="c.theory"></td>
                                <td class="py-3.5 px-4 text-center font-semibold text-brand-secondary" x-text="c.practice"></td>
                                <td class="py-3.5 px-4 text-center font-black text-brand-dark" x-text="c.total"></td>
                                <td class="py-3.5 px-6 text-center">
                                    <span :class="{
                                        'bg-blue-50 text-blue-700 border-blue-200': c.type === 'Wajib',
                                        'bg-slate-100 text-slate-700 border-slate-200': c.type === 'Institusi',
                                        'bg-emerald-50 text-emerald-700 border-emerald-200': c.type === 'Pilihan'
                                    }" class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border inline-block" x-text="c.type"></span>
                                </td>
                            </tr>
                        </template>

                        <!-- Empty state if search finds nothing -->
                        <tr x-show="currentCourses.length === 0" style="display: none;">
                            <td colspan="6" class="py-8 text-center text-slate-400">
                                Tidak ada mata kuliah yang cocok dengan kata pencarian "<span x-text="searchQuery"></span>" di Semester <span x-text="activeSemester"></span>.
                            </td>
                        </tr>
                    </tbody>
                    <tfoot class="bg-slate-50/90 border-t border-slate-200/80 font-bold text-xs text-slate-700">
                        <tr>
                            <td colspan="2" class="py-3.5 px-6 uppercase tracking-wider text-right">
                                Total Beban Semester <span x-text="activeSemester"></span>:
                            </td>
                            <td class="py-3.5 px-4 text-center text-slate-600" x-text="totalTheorySks + ' SKS'"></td>
                            <td class="py-3.5 px-4 text-center text-brand-secondary" x-text="totalPracticeSks + ' SKS'"></td>
                            <td class="py-3.5 px-4 text-center font-black text-brand-primary" x-text="totalSemesterSks + ' SKS'"></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>

    <!-- 4. MBKM & Magang Industri Highlight Card -->
    <section class="bg-gradient-to-r from-slate-900 via-brand-dark to-brand-primary text-white p-8 sm:p-10 rounded-3xl relative overflow-hidden shadow-xl">
        <div class="absolute -right-10 -bottom-10 w-80 h-80 rounded-full bg-brand-sky/15 blur-3xl pointer-events-none"></div>
        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-8 space-y-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-brand-sky text-xs font-bold uppercase tracking-wider border border-white/20">
                    Program Merdeka Belajar (MBKM Vokasi)
                </span>
                <h3 class="text-2xl sm:text-3xl font-extrabold tracking-tight leading-tight">
                    Magang Bersertifikat Industri 1 Tahun Penuh
                </h3>
                <p class="text-sm text-slate-200/90 leading-relaxed max-w-2xl">
                    Kurikulum D-IV TRM POLITALA memfasilitasi mahasiswa terjun langsung ke Dunia Usaha &amp; Dunia Industri (DUDI) pada Semester 7 dan 8. Mahasiswa menghasilkan portofolio riil, memperluas jejaring profesional, serta mempercepat serapan kerja pasca kelulusan.
                </p>
                <div class="flex flex-wrap items-center gap-4 pt-2 text-xs text-brand-cream font-medium">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        Studio Animasi &amp; Game Nasional
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        Software House &amp; Creative Agency
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        Konversi SKS Penuh (20 SKS)
                    </span>
                </div>
            </div>

            <div class="lg:col-span-4 flex flex-col items-center sm:items-end justify-center">
                <a href="{{ route('public.academic.graduate-profile') }}" class="px-6 py-3.5 rounded-xl bg-white text-brand-primary font-bold text-xs hover:bg-brand-cream transition-all shadow-md hover:scale-105 active:scale-95 text-center whitespace-nowrap">
                    Lihat Profil Lulusan &amp; Peluang Karir →
                </a>
            </div>
        </div>
    </section>

    <!-- 5. CTA Unduh Dokumen Kurikulum -->
    <section id="unduh-dokumen" class="bg-brand-surface rounded-3xl border border-slate-200/80 p-8 sm:p-10 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-xs">
        <div class="space-y-2 text-center sm:text-left">
            <span class="px-2.5 py-1 rounded-md bg-amber-50 text-amber-800 text-[10px] font-bold uppercase tracking-wider border border-amber-200">
                Dokumen Resmi
            </span>
            <h3 class="font-extrabold text-lg sm:text-xl text-brand-dark">Buku Pedoman Kurikulum &amp; Silabus Lengkap</h3>
            <p class="text-xs sm:text-sm text-brand-muted max-w-xl leading-relaxed">
                Unduh dokumen silabus komprehensif, capaian pembelajaran lulusan (CPL), dan matriks mata kuliah D-IV TRM tahun akademik 2026/2027 dalam format PDF.
            </p>
        </div>
        <button type="button" 
                onclick="alert('Dokumen Buku Kurikulum D-IV TRM versi resmi PDF akan segera dapat diunduh.')"
                class="px-6 py-3.5 rounded-xl bg-brand-primary text-white text-xs font-bold hover:bg-brand-primary-hover shadow-sm hover:shadow-md hover:scale-105 active:scale-95 transition-all whitespace-nowrap flex items-center gap-2">
            <svg class="w-4 h-4 text-brand-cream" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            <span>Unduh Draf Kurikulum (PDF)</span>
        </button>
    </section>

</div>
@endsection

@push('styles')
<style>
/* Custom styled horizontal scrollbar for scroll-x elements */
.custom-scroll-x {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e1 #f8fafc;
    -webkit-overflow-scrolling: touch;
}

.custom-scroll-x::-webkit-scrollbar {
    height: 6px;
}

.custom-scroll-x::-webkit-scrollbar-track {
    background: #f8fafc;
    border-radius: 9999px;
}

.custom-scroll-x::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 9999px;
    transition: background-color 0.2s ease;
}

.custom-scroll-x::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>
@endpush

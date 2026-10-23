@extends('layouts.admin')

@php
    $sec = $section ?? 'data';
    $titleMap = [
        'sejarah' => 'Sejarah Program Studi',
        'visi-misi' => 'Visi & Misi Program Studi',
        'sambutan' => 'Sambutan Ketua Program Studi',
        'struktur' => 'Struktur Organisasi',
        'dosen' => 'Data Dosen Pengajar',
        'tendik' => 'Data Tenaga Kependidikan',
        'kurikulum' => 'Manajemen Kurikulum',
        'mata-kuliah' => 'Daftar Mata Kuliah',
        'kalender' => 'Kalender Akademik',
        'cpl' => 'Capaian Pembelajaran Lulusan (CPL)',
        'profil-lulusan' => 'Profil Lulusan',
        'berita' => 'Berita Program Studi',
        'kategori-berita' => 'Kategori Berita',
        'pengumuman' => 'Pengumuman Akademik',
        'agenda' => 'Agenda Kegiatan',
        'fasilitas' => 'Data Fasilitas & Laboratorium',
        'album-galeri' => 'Album Galeri',
        'foto-galeri' => 'Foto & Dokumentasi',
        'identitas' => 'Identitas Website',
        'homepage' => 'Pengaturan Homepage & Hero',
        'kontak-sosmed' => 'Kontak & Media Sosial',
        'logo-favicon' => 'Logo & Favicon Website',
        'media-list' => 'Daftar Berkas Media',
        'media-upload' => 'Unggah Berkas Media',
        'users' => 'Manajemen Pengguna',
        'roles' => 'Manajemen Peran (Roles)',
        'permissions' => 'Hak Akses Sistem (Permissions)',
        'my-profile' => 'Profil Akun Pengelola',
    ];

    $title = $titleMap[$sec] ?? ucfirst(str_replace('-', ' ', $sec));
    $isFormOnly = in_array($sec, ['sejarah', 'visi-misi', 'sambutan', 'struktur', 'identitas', 'homepage', 'kontak-sosmed', 'logo-favicon', 'my-profile', 'media-upload']);
    $isMediaGrid = ($sec === 'media-list');
@endphp

@section('title', $title)
@section('page_title', $title)
@section('page_subtitle', 'Kerangka modul antarmuka panel administrasi D-4 TRM POLITALA')

@section('content')
<div x-data="{ 
    modalOpen: false, 
    deleteModalOpen: false, 
    selectedItem: null,
    savedSuccess: false,
    modalTitle: 'Tambah Data',
    formData: { id: null, title: '', category: 'Umum', status: 'published' }
}" class="space-y-6">

    <!-- Flash Helper Banner -->
    <div class="rounded-2xl bg-brand-sky-light border border-brand-sky/60 p-4 text-brand-dark text-xs flex flex-wrap items-center justify-between gap-2 shadow-xs">
        <div class="flex items-center gap-2.5">
            <svg class="w-4 h-4 text-brand-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span><strong>Kerangka UI Modul: {{ $title }}</strong> (Simulasi Antarmuka Tahap 5). Pada tahap backend (Tahap 7–12), modul ini dihubungkan langsung ke Controller dan database.</span>
        </div>
        <span class="text-[10px] uppercase font-bold text-brand-primary bg-white px-2 py-0.5 rounded shadow-xs">Data Simulasi</span>
    </div>

    <!-- Alert Sukses Simpan Dummy -->
    <div x-show="savedSuccess" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center justify-between" style="display: none;">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>[Simulasi Sukses] Perubahan data pada modul {{ $title }} berhasil disimpan ke sistem!</span>
        </div>
        <button type="button" @click="savedSuccess = false" class="text-emerald-600 hover:text-emerald-900">&times;</button>
    </div>

    @if($isFormOnly)
        {{-- VIEW MODE 1: FORMULIR PENGATURAN / SINGLE RECORD (SEJARAH, VISI MISI, PENGATURAN, PROFIL AKUN) --}}
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-10 shadow-xs max-w-4xl space-y-8">
            <div class="border-b border-slate-100 pb-4">
                <h3 class="text-lg font-bold text-brand-dark">Formulir Pengelolaan: {{ $title }}</h3>
                <p class="text-xs text-brand-muted mt-0.5">Lengkapi isian data resmi di bawah ini.</p>
            </div>

            <form @submit.prevent="savedSuccess = true" class="space-y-6 text-xs sm:text-sm">
                @if(in_array($sec, ['sejarah', 'visi-misi', 'sambutan', 'struktur']))
                    <!-- Profile Form Inputs -->
                    <div class="space-y-1.5">
                        <label class="block font-bold text-brand-dark">Judul Bagian</label>
                        <input type="text" value="{{ $title }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block font-bold text-brand-dark">Isi Konten / Uraian Resmi <span class="text-rose-500">*</span></label>
                        <textarea rows="7" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary leading-relaxed">[Teks simulasi isi {{ strtolower($title) }}: Program Studi D-4 Teknik Rekayasa Multimedia POLITALA berkomitmen mencetak lulusan sarjana terapan yang profesional dan adaptif terhadap perkembangan industri multimedia internasional.]</textarea>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block font-bold text-brand-dark">Lampiran Berkas / Gambar Pendukung</label>
                        <input type="file" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-primary-light file:text-brand-primary hover:file:bg-brand-primary hover:file:text-white file:transition-colors">
                    </div>
                @elseif(in_array($sec, ['identitas', 'homepage', 'kontak-sosmed', 'logo-favicon']))
                    <!-- Site Settings Form Inputs -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label class="block font-bold text-brand-dark">Nama Website / Institusi</label>
                            <input type="text" value="D-4 Teknik Rekayasa Multimedia" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                        </div>
                        <div class="space-y-1.5">
                            <label class="block font-bold text-brand-dark">Singkatan Brand</label>
                            <input type="text" value="TRM POLITALA" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label class="block font-bold text-brand-dark">Email Resmi</label>
                            <input type="email" value="trm@politala.ac.id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                        </div>
                        <div class="space-y-1.5">
                            <label class="block font-bold text-brand-dark">Nomor Telepon</label>
                            <input type="text" value="(0512) 2021065" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block font-bold text-brand-dark">Alamat Kampus</label>
                        <textarea rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">Jl. A. Yani KM. 06, Desa Panggung, Kec. Pelaihari, Kab. Tanah Laut, Kalimantan Selatan 70815</textarea>
                    </div>
                @elseif($sec === 'my-profile')
                    <!-- Admin Profile Form Inputs -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label class="block font-bold text-brand-dark">Nama Pengelola</label>
                            <input type="text" value="Administrator TRM" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                        </div>
                        <div class="space-y-1.5">
                            <label class="block font-bold text-brand-dark">Alamat Email Login</label>
                            <input type="email" value="admin@politala.ac.id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                        </div>
                    </div>

                    <div class="border-t border-slate-100 pt-4 space-y-4">
                        <h4 class="font-bold text-sm text-brand-dark">Ganti Kata Sandi (Opsional)</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="space-y-1.5">
                                <label class="block font-bold text-brand-dark">Kata Sandi Baru</label>
                                <input type="password" placeholder="Minimal 8 karakter..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs">
                            </div>
                            <div class="space-y-1.5">
                                <label class="block font-bold text-brand-dark">Ulangi Kata Sandi Baru</label>
                                <input type="password" placeholder="Ulangi kata sandi..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs">
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Generic Upload/Form Input -->
                    <div class="space-y-1.5">
                        <label class="block font-bold text-brand-dark">Pilih Berkas yang Akan Diunggah</label>
                        <input type="file" multiple class="block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-primary-light file:text-brand-primary hover:file:bg-brand-primary hover:file:text-white">
                        <span class="text-xs text-brand-muted">Maksimal ukuran berkas 10 MB (Format: JPG, PNG, PDF, ZIP).</span>
                    </div>
                @endif

                <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="reset" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-primary-hover text-white text-xs font-bold shadow-sm transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>

    @elseif($isMediaGrid)
        {{-- VIEW MODE 2: MEDIA MANAGER GRID (FILE LIST) --}}
        <div class="space-y-6">
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="relative w-full sm:w-80">
                    <input type="text" placeholder="Cari media..." class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <a href="{{ route('admin.crud.sample', ['section' => 'media-upload']) }}" class="px-4 py-2 rounded-xl bg-brand-primary text-white text-xs font-bold hover:bg-brand-primary-hover shadow-sm transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    <span>Unggah Berkas Baru</span>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                @for ($m = 1; $m <= 6; $m++)
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-3 shadow-xs space-y-2 group hover:border-brand-primary/50 transition-all">
                        <div class="aspect-square rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 relative overflow-hidden">
                            <span class="text-[10px] font-mono">[Img #{{ $m }}]</span>
                        </div>
                        <div class="space-y-0.5">
                            <h5 class="font-bold text-[11px] text-brand-dark truncate" title="foto_lab_{{ $m }}.jpg">foto_lab_{{ $m }}.jpg</h5>
                            <span class="text-[10px] text-brand-muted block">1.4 MB &bull; JPG</span>
                        </div>
                        <div class="pt-1 flex items-center justify-between border-t border-slate-100">
                            <button type="button" class="text-[11px] text-brand-primary font-bold hover:underline">Salin URL</button>
                            <button type="button" @click="selectedItem = 'foto_lab_{{ $m }}.jpg'; deleteModalOpen = true" class="text-slate-400 hover:text-rose-600">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

    @else
        {{-- VIEW MODE 3: TABULAR CRUD DATA LIST WITH ADD/EDIT MODAL & DELETE CONFIRMATION --}}
        
        <!-- Header Control Bar: Search & Action Button -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex flex-1 items-center gap-3 max-w-lg">
                <div class="relative w-full">
                    <input type="text" placeholder="Cari dalam {{ strtolower($title) }}..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <select class="px-3 py-2.5 rounded-xl border border-slate-200 text-xs text-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-primary/20">
                    <option value="">Semua Status</option>
                    <option value="active">Aktif / Terbit</option>
                    <option value="draft">Draf Sementara</option>
                </select>
            </div>

            <button type="button" 
                    @click="modalTitle = 'Tambah ' + '{{ $title }}'; formData = { id: null, title: '', category: 'Utama', status: 'published' }; modalOpen = true" 
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-primary-hover text-white text-xs font-bold shadow-sm transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Tambah {{ $title }}</span>
            </button>
        </div>

        <!-- Dynamic Data Table based on Section Domain -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 border-b border-slate-200/80 text-slate-500 uppercase tracking-wider font-semibold">
                        <tr>
                            <th class="py-3.5 px-6 w-12 text-center">No</th>
                            @if(in_array($sec, ['dosen', 'tendik']))
                                <th class="py-3.5 px-4">Nama Lengkap &amp; Gelar</th>
                                <th class="py-3.5 px-4">NIP / Identitas</th>
                                <th class="py-3.5 px-4">Jabatan / Peran</th>
                                <th class="py-3.5 px-4">Bidang Keahlian</th>
                                <th class="py-3.5 px-4">Status</th>
                            @elseif(in_array($sec, ['kurikulum', 'mata-kuliah']))
                                <th class="py-3.5 px-4">Kode MK</th>
                                <th class="py-3.5 px-4">Nama Mata Kuliah</th>
                                <th class="py-3.5 px-4 text-center">Teori (SKS)</th>
                                <th class="py-3.5 px-4 text-center">Praktik (SKS)</th>
                                <th class="py-3.5 px-4 text-center">Semester</th>
                                <th class="py-3.5 px-4 text-center">Sifat</th>
                            @elseif($sec === 'users')
                                <th class="py-3.5 px-4">Nama Pengguna</th>
                                <th class="py-3.5 px-4">Alamat Email</th>
                                <th class="py-3.5 px-4">Peran (Role)</th>
                                <th class="py-3.5 px-4">Tanggal Registrasi</th>
                                <th class="py-3.5 px-4">Status Akun</th>
                            @else
                                <th class="py-3.5 px-4">Nama / Judul Item</th>
                                <th class="py-3.5 px-4">Kategori / Klasifikasi</th>
                                <th class="py-3.5 px-4">Status Publikasi</th>
                                <th class="py-3.5 px-4">Tanggal Diperbarui</th>
                            @endif
                            <th class="py-3.5 px-6 text-center w-36">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-brand-dark font-medium">
                        @for ($k = 1; $k <= 4; $k++)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3.5 px-6 text-center text-slate-400 font-bold">{{ $k }}</td>
                                
                                @if(in_array($sec, ['dosen', 'tendik']))
                                    <td class="py-3.5 px-4 font-bold text-brand-dark flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-full bg-brand-primary-light text-brand-primary flex items-center justify-center font-bold text-[10px]">
                                            D{{ $k }}
                                        </div>
                                        <span>[Dosen Simulasi {{ $k }}, M.Kom.]</span>
                                    </td>
                                    <td class="py-3.5 px-4 font-mono text-slate-500">19880115201903100{{ $k }}</td>
                                    <td class="py-3.5 px-4 text-brand-muted">Lektor / Pengajar</td>
                                    <td class="py-3.5 px-4 text-slate-700">Game Tech &amp; Multimedia 3D</td>
                                    <td class="py-3.5 px-4">
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                                    </td>
                                @elseif(in_array($sec, ['kurikulum', 'mata-kuliah']))
                                    <td class="py-3.5 px-4 font-mono font-bold text-brand-primary">TRM10{{ $k }}</td>
                                    <td class="py-3.5 px-4 font-bold text-brand-dark">[Mata Kuliah {{ $k }}] Pemrograman Multimedia &amp; Game</td>
                                    <td class="py-3.5 px-4 text-center">1</td>
                                    <td class="py-3.5 px-4 text-center">2</td>
                                    <td class="py-3.5 px-4 text-center">Semester {{ $k }}</td>
                                    <td class="py-3.5 px-4 text-center">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700">Wajib</span>
                                    </td>
                                @elseif($sec === 'users')
                                    <td class="py-3.5 px-4 font-bold text-brand-dark">Admin Pengelola {{ $k }}</td>
                                    <td class="py-3.5 px-4 font-mono text-slate-500">admin{{ $k }}@politala.ac.id</td>
                                    <td class="py-3.5 px-4">
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-brand-primary-light text-brand-primary">
                                            {{ $k === 1 ? 'Super Admin' : ($k === 2 ? 'Admin Konten' : 'Admin Akademik') }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-slate-400">10 Okt 2026</td>
                                    <td class="py-3.5 px-4">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                                    </td>
                                @else
                                    <td class="py-3.5 px-4 font-bold text-brand-dark">
                                        [Data Simulasi {{ $k }}] Item Terkait Modul {{ $title }}
                                    </td>
                                    <td class="py-3.5 px-4 text-brand-muted">Kategori Terpilih</td>
                                    <td class="py-3.5 px-4">
                                        @if($k % 2 === 1)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                                Dipublikasikan
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                                Draf Sementara
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4 text-slate-400">{{ date('d M Y, H:i') }}</td>
                                @endif

                                <td class="py-3.5 px-6 text-center">
                                    <div class="inline-flex items-center gap-1.5">
                                        <button type="button" 
                                                @click="modalTitle = 'Ubah Data #{{ $k }}'; formData = { id: {{ $k }}, title: '[Data Simulasi {{ $k }}]', category: 'Utama', status: 'published' }; modalOpen = true" 
                                                class="p-1.5 rounded-lg text-slate-500 hover:text-brand-primary hover:bg-slate-100 transition-colors" title="Ubah Data">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button type="button" 
                                                @click="selectedItem = 'Item #{{ $k }}'; deleteModalOpen = true" 
                                                class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="Hapus Data">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

            <!-- Pagination UI Mockup -->
            <div class="px-6 py-4 bg-slate-50/70 border-t border-slate-100 flex items-center justify-between text-xs text-brand-muted">
                <span>Menampilkan 1 sampai 4 dari 4 data simulasi</span>
                <div class="flex items-center gap-1">
                    <button disabled class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-300 font-semibold cursor-not-allowed">Sebelumnya</button>
                    <button class="px-3 py-1.5 rounded-lg bg-brand-primary text-white font-bold">1</button>
                    <button disabled class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-300 font-semibold cursor-not-allowed">Selanjutnya</button>
                </div>
            </div>
        </div>

        <!-- Modal Form Tambah / Ubah -->
        <div x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen p-4 text-center">
                <div x-show="modalOpen" 
                     x-transition:enter="transition-opacity ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity ease-in duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="modalOpen = false" 
                     class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs"></div>

                <div x-show="modalOpen" 
                     x-transition:enter="transition ease-out duration-200 transform"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150 transform"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="relative inline-block w-full max-w-lg p-6 my-8 overflow-hidden text-left align-middle bg-white rounded-3xl shadow-xl border border-slate-200/80">
                    
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-5">
                        <h3 class="text-base font-bold text-brand-dark" x-text="modalTitle">Formulir Data</h3>
                        <button type="button" @click="modalOpen = false" class="text-slate-400 hover:text-slate-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form @submit.prevent="modalOpen = false; savedSuccess = true" class="space-y-4 text-xs">
                        <div>
                            <label class="block font-bold text-brand-dark mb-1.5">Nama / Judul <span class="text-rose-500">*</span></label>
                            <input type="text" x-model="formData.title" placeholder="Masukkan judul..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                        </div>

                        <div>
                            <label class="block font-bold text-brand-dark mb-1.5">Kategori / Klasifikasi</label>
                            <select x-model="formData.category" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                                <option value="Utama">Utama</option>
                                <option value="Akademik">Akademik</option>
                                <option value="Industri">Industri</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-brand-dark mb-1.5">Status</label>
                            <div class="flex items-center gap-4 text-xs">
                                <label class="flex items-center gap-2">
                                    <input type="radio" value="published" x-model="formData.status" class="text-brand-primary">
                                    <span>Aktif / Terbitkan</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" value="draft" x-model="formData.status" class="text-brand-primary">
                                    <span>Draf Sementara</span>
                                </label>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                            <button type="button" @click="modalOpen = false" class="px-4 py-2 rounded-xl border border-slate-200 font-semibold text-slate-600 hover:bg-slate-50">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2 rounded-xl bg-brand-primary text-white font-bold hover:bg-brand-primary-hover shadow-sm">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Hapus -->
        <div x-show="deleteModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen p-4 text-center">
                <div x-show="deleteModalOpen" @click="deleteModalOpen = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs"></div>

                <div x-show="deleteModalOpen" class="relative inline-block w-full max-w-sm p-6 overflow-hidden text-center align-middle bg-white rounded-3xl shadow-xl border border-slate-200/80">
                    <div class="w-12 h-12 rounded-full bg-rose-100 text-rose-600 mx-auto flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h4 class="text-base font-bold text-brand-dark mb-1">Konfirmasi Penghapusan</h4>
                    <p class="text-xs text-brand-muted leading-relaxed mb-6">
                        Apakah Anda yakin ingin menghapus <strong x-text="selectedItem"></strong>? Tindakan ini tidak dapat dibatalkan.
                    </p>
                    <div class="flex items-center justify-center gap-3">
                        <button type="button" @click="deleteModalOpen = false" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                            Batal
                        </button>
                        <button type="button" @click="deleteModalOpen = false; savedSuccess = true" class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shadow-sm transition-colors">
                            Ya, Hapus Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection

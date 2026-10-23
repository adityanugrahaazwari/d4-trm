@extends('layouts.admin')

@section('title', 'Manajemen ' . ucfirst(str_replace('-', ' ', $section ?? 'Data')))
@section('page_title', 'Manajemen ' . ucfirst(str_replace('-', ' ', $section ?? 'Data')))
@section('page_subtitle', 'Kerangka UI panel admin standar untuk pengelolaan data dan formulir')

@section('content')
<div x-data="{ 
    modalOpen: false, 
    deleteModalOpen: false, 
    selectedItem: null,
    modalTitle: 'Tambah Data Baru',
    formData: { id: null, title: '', category: 'Umum', status: 'published' }
}" class="space-y-6">

    <!-- Flash Helper Banner -->
    <div class="rounded-xl bg-brand-sky-light border border-brand-sky/60 p-4 text-brand-dark text-xs flex items-center justify-between">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span><strong>Kerangka UI Modul:</strong> Komponen tabel, form modal, dan konfirmasi hapus di bawah ini disiapkan sebagai standar antarmuka seluruh modul CRUD backend (Tahap 7–12).</span>
        </div>
        <span class="text-[10px] uppercase font-bold text-brand-primary bg-white px-2 py-0.5 rounded shadow-xs">Komponen Tahap 5</span>
    </div>

    <!-- Header Control Bar: Search, Filter & Add Button -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <!-- Search & Filter Bar -->
        <div class="flex flex-1 items-center gap-3 max-w-lg">
            <div class="relative w-full">
                <input type="text" placeholder="Cari data..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary">
                <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <select class="px-3 py-2.5 rounded-xl border border-slate-200 text-xs text-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-primary/20">
                <option value="">Semua Status</option>
                <option value="published">Terbit (Published)</option>
                <option value="draft">Draf (Draft)</option>
            </select>
        </div>

        <!-- Add Button -->
        <button type="button" 
                @click="modalTitle = 'Tambah ' + '{{ ucfirst(str_replace('-', ' ', $section ?? 'Data')) }}'; formData = { id: null, title: '', category: 'Umum', status: 'published' }; modalOpen = true" 
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-primary-hover text-white text-xs font-bold shadow-sm transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Tambah Data Baru</span>
        </button>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200/80 text-slate-500 uppercase tracking-wider font-semibold">
                    <tr>
                        <th class="py-3.5 px-6 w-12 text-center">No</th>
                        <th class="py-3.5 px-4">Nama / Judul Item</th>
                        <th class="py-3.5 px-4">Kategori / Klasifikasi</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4">Tanggal Diperbarui</th>
                        <th class="py-3.5 px-6 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-brand-dark font-medium">
                    @for ($k = 1; $k <= 4; $k++)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3.5 px-6 text-center text-slate-400 font-bold">{{ $k }}</td>
                            <td class="py-3.5 px-4 font-bold text-brand-dark">
                                [Data Simulasi {{ $k }}] Dokumen / Item Terkait Modul {{ ucfirst(str_replace('-', ' ', $section ?? 'TRM')) }}
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
                            <td class="py-3.5 px-6 text-center">
                                <div class="inline-flex items-center gap-1.5">
                                    <button type="button" 
                                            @click="modalTitle = 'Ubah Data #{{ $k }}'; formData = { id: {{ $k }}, title: '[Data Simulasi {{ $k }}]', category: 'Umum', status: 'published' }; modalOpen = true" 
                                            class="p-1.5 rounded-lg text-slate-500 hover:text-brand-primary hover:bg-slate-100 transition-colors" title="Ubah">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button type="button" 
                                            @click="selectedItem = '[Data Simulasi {{ $k }}]'; deleteModalOpen = true" 
                                            class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="Hapus">
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
            <span>Menampilkan 1 sampai 4 dari 4 data</span>
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
            <!-- Modal Backdrop -->
            <div x-show="modalOpen" 
                 x-transition:enter="transition-opacity ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-in duration-150"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="modalOpen = false" 
                 class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs"></div>

            <!-- Modal Panel -->
            <div x-show="modalOpen" 
                 x-transition:enter="transition ease-out duration-200 transform"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="relative inline-block w-full max-w-lg p-6 my-8 overflow-hidden text-left align-middle bg-white rounded-2xl shadow-xl border border-slate-200/80">
                
                <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-5">
                    <h3 class="text-base font-bold text-brand-dark" x-text="modalTitle">Formulir Data</h3>
                    <button type="button" @click="modalOpen = false" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form @submit.prevent="modalOpen = false" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-brand-dark mb-1.5">Judul / Nama Lengkap <span class="text-rose-500">*</span></label>
                        <input type="text" x-model="formData.title" placeholder="Masukkan judul item..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-brand-dark mb-1.5">Kategori / Klasifikasi</label>
                        <select x-model="formData.category" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-primary/20">
                            <option value="Umum">Umum</option>
                            <option value="Akademik">Akademik</option>
                            <option value="Kemahasiswaan">Kemahasiswaan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-brand-dark mb-1.5">Status Publikasi</label>
                        <div class="flex items-center gap-4 text-xs">
                            <label class="flex items-center gap-2">
                                <input type="radio" value="published" x-model="formData.status" class="text-brand-primary focus:ring-brand-primary">
                                <span>Publikasikan Langsung</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" value="draft" x-model="formData.status" class="text-brand-primary focus:ring-brand-primary">
                                <span>Simpan Sebagai Draf</span>
                            </label>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                        <button type="button" @click="modalOpen = false" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 rounded-xl bg-brand-primary hover:bg-brand-primary-hover text-white text-xs font-bold shadow-sm transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div x-show="deleteModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
            <div x-show="deleteModalOpen" 
                 @click="deleteModalOpen = false" 
                 class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs"></div>

            <div x-show="deleteModalOpen" 
                 class="relative inline-block w-full max-w-sm p-6 overflow-hidden text-center align-middle bg-white rounded-2xl shadow-xl border border-slate-200/80">
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
                    <button type="button" @click="deleteModalOpen = false" class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shadow-sm transition-colors">
                        Ya, Hapus Data
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

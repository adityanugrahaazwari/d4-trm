@extends('layouts.public')

@section('title', 'Masuk Panel Admin - D-4 TRM')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-16 px-4 bg-slate-50/50">
    <div class="w-full max-w-md bg-white p-8 sm:p-10 rounded-3xl border border-slate-200/80 shadow-lg space-y-6">
        <!-- Logo & Header -->
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-2xl bg-brand-primary text-white font-black text-xl flex items-center justify-center mx-auto shadow-md shadow-brand-primary/20">
                TRM
            </div>
            <h2 class="text-2xl font-bold text-brand-dark">Masuk Panel Pengelola</h2>
            <p class="text-xs text-brand-muted">Gunakan akun administrator D-4 TRM POLITALA</p>
        </div>

        <!-- Form Login Mockup -->
        <form action="{{ route('admin.dashboard') }}" method="GET" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-brand-dark mb-1.5">Alamat Email Pengelola</label>
                <input type="email" value="admin@politala.ac.id" placeholder="admin@politala.ac.id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary">
            </div>

            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label class="block text-xs font-bold text-brand-dark">Kata Sandi</label>
                    <span class="text-[11px] text-brand-secondary">Lupa sandi?</span>
                </div>
                <input type="password" value="password" placeholder="••••••••" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary">
            </div>

            <div class="flex items-center justify-between text-xs text-brand-muted">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" checked class="rounded border-slate-300 text-brand-primary focus:ring-brand-primary">
                    <span>Ingat sesi saya</span>
                </label>
            </div>

            <!-- Tombol Masuk langsung ke Dashboard -->
            <button type="submit" class="w-full py-3 rounded-xl bg-brand-primary hover:bg-brand-primary-hover text-white text-xs font-bold shadow-md shadow-brand-primary/20 transition-all flex items-center justify-center gap-2">
                <span>Masuk ke Dashboard Admin</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </form>

        <div class="pt-4 border-t border-slate-100 text-center">
            <a href="{{ route('home') }}" class="text-xs text-brand-muted hover:text-brand-primary inline-flex items-center gap-1 font-medium">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Website Publik</span>
            </a>
        </div>
    </div>
</div>
@endsection

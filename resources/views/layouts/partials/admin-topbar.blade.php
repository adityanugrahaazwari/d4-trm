<header class="h-20 bg-white border-b border-slate-200/80 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-40">
    <div class="flex items-center gap-4">
        <!-- Mobile Sidebar Toggle -->
        <button type="button" @click="mobileSidebarOpen = true" class="lg:hidden p-2 rounded-lg text-brand-dark hover:bg-slate-100 transition-colors">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Current Breadcrumb / Section Title -->
        <div>
            <h1 class="font-bold text-lg text-brand-dark leading-tight">@yield('page_title', 'Dashboard')</h1>
            <p class="text-xs text-brand-muted">@yield('page_subtitle', 'Panel Kontrol dan Manajemen Website D-4 TRM')</p>
        </div>
    </div>

    <!-- Right Quick Controls -->
    <div class="flex items-center gap-3">
        <!-- Live Website Shortcut -->
        <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-semibold text-brand-dark hover:text-brand-primary hover:border-brand-primary/50 transition-colors">
            <span>Lihat Website</span>
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>
        </a>

        <!-- Profile Dropdown -->
        <div class="relative" x-data="{ profileMenu: false }" @click.outside="profileMenu = false">
            <button type="button" @click="profileMenu = !profileMenu" class="flex items-center gap-2.5 p-1 rounded-full hover:bg-slate-100 transition-colors">
                <div class="w-9 h-9 rounded-full bg-brand-primary text-white font-bold text-xs flex items-center justify-center">
                    AD
                </div>
                <div class="hidden md:block text-left pr-1">
                    <span class="block text-xs font-bold text-brand-dark leading-tight">Admin TRM</span>
                    <span class="block text-[10px] text-brand-muted">Pengelola</span>
                </div>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="profileMenu" 
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute right-0 mt-2 w-48 rounded-xl bg-white p-1.5 shadow-xl border border-slate-100 text-xs font-medium space-y-0.5 z-50" style="display: none;">
                <a href="{{ route('admin.crud.sample', ['section' => 'my-profile']) }}" class="block px-3 py-2 rounded-lg text-slate-700 hover:bg-slate-50 hover:text-brand-primary transition-colors">
                    Profil Akun
                </a>
                <a href="{{ route('admin.crud.sample', ['section' => 'identitas']) }}" class="block px-3 py-2 rounded-lg text-slate-700 hover:bg-slate-50 hover:text-brand-primary transition-colors">
                    Pengaturan
                </a>
                <div class="border-t border-slate-100 my-1"></div>
                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-rose-600 hover:bg-rose-50 font-semibold transition-colors">
                    Keluar Sistem
                </a>
            </div>
        </div>
    </div>
</header>

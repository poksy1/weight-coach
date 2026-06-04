<div x-data="{ open: false }">
    <!-- ========================================== -->
    <!-- SIDEBAR KLIEN/USER UNTUK DESKTOP (KIRI)    -->
    <!-- ========================================== -->
    <nav class="hidden md:flex flex-col w-72 h-screen bg-white border-r border-gray-100 shadow-sm z-10 relative">
        
        <!-- Logo Brand -->
        <div class="px-8 py-8 mb-4">
            <h1 class="text-3xl font-black text-[#003d29] tracking-tight">Weight<span class="text-[#008f5d]">Coach</span></h1>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Premium Wellness</p>
        </div>

        <!-- Menu Navigasi Klien -->
        <div class="flex-1 px-4 space-y-2 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl font-bold transition-all {{ request()->routeIs('dashboard') ? 'bg-[#e9fbf0] text-[#008f5d] shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-[#008f5d]' }}">
                <span class="text-xl">🏠</span> Dashboard
            </a>
            <a href="{{ route('meal-plans') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl font-bold transition-all {{ request()->routeIs('meal-plans') ? 'bg-[#e9fbf0] text-[#008f5d] shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-[#008f5d]' }}">
                <span class="text-xl">📅</span> Meal Plans
            </a>
            <a href="{{ route('history') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl font-bold transition-all {{ request()->routeIs('history') ? 'bg-[#e9fbf0] text-[#008f5d] shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-[#008f5d]' }}">
                <span class="text-xl">🕒</span> Riwayat
            </a>
            <a href="{{ route('analytics') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl font-bold transition-all {{ request()->routeIs('analytics') ? 'bg-[#e9fbf0] text-[#008f5d] shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-[#008f5d]' }}">
                <span class="text-xl">📈</span> Analitik Mingguan
            </a>
        </div>

        <!-- Profile & Logout di Bawah -->
        <div class="p-4 border-t border-gray-100">
            <div class="bg-gray-50 rounded-2xl p-4 flex flex-col gap-3 border border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#e9fbf0] flex items-center justify-center text-[#008f5d] font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                        <a href="{{ route('profile.edit') }}" class="text-xs font-medium text-[#008f5d] hover:underline">Edit Profil</a>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 px-4 bg-white border border-red-200 rounded-xl text-sm font-bold text-red-500 hover:bg-red-50 hover:border-red-300 transition-colors shadow-sm">
                        <span>Keluar Aplikasi</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- ========================================== -->
    <!-- HEADER KECIL UNTUK MOBILE (HP)             -->
    <!-- ========================================== -->
    <div class="md:hidden flex items-center justify-between px-4 py-4 bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <h1 class="text-xl font-black text-[#003d29] tracking-tight">Weight<span class="text-[#008f5d]">Coach</span></h1>
        <button @click="open = ! open" class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- MENU DROPDOWN MOBILE (USER KLIEN) -->
    <div x-show="open" @click.away="open = false" class="md:hidden absolute w-full bg-white border-b border-gray-100 shadow-lg z-40">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-bold {{ request()->routeIs('dashboard') ? 'text-[#008f5d] bg-[#e9fbf0]' : 'text-gray-600 hover:bg-gray-50' }}">🏠 Dashboard</a>
            <a href="{{ route('meal-plans') }}" class="block px-3 py-2 rounded-md text-base font-bold {{ request()->routeIs('meal-plans') ? 'text-[#008f5d] bg-[#e9fbf0]' : 'text-gray-600 hover:bg-gray-50' }}">📅 Meal Plans</a>
            <a href="{{ route('history') }}" class="block px-3 py-2 rounded-md text-base font-bold {{ request()->routeIs('history') ? 'text-[#008f5d] bg-[#e9fbf0]' : 'text-gray-600 hover:bg-gray-50' }}">🕒 Riwayat</a>
            <a href="{{ route('analytics') }}" class="block px-3 py-2 rounded-md text-base font-bold {{ request()->routeIs('analytics') ? 'text-[#008f5d] bg-[#e9fbf0]' : 'text-gray-600 hover:bg-gray-50' }}">📈 Analitik Mingguan</a>
            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-bold text-gray-600 hover:bg-gray-50">👤 Edit Profil</a>
            <form method="POST" action="{{ route('logout') }}" class="mt-4 pt-4 border-t border-gray-100">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 text-base font-bold text-red-500 hover:bg-red-50 rounded-md">Keluar Aplikasi</button>
            </form>
        </div>
    </div>
</div>
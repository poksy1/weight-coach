<x-app-layout>
    <div class="py-8 bg-slate-50 min-h-screen">
        @php
            // Pastikan tanggal menggunakan bahasa Indonesia
            \Carbon\Carbon::setLocale('id');
        @endphp
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- HEADER -->
            <header class="mb-10 px-4 sm:px-0">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 tracking-tight mb-2">
                    Halo, {{ explode(' ', auth()->user()->name)[0] }}! 👋
                </h2>
                <p class="text-gray-500 font-medium">
                    Berikut ringkasan kesehatanmu untuk hari ini, {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}.
                </p>
            </header>

            <!-- BENTO GRID -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 px-4 sm:px-0">
                
                <!-- KARTU KALORI UTAMA -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:col-span-12 lg:col-span-7 flex flex-col md:flex-row items-center gap-8 hover:shadow-md transition-shadow">
                    
                    <div class="flex-1 w-full text-center md:text-left">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Keseimbangan Kalori</h3>
                        <p class="text-gray-500 text-sm mb-6">Pantau terus asupan kalori harianmu.</p>
                        
                        <div class="flex flex-wrap gap-4 justify-center md:justify-start mt-4">
                            <div class="bg-orange-50 rounded-2xl p-4 border border-orange-100 flex-1 min-w-[120px]">
                                <span class="block text-xs font-bold text-orange-500 uppercase tracking-wider mb-1">Terkonsumsi</span>
                                <span class="text-3xl font-extrabold text-orange-600">{{ number_format($caloriesConsumedToday, 0) }}</span>
                                <span class="text-sm font-medium text-orange-500">kkal</span>
                            </div>
                            <div class="bg-indigo-50 rounded-2xl p-4 border border-indigo-100 flex-1 min-w-[120px]">
                                <span class="block text-xs font-bold text-indigo-500 uppercase tracking-wider mb-1">Target</span>
                                <span class="text-3xl font-extrabold text-indigo-600">{{ number_format($targetCalorie, 0) }}</span>
                                <span class="text-sm font-medium text-indigo-500">kkal</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Lingkaran Animasi Kalori -->
                    @php
                        $ringCircumference = 339.292;
                        $ringOffset = max(0, $ringCircumference - ($ringCircumference * ($progressPercentage / 100)));
                    @endphp
                    <div class="relative w-48 h-48 flex-shrink-0">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 120 120">
                            <!-- Background Ring -->
                            <circle cx="60" cy="60" fill="none" r="54" stroke="#f3f4f6" stroke-width="8"></circle>
                            <!-- Progress Ring -->
                            <circle cx="60" cy="60" fill="none" r="54" stroke="#4f46e5" stroke-dasharray="339.292" stroke-dashoffset="{{ $ringOffset }}" stroke-linecap="round" stroke-width="8" style="transition: stroke-dashoffset 1s ease-in-out;"></circle>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-3xl mb-1">🔥</span>
                            <span class="text-3xl font-extrabold text-indigo-600">{{ number_format(max(0, $remainingCalorie), 0) }}</span>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mt-1">Sisa Kalori</span>
                        </div>
                    </div>
                </div>

                <!-- KARTU MAKRONUTRIEN -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:col-span-6 lg:col-span-5 flex flex-col justify-between hover:shadow-md transition-shadow">
                    @php 
                        $proteinTotal = $dailyFoods->sum('protein');
                        $sugarTotal = $dailyFoods->sum('sugar');
                        $proteinPercent = min(100, ($proteinTotal / 100) * 100);
                        $sugarPercent = min(100, ($sugarTotal / 50) * 100);
                    @endphp
                    
                    <div>
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Makronutrien</h3>
                            <span class="text-2xl">📊</span>
                        </div>
                        
                        <div class="space-y-6">
                            <!-- Bar Protein -->
                            <div>
                                <div class="flex justify-between text-sm font-bold mb-2">
                                    <span class="text-indigo-600">Protein</span>
                                    <span class="text-gray-700">{{ $proteinTotal }}g <span class="text-gray-400 text-xs font-normal">/ 100g</span></span>
                                </div>
                                <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-500 rounded-full transition-all duration-1000" style="width: {{ $proteinPercent }}%"></div>
                                </div>
                            </div>
                            
                            <!-- Bar Gula -->
                            <div>
                                <div class="flex justify-between text-sm font-bold mb-2">
                                    <span class="text-pink-500">Gula</span>
                                    <span class="text-gray-700">{{ $sugarTotal }}g <span class="text-gray-400 text-xs font-normal">/ 50g</span></span>
                                </div>
                                <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-pink-500 rounded-full transition-all duration-1000" style="width: {{ $sugarPercent }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <a href="{{ route('analytics') }}" class="mt-8 w-full block text-center py-3 rounded-xl bg-indigo-50 text-indigo-700 font-bold hover:bg-indigo-100 transition-colors duration-300">
                        Lihat Analitik Mingguan
                    </a>
                </div>

                <!-- KARTU AIR (HIDRASI) -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:col-span-6 lg:col-span-4 flex flex-col items-center justify-center text-center hover:shadow-md transition-shadow">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 w-full text-left">Asupan Air</h3>
                    
                    @php
                        $waterTarget = 2500;
                        $waterCurrent = session('water', 0);
                        $waterPercent = min(100, ($waterCurrent / $waterTarget) * 100);
                    @endphp
                    
                    <div class="relative w-24 h-40 bg-blue-50 border-2 border-blue-100 rounded-full overflow-hidden shadow-inner mb-6">
                        <div class="absolute bottom-0 left-0 w-full bg-blue-400 transition-all duration-1000 ease-out" style="height: {{ $waterPercent }}%;">
                            <div class="absolute top-0 left-0 w-full h-1 bg-white/40"></div>
                        </div>
                    </div>
                    
                    <div class="text-3xl font-extrabold text-blue-600">{{ number_format($waterCurrent, 0) }} ml</div>
                    <div class="text-sm font-medium text-gray-500 mt-1">dari target {{ number_format($waterTarget, 0) }} ml</div>
                    
                    <form action="{{ route('water.add') }}" method="POST">
                        @csrf
                        <button type="submit" class="mt-6 w-14 h-14 rounded-full bg-blue-500 text-white flex items-center justify-center hover:bg-blue-600 hover:shadow-lg transition-all duration-300 text-2xl font-bold" title="Tambah 250ml Air">
                            +
                        </button>
                    </form>
                </div>

                <!-- KARTU MOTIVASI (INSIGHT) -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-3xl shadow-sm p-8 md:col-span-12 lg:col-span-8 flex items-center text-white hover:shadow-md transition-shadow">
                    <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center mr-6 shadow-sm flex-shrink-0 text-3xl">
                        ✨
                    </div>
                    <div>
                        <h4 class="text-xl font-bold mb-2">Kamu luar biasa hari ini!</h4>
                        <p class="text-indigo-50 font-medium leading-relaxed">
                            @if($totalSugar > 40)
                                Hati-hati, konsumsi gula harianmu hampir menyentuh batas maksimal. Perbanyak minum air putih ya!
                            @elseif($remainingCalorie < 0)
                                Batas kalorimu sudah terlewati hari ini. Tetap aktif dan jangan lupa olahraga ringan.
                            @else
                                Memenuhi target nutrisi akan menjaga energi kamu tetap stabil. Pertahankan ritme sehat ini!
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- BAGIAN MAKANAN HARI INI -->
            <section class="mt-12 mb-8 px-4 sm:px-0">
                <div class="flex justify-between items-end mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Makanan Hari Ini</h3>
                    <a href="{{ route('history') }}" class="text-indigo-600 font-bold hover:underline text-sm">Lihat Semua Riwayat</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($dailyFoods as $food)
                        <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow group flex flex-col">
                            <div class="h-32 w-full relative bg-slate-50 flex items-center justify-center">
                                <span class="text-5xl transform group-hover:scale-110 transition-transform duration-500">🍽️</span>
                                <div class="absolute top-3 right-3 bg-white px-3 py-1 rounded-full text-xs font-bold text-indigo-600 shadow-sm border border-gray-100">
                                    {{ number_format($food->calories, 0) }} kkal
                                </div>
                            </div>
                            <div class="p-6 relative flex-1 flex flex-col">
                                <!-- Tombol Hapus -->
                                <form action="{{ route('food.destroy', $food->id) }}" method="POST" class="absolute top-4 right-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 hover:bg-red-50 px-2 py-1 rounded transition text-xs font-bold" title="Hapus">
                                        HAPUS
                                    </button>
                                </form>
                                
                                <span class="inline-block px-3 py-1 rounded bg-indigo-50 text-indigo-700 text-[10px] font-bold uppercase tracking-wider mb-3 w-max">
                                    {{ $food->meal_type }}
                                </span>
                                <h4 class="text-lg font-bold text-gray-800 mb-1 pr-12 leading-tight">{{ $food->food_name }}</h4>
                                <div class="mt-auto pt-4">
                                    <p class="text-xs font-medium text-gray-500">Protein: <span class="font-bold text-gray-700">{{ $food->protein }}g</span> &bull; Gula: <span class="font-bold text-gray-700">{{ $food->sugar }}g</span></p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Tombol Tambah Makanan -->
                    <a href="{{ route('food.search') }}" class="bg-white rounded-3xl border-2 border-dashed border-gray-200 flex flex-col items-center justify-center p-6 min-h-[200px] hover:bg-indigo-50 hover:border-indigo-300 transition-colors group cursor-pointer">
                        <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <span class="text-2xl text-indigo-600 font-bold">+</span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-1">Catat Makanan</h4>
                        <p class="text-xs font-medium text-gray-500 text-center">Apa menu sehatmu selanjutnya?</p>
                    </a>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div x-data="{ showLogModal: false, logTab: 'fatsecret' }" class="py-8 bg-slate-50 min-h-screen selection:bg-[#008f5d] selection:text-white">
        @php \Carbon\Carbon::setLocale('id'); @endphp
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <header class="mb-10 px-4 sm:px-0 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
                <div>
                    <h2 class="text-3xl md:text-4xl font-black text-[#003d29] tracking-tight mb-2">
                        Halo, {{ explode(' ', auth()->user()->name)[0] }}! 
                    </h2>
                    <p class="text-gray-500 font-semibold text-sm">
                        Berikut ringkasan kesehatanmu hari ini, <span class="text-[#008f5d]">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>.
                    </p>
                </div>
                <div class="bg-[#e9fbf0] border border-[#c1ecd4] px-4 py-2 rounded-2xl flex items-center gap-2 shadow-sm">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#008f5d] animate-pulse"></span>
                    <span class="text-xs font-bold text-[#003d29] uppercase tracking-wider">Premium Member</span>
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 px-4 sm:px-0">
                
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 md:col-span-12 lg:col-span-7 flex flex-col sm:flex-row items-center gap-8 hover:shadow-md transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-[#e9fbf0] rounded-full blur-3xl -z-10 opacity-50"></div>
                    
                    <div class="flex-1 w-full text-center sm:text-left">
                        <span class="text-[10px] font-extrabold text-[#008f5d] uppercase tracking-widest bg-[#e9fbf0] px-3 py-1 rounded-full">Energy Balance</span>
                        <h3 class="text-2xl font-black text-[#003d29] mt-3 mb-1">Keseimbangan Kalori</h3>
                        <p class="text-gray-400 text-xs font-medium mb-6">Pantau sisa kuota energi makananmu.</p>
                        
                        <div class="flex flex-row gap-4 justify-center sm:justify-start mt-4">
                            <div class="bg-slate-50 rounded-2xl p-4 border border-gray-100 flex-1 min-w-[100px] shadow-inner">
                                <span class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-wider mb-1">Masuk</span>
                                <span class="text-2xl font-black text-[#003d29]">{{ number_format($caloriesConsumedToday, 0) }}</span>
                                <span class="text-xs font-bold text-gray-400">kkal</span>
                            </div>
                            <div class="bg-[#e9fbf0] rounded-2xl p-4 border border-[#c1ecd4] flex-1 min-w-[100px]">
                                <span class="block text-[10px] font-extrabold text-[#008f5d] uppercase tracking-wider mb-1">Target</span>
                                <span class="text-2xl font-black text-[#008f5d]">{{ number_format($targetCalorie, 0) }}</span>
                                <span class="text-xs font-bold text-[#008f5d]">kkal</span>
                            </div>
                        </div>
                    </div>
                    
                    @php
                        $ringCircumference = 339.292;
                        $ringOffset = max(0, $ringCircumference - ($ringCircumference * ($progressPercentage / 100)));
                    @endphp
                    <div class="relative w-44 h-44 flex-shrink-0 bg-slate-50 rounded-full p-2 shadow-inner border border-gray-100 flex items-center justify-center">
                        <svg class="w-full h-full transform -rotate-90 absolute" viewBox="0 0 120 120">
                            <circle cx="60" cy="60" fill="none" r="54" stroke="#e2e8f0" stroke-width="8"></circle>
                            <circle cx="60" cy="60" fill="none" r="54" stroke="#003d29" stroke-dasharray="339.292" stroke-dashoffset="{{ $ringOffset }}" stroke-linecap="round" stroke-width="8" style="transition: stroke-dashoffset 1s cubic-bezier(0.4, 0, 0.2, 1);"></circle>
                        </svg>
                        <div class="text-center z-10">
                            <span class="text-2xl block mb-0.5"></span>
                            <span class="text-3xl font-black text-[#003d29] tracking-tight">{{ number_format(max(0, $remainingCalorie), 0) }}</span>
                            <span class="text-[9px] font-extrabold text-gray-400 uppercase tracking-widest block mt-1">Sisa Kalori</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 md:col-span-12 lg:col-span-5 flex flex-col justify-between hover:shadow-md transition-all duration-300">
                    @php 
                        $proteinTotal = $dailyFoods->sum('protein');
                        $sugarTotal = $dailyFoods->sum('sugar');
                        $proteinPercent = min(100, ($proteinTotal / 100) * 100);
                        $sugarPercent = min(100, ($sugarTotal / 50) * 100);
                    @endphp
                    
                    <div>
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-black text-[#003d29]">Nutritional Status</h3>
                            <span class="w-8 h-8 rounded-xl bg-slate-50 border border-gray-100 flex items-center justify-center text-sm"></span>
                        </div>
                        
                        <div class="space-y-5">
                            <div>
                                <div class="flex justify-between text-xs font-bold mb-1.5">
                                    <span class="text-[#008f5d]">Protein Premium</span>
                                    <span class="text-gray-700">{{ $proteinTotal }}g <span class="text-gray-400 font-medium">/ 100g</span></span>
                                </div>
                                <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden shadow-inner">
                                    <div class="h-full bg-[#003d29] rounded-full transition-all duration-1000" style="width: {{ $proteinPercent }}%"></div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex justify-between text-xs font-bold mb-1.5">
                                    <span class="text-amber-600">Ambang Gula</span>
                                    <span class="text-gray-700">{{ $sugarTotal }}g <span class="text-gray-400 font-medium">/ 50g</span></span>
                                </div>
                                <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden shadow-inner">
                                    <div class="h-full bg-amber-500 rounded-full transition-all duration-1000" style="width: {{ $sugarPercent }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <a href="{{ route('analytics') }}" class="mt-6 w-full block text-center py-3.5 rounded-2xl bg-slate-50 border border-gray-100 text-[#003d29] font-black text-xs uppercase tracking-wider hover:bg-[#e9fbf0] hover:text-[#008f5d] hover:border-[#c1ecd4] transition-all duration-300">
                        Lihat Analitik Mingguan &rarr;
                    </a>
                </div>

                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 md:col-span-12 lg:col-span-4 flex flex-col items-center justify-center text-center hover:shadow-md transition-all duration-300">
                    <h3 class="text-xl font-black text-[#003d29] mb-6 w-full text-left">Water Tracker</h3>
                    
                    @php
                        $waterTarget = 2500;
                        $waterCurrent = session('water', 0);
                        $waterPercent = min(100, ($waterCurrent / $waterTarget) * 100);
                    @endphp
                    
                    <div class="relative w-20 h-36 bg-slate-50 border border-slate-200 rounded-full overflow-hidden shadow-inner mb-6">
                        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-blue-600 to-blue-400 transition-all duration-1000 ease-out" style="height: {{ $waterPercent }}%;">
                            <div class="absolute top-0 left-0 w-full h-1 bg-white/30 animate-pulse"></div>
                        </div>
                    </div>
                    
                    <div class="text-2xl font-black text-blue-600 tracking-tight">{{ number_format($waterCurrent, 0) }} ml</div>
                    <div class="text-xs font-bold text-gray-400 mt-1 uppercase tracking-wider">Target: {{ number_format($waterTarget, 0) }} ml</div>
                    
                    <form action="{{ route('water.add') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="mt-5 w-full py-3.5 rounded-2xl bg-blue-50 border border-blue-100 text-blue-600 font-black text-xs uppercase tracking-wider hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all duration-300 shadow-sm">
                            + Isi 250ml Air
                        </button>
                    </form>
                </div>

                <div class="bg-gradient-to-br from-[#003d29] to-[#002d1d] rounded-[2.5rem] shadow-xl p-8 md:col-span-12 lg:col-span-8 flex flex-col sm:flex-row items-center text-white hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-44 h-44 bg-[#008f5d] rounded-full blur-3xl opacity-30"></div>
                    
                    <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-6 sm:mb-0 sm:mr-6 shadow-md flex-shrink-0 text-3xl border border-white/10">
                        
                    </div>
                    <div>
                        <h4 class="text-2xl font-black mb-2 tracking-tight">Kamu luar biasa hari ini!</h4>
                        <p class="text-[#c1ecd4] font-medium text-sm leading-relaxed max-w-xl">
                            @if($totalSugar > 40)
                                Hati-hati, konsumsi gula harianmu hampir menyentuh batas maksimal. Rem penggunaan pemanis dan perbanyak minum air putih ya!
                            @elseif($remainingCalorie < 0)
                                Batas kalori harianmu sudah terlewati malam ini. Jangan berkecil hati, ayo imbangi dengan jalan kaki atau olahraga ringan.
                            @else
                                Memenuhi target nutrisi secara konsisten akan menjaga metabolisme tubuhmu tetap stabil dan prima. Pertahankan ritme disiplin ini!
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <section class="mt-12 mb-8 px-4 sm:px-0">
                <div class="flex justify-between items-end mb-6">
                    <div>
                        <h3 class="text-2xl font-black text-[#003d29] tracking-tight">Jurnal Makanan</h3>
                        <p class="text-xs font-semibold text-gray-400 mt-0.5">Daftar asupan yang masuk ke tubuhmu hari ini.</p>
                    </div>
                    <a href="{{ route('history') }}" class="text-[#008f5d] font-bold hover:text-[#003d29] text-xs uppercase tracking-wider hover:underline">Lihat Semua Riwayat &raquo;</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    @foreach($dailyFoods as $food)
                        <div class="bg-white rounded-[2rem] border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 group flex flex-col relative p-5 shadow-sm">
                            <form action="{{ route('food.destroy', $food->id) }}" method="POST" class="absolute top-4 right-4">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-full bg-red-50 text-red-400 flex items-center justify-center font-bold hover:bg-red-500 hover:text-white transition-all text-lg shadow-sm" title="Hapus Asupan">&times;</button>
                            </form>
                            
                            <div class="flex items-center gap-4 flex-1">
                                <div class="w-14 h-14 bg-[#e9fbf0] border border-[#c1ecd4] rounded-2xl flex items-center justify-center text-2xl shadow-inner group-hover:scale-110 transition-transform duration-300">
                                    
                                </div>
                                <div class="flex-1 pr-8">
                                    <span class="inline-block px-2 py-0.5 rounded bg-slate-100 text-[#003d29] text-[9px] font-extrabold uppercase tracking-widest mb-1">
                                        {{ $food->meal_type }}
                                    </span>
                                    <h4 class="text-base font-black text-gray-800 leading-tight line-clamp-1">{{ $food->food_name }}</h4>
                                    <div class="flex gap-2 mt-2 text-[10px] font-bold text-gray-400">
                                        <span class="text-[#008f5d] bg-[#e9fbf0] px-2 py-0.5 rounded">{{ number_format($food->calories, 0) }} kkal</span>
                                        <span>Pro: <strong class="text-gray-600">{{ $food->protein }}g</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div @click="showLogModal = true" class="bg-white border-2 border-dashed border-[#c1ecd4] rounded-[2rem] p-6 flex flex-col items-center justify-center cursor-pointer hover:border-[#008f5d] hover:bg-[#e9fbf0] transition-all duration-300 group shadow-sm min-h-[120px]">
                        <div class="w-12 h-12 bg-[#e9fbf0] text-[#008f5d] rounded-full flex items-center justify-center text-2xl font-black mb-3 group-hover:scale-110 group-hover:bg-[#008f5d] group-hover:text-white transition-all duration-300 shadow-sm">+</div>
                        <h4 class="font-extrabold text-[#003d29] text-sm">Catat Makanan Baru</h4>
                        <p class="text-[10px] text-gray-400 mt-1 font-medium group-hover:text-[#008f5d]">Tambah asupan hari ini</p>
                    </div>

                </div>
            </section>
        </div>

        <div x-show="showLogModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;" x-cloak>
            
            <div x-show="showLogModal" x-transition.opacity @click="showLogModal = false" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
            
            <div x-show="showLogModal" 
                 x-transition:enter="transition ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-8 scale-95" 
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-200" 
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100" 
                 x-transition:leave-end="opacity-0 translate-y-8 scale-95"
                 class="relative bg-white rounded-[2.5rem] shadow-2xl w-full max-w-lg overflow-hidden flex flex-col border border-gray-100">
                
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <div>
                        <h3 class="text-xl font-black text-[#003d29]">Catat Log Nutrisi</h3>
                        <p class="text-xs text-gray-400 mt-1 font-medium">Pilih metode pencatatan makananmu.</p>
                    </div>
                    <button @click="showLogModal = false" class="w-8 h-8 rounded-full bg-white border border-gray-200 text-gray-400 flex items-center justify-center font-bold hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition-colors shadow-sm">&times;</button>
                </div>

                <div class="flex border-b border-gray-100 bg-white">
                    <button @click="logTab = 'fatsecret'" :class="logTab === 'fatsecret' ? 'text-[#008f5d] border-b-2 border-[#003d29] bg-[#e9fbf0]/30' : 'text-gray-400 hover:bg-gray-50'" class="flex-1 py-4 font-black text-xs uppercase tracking-wider transition-all">
                        Cari Menu
                    </button>
                    <button @click="logTab = 'mealplan'" :class="logTab === 'mealplan' ? 'text-[#008f5d] border-b-2 border-[#003d29] bg-[#e9fbf0]/30' : 'text-gray-400 hover:bg-gray-50'" class="flex-1 py-4 font-black text-xs uppercase tracking-wider transition-all">
                        Berdasarkan Rencana Makanan
                    </button>
                </div>

                <div class="p-6 bg-white min-h-[200px]">
                    
                    <div x-show="logTab === 'fatsecret'" x-transition.opacity>
                        <form action="{{ route('fatsecret.search') }}" method="GET" class="flex flex-col gap-4">
                            <p class="text-xs text-gray-500 font-medium mb-1">Cari nutrisi makanan dari database FatSecret.</p>
                            <input type="text" name="keyword" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-800 outline-none focus:ring-4 focus:ring-[#008f5d]/20 focus:border-[#008f5d] transition-all" placeholder="Ketik nama makanan luar (misal: Sate Padang)..." required>
                            <button type="submit" class="w-full bg-[#003d29] text-white p-4 rounded-2xl font-black text-sm tracking-wide uppercase hover:bg-[#008f5d] hover:shadow-lg transition-all shadow-md">
                                Cari via API FatSecret
                            </button>
                        </form>
                    </div>

                    <div x-show="logTab === 'mealplan'" style="display: none;" x-transition.opacity>
                        <p class="text-xs text-gray-500 font-medium mb-4">Catat cepat dari menu yang sudah direncanakan hari ini.</p>
                        
                        <div class="space-y-3 max-h-[250px] overflow-y-auto custom-scrollbar pr-1">
                            
                            @forelse($todayPlans as $plan)
                            <div class="flex items-center justify-between border border-gray-100 rounded-2xl p-4 bg-gray-50/50 hover:border-[#c1ecd4] transition-all group">
                                <div>
                                    <span class="text-[8px] font-extrabold text-[#008f5d] uppercase tracking-widest block mb-0.5">
                                        Meal Plan &bull; {{ $plan->meal_type }}
                                    </span>
                                    <p class="font-black text-sm text-[#003d29]">{{ $plan->food_name }}</p>
                                    <p class="text-[10px] font-bold text-gray-400 mt-0.5">{{ number_format($plan->calories, 0) }} kcal &bull; {{ $plan->protein ?? 0 }}g Protein</p>
                                </div>
                                
                                <form action="{{ route('food.custom') }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    <input type="hidden" name="food_name" value="{{ $plan->food_name }}">
                                    <input type="hidden" name="calories" value="{{ $plan->calories }}">
                                    <input type="hidden" name="protein" value="{{ $plan->protein ?? 0 }}">
                                    <input type="hidden" name="meal_type" value="{{ $plan->meal_type }}">
                                    
                                    <button type="submit" class="bg-white border-2 border-[#003d29] text-[#003d29] w-10 h-10 rounded-full font-black text-lg group-hover:bg-[#008f5d] group-hover:text-white group-hover:border-[#008f5d] transition-all flex items-center justify-center shadow-sm" title="Catat Cepat">
                                        +
                                    </button>
                                </form>
                            </div>
                            
                            @empty
                            <div class="text-center py-8 border-2 border-dashed border-gray-200 rounded-2xl bg-gray-50">
                                <span class="text-2xl mb-2 block">📅</span>
                                <p class="text-xs font-bold text-gray-400">Kamu belum membuat rencana makan hari ini.</p>
                                <a href="{{ route('meal-plans') }}" class="text-[10px] font-black text-[#008f5d] hover:underline mt-2 inline-block">Buat Rencana Sekarang &rarr;</a>
                            </div>
                            @endforelse

                        </div>
                    </div>
                        
                    </div>
                </div>
            </div>
        </div>
        </div>
    
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { display: none; } 
        .custom-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</x-app-layout>
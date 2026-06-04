<x-app-layout>
    @php
        \Carbon\Carbon::setLocale('id');
    @endphp

    <div x-data="mealPlannerApp()" x-effect="document.body.style.overflow = isModalOpen ? 'hidden' : ''" class="py-8 bg-slate-50 min-h-screen relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- PESAN NOTIFIKASI DARI SERVER -->
            @if (session('success'))
                <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-2xl mb-6 relative shadow-sm">
                    <span class="block sm:inline font-bold">✨ {{ session('success') }}</span>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-2xl mb-6 relative shadow-sm">
                    <strong class="font-bold">Gagal menyimpan:</strong>
                    <ul class="list-disc pl-5 mt-1 text-sm font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- HEADER -->
            <header class="mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 px-4 sm:px-0">
                <div>
                    <h2 class="text-3xl font-extrabold text-[#003d29] tracking-tight mb-1">Rencana Makan Mingguan</h2>
                    <p class="text-gray-500 font-medium text-sm">Pilih tanggal dan atur menu sehatmu sendiri.</p>
                </div>
                <a href="{{ route('food.search') }}" class="bg-[#003d29] text-white px-6 py-3 rounded-full font-bold text-[11px] tracking-widest hover:bg-[#008f5d] transition-all shadow-lg hover:-translate-y-1 flex items-center gap-2">
                    <span class="text-lg leading-none">+</span> CARI RESEP SISTEM
                </a>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4 sm:px-0">
                
                <!-- KIRI: Kalender & Jadwal Makan -->
                <div class="md:col-span-2 flex flex-col gap-8">
                    
                    <!-- 1. TAB KALENDER -->
                    <section>
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-[#003d29]">Pilih Tanggal</h3>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('meal-plans', ['date' => $prevWeek]) }}" class="w-8 h-8 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-[#e9fbf0] hover:border-[#008f5d] hover:text-[#008f5d] transition-all shadow-sm font-bold">&larr;</a>
                                <span class="text-xs font-extrabold tracking-widest text-[#003d29] uppercase">
                                    {{ $startOfWeek->translatedFormat('F Y') }}
                                </span>
                                <a href="{{ route('meal-plans', ['date' => $nextWeek]) }}" class="w-8 h-8 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-[#e9fbf0] hover:border-[#008f5d] hover:text-[#008f5d] transition-all shadow-sm font-bold">&rarr;</a>
                            </div>
                        </div>
                        
                        <div class="flex gap-4 overflow-x-auto pb-4 custom-scrollbar">
                            @foreach($weekDates as $date)
                                @php
                                    $dateStr = $date->format('Y-m-d');
                                    $isToday = $date->isToday();
                                @endphp
                                
                                <div @click="activeDate = '{{ $dateStr }}'" 
                                     :class="activeDate === '{{ $dateStr }}' ? 'bg-[#003d29] text-white shadow-xl scale-105' : 'bg-white text-[#003d29] shadow-sm border border-gray-100 hover:border-[#008f5d]'"
                                     class="rounded-[2rem] p-4 flex flex-col items-center justify-between h-40 w-20 flex-shrink-0 cursor-pointer transition-all duration-300">
                                    <span class="text-[10px] font-bold tracking-widest uppercase mt-2" :class="activeDate === '{{ $dateStr }}' ? 'opacity-80 text-white' : 'text-gray-400'">
                                        {{ $date->translatedFormat('D') }}
                                    </span>
                                    <span class="text-3xl font-extrabold" :class="activeDate === '{{ $dateStr }}' ? 'text-white' : 'text-[#003d29]'">
                                        {{ $date->format('d') }}
                                    </span>
                                    <div class="flex gap-1 mb-2">
                                        <div class="w-1.5 h-1.5 rounded-full transition-colors" :class="activeDate === '{{ $dateStr }}' ? 'bg-[#00e676]' : 'bg-gray-200'"></div>
                                        @if($isToday)
                                            <div class="w-1.5 h-1.5 rounded-full transition-colors" :class="activeDate === '{{ $dateStr }}' ? 'bg-[#00e676]' : 'bg-gray-200'"></div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- 2. JADWAL MAKAN INTERAKTIF -->
                    <section class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-50 rounded-full blur-3xl -z-10 opacity-60"></div>

                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 bg-[#e9fbf0] rounded-full flex items-center justify-center text-2xl shadow-sm">🍽️</div>
                            <h3 class="text-2xl font-black text-[#003d29]">
                                Menu <span x-text="dateLabels[activeDate] || activeDate"></span>
                            </h3>
                        </div>

                        <div class="space-y-8">
                            <template x-for="cat in mealCategories" :key="cat.id">
                                <div>
                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="text-lg" x-text="cat.icon"></span>
                                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-widest" x-text="cat.id"></h4>
                                    </div>
                                    
                                    <template x-if="!plans[activeDate][cat.id]">
                                        <button @click="openRecipeSelector(cat.id)" class="w-full relative overflow-hidden rounded-3xl border-2 border-dashed border-gray-200 bg-gray-50/50 p-6 flex flex-col items-center justify-center text-gray-400 hover:bg-[#e9fbf0] hover:border-[#008f5d] hover:text-[#008f5d] transition-all duration-300 group">
                                            <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 group-hover:bg-[#008f5d] group-hover:text-white transition-all duration-300">
                                                <span class="text-2xl font-bold">+</span>
                                            </div>
                                            <span class="text-[11px] font-extrabold tracking-widest uppercase" x-text="'Tambah ' + cat.id"></span>
                                        </button>
                                    </template>

                                    <template x-if="plans[activeDate][cat.id]">
                                        <div class="relative bg-white rounded-3xl p-4 flex gap-5 items-center shadow-md border border-gray-100 group hover:shadow-xl hover:border-[#008f5d] transition-all duration-300 cursor-pointer" @click="openRecipeDetails(plans[activeDate][cat.id])">
                                            <div class="relative w-28 h-28 rounded-2xl overflow-hidden flex-shrink-0 shadow-sm">
                                                <img :src="plans[activeDate][cat.id].image" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                            </div>
                                            <div class="flex-1 pr-10">
                                                <h5 class="text-lg font-black text-[#003d29] mb-2 leading-tight" x-text="plans[activeDate][cat.id].title"></h5>
                                                <div class="flex flex-wrap gap-2 text-[10px] font-bold uppercase tracking-wider">
                                                    <span class="bg-gray-100 text-gray-600 px-3 py-1.5 rounded-lg" x-text="plans[activeDate][cat.id].cal + ' kkal'"></span>
                                                    <span class="bg-[#e9fbf0] text-[#008f5d] px-3 py-1.5 rounded-lg" x-text="plans[activeDate][cat.id].protein + 'g Pro'"></span>
                                                </div>
                                            </div>
                                            <form x-bind:action="'/meal-plans/' + plans[activeDate][cat.id].id" method="POST" @click.stop class="absolute right-4 w-10 h-10 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                @csrf
                                                    @method('DELETE')
                                            <button type="submit" class="w-full h-full rounded-full bg-red-50 text-red-500 flex items-center justify-center hover:bg-red-500 hover:text-white shadow-sm" title="Hapus Menu">
                                                <span class="text-xl font-bold leading-none">&times;</span>
                                            </button>
                                        </form>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </section>
                </div>

                <!-- KANAN: Kalkulasi Lengkap & Kebiasaan -->
                <div class="md:col-span-1">
                    <div class="bg-[#e9fbf0] rounded-[2.5rem] p-8 h-full relative shadow-sm border border-[#c9e8d6]">
                        <h3 class="text-xl font-black text-[#003d29] mb-8">Kalkulasi <span x-text="dateLabels[activeDate] || activeDate"></span></h3>
                        
                        <!-- Kalori -->
                        <div class="mb-6">
                            <div class="flex justify-between items-end mb-2">
                                <span class="text-[10px] font-bold tracking-widest text-gray-500 uppercase leading-tight">TOTAL<br>KALORI</span>
                                <span class="text-[15px] font-black text-[#003d29]"><span x-text="getDailyTotal('cal')"></span> <span class="text-xs font-bold text-gray-400">/ 2000</span></span>
                            </div>
                            <div class="h-2 w-full bg-[#c9e8d6] rounded-full overflow-hidden">
                                <div class="h-full bg-[#003d29] rounded-full transition-all duration-1000" :style="'width: ' + Math.min(100, (getDailyTotal('cal') / 2000) * 100) + '%'"></div>
                            </div>
                        </div>
                        
                        <!-- Protein -->
                        <div class="mb-8 pb-8 border-b border-[#c9e8d6]">
                            <div class="flex justify-between items-end mb-2">
                                <span class="text-[10px] font-bold tracking-widest text-gray-500 uppercase">PROTEIN</span>
                                <span class="text-[15px] font-black text-[#003d29]"><span x-text="getDailyTotal('protein')"></span>g <span class="text-xs font-bold text-gray-400">/ 120g</span></span>
                            </div>
                            <div class="h-2 w-full bg-[#c9e8d6] rounded-full overflow-hidden">
                                <div class="h-full bg-[#008f5d] rounded-full transition-all duration-1000" :style="'width: ' + Math.min(100, (getDailyTotal('protein') / 120) * 100) + '%'"></div>
                            </div>
                        </div>

                        <!-- Makronutrien Tambahan -->
                        <div class="mb-10">
                            <h4 class="text-[10px] font-bold tracking-widest text-[#003d29] uppercase mb-5">Distribusi Makro</h4>
                            
                            <div class="space-y-5">
                                <div>
                                    <div class="flex justify-between text-[10px] font-bold text-gray-500 mb-1.5">
                                        <span>KARBOHIDRAT</span>
                                        <span><span x-text="getDailyTotal('carbs')"></span>g <span class="text-gray-400">/ 250g</span></span>
                                    </div>
                                    <div class="h-1.5 w-full bg-[#c9e8d6] rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-500 rounded-full transition-all duration-1000" :style="'width: ' + Math.min(100, (getDailyTotal('carbs') / 250) * 100) + '%'"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-[10px] font-bold text-gray-500 mb-1.5">
                                        <span>LEMAK</span>
                                        <span><span x-text="getDailyTotal('fat')"></span>g <span class="text-gray-400">/ 60g</span></span>
                                    </div>
                                    <div class="h-1.5 w-full bg-[#c9e8d6] rounded-full overflow-hidden">
                                        <div class="h-full bg-rose-500 rounded-full transition-all duration-1000" :style="'width: ' + Math.min(100, (getDailyTotal('fat') / 60) * 100) + '%'"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white/60 p-5 rounded-2xl border border-white mt-10">
                            <span class="text-[10px] font-bold tracking-widest text-[#008f5d] uppercase block mb-3">PENGINGAT HIDRASI</span>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center text-xl">💧</div>
                                <div>
                                    <p class="text-sm font-bold text-[#003d29]">Minum 3 Liter Air</p>
                                    <p class="text-[10px] text-gray-500 font-bold mt-0.5">Jaga fokus saat ngoding!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- ========================================== -->
        <!-- MODAL PILIH RESEP -->
        <!-- ========================================== -->
        <div x-show="isModalOpen" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
            <div x-show="isModalOpen" @click="isModalOpen = false" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

            <div x-show="isModalOpen" x-transition class="relative bg-white rounded-[2rem] shadow-2xl w-full max-w-lg max-h-[85vh] flex flex-col overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                    <div>
                        <h2 class="text-xl font-black text-[#003d29]">Pilih <span x-text="activeCategory"></span></h2>
                        <p class="text-xs text-gray-500 font-medium mt-1">Rekomendasi makro yang seimbang untukmu.</p>
                    </div>
                    <button @click="isModalOpen = false" class="w-8 h-8 rounded-full bg-white border border-gray-200 text-gray-500 font-bold hover:bg-gray-100 transition">&times;</button>
                </div>

                <div class="p-4 overflow-y-auto custom-scrollbar space-y-4">
                    <template x-for="recipe in systemRecipes" :key="recipe.id">
                        
                        <!-- PENTING: TOMBOL INI KINI BERUPA FORM POST KE DATABASE -->
                        <form action="{{ route('user.meal-plans.store') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <input type="hidden" name="image" :value="recipe.image">
                            <input type="hidden" name="food_name" :value="recipe.title">
                            <input type="hidden" name="calories" :value="recipe.cal">
                            <input type="hidden" name="protein" :value="recipe.protein">
                            <input type="hidden" name="meal_type" :value="activeCategory">
                            <input type="hidden" name="plan_date" :value="activeDate">
                            
                            <button type="submit" class="w-full text-left bg-white rounded-2xl p-3 flex gap-4 items-center border border-gray-100 cursor-pointer hover:border-[#008f5d] hover:shadow-lg transition-all group">
                                <img :src="recipe.image" class="w-20 h-20 rounded-xl object-cover group-hover:scale-105 transition-transform">
                                <div class="flex-1">
                                    <span class="text-[9px] font-bold text-[#008f5d] tracking-wider uppercase mb-1 block" x-text="recipe.badge"></span>
                                    <h4 class="text-sm font-black text-[#003d29] mb-1 leading-tight" x-text="recipe.title"></h4>
                                    <div class="flex gap-2 text-[9px] font-bold mt-2">
                                        <span class="bg-gray-100 px-2 py-1 rounded text-gray-600" x-text="recipe.cal + ' kkal'"></span>
                                        <span class="bg-[#e9fbf0] px-2 py-1 rounded text-[#008f5d]" x-text="recipe.protein + 'g Pro'"></span>
                                    </div>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-[#e9fbf0] text-[#008f5d] flex items-center justify-center font-bold group-hover:bg-[#008f5d] group-hover:text-white transition-colors">
                                    +
                                </div>
                            </button>
                        </form>

                    </template>
                </div>
            </div>
        </div>

    </div>

    <!-- SCRIPT ALPINE.JS -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('mealPlannerApp', () => ({
                activeDate: '{{ $selectedDate->format('Y-m-d') }}',
                isModalOpen: false,
                activeCategory: '',
                
                dateLabels: {
                    @foreach($weekDates as $date)
                        '{{ $date->format('Y-m-d') }}': '{{ $date->isToday() ? "Hari Ini" : $date->translatedFormat('l, d M') }}',
                    @endforeach
                },

                mealCategories: [
                    { id: 'Sarapan', icon: '' },
                    { id: 'Makan Siang', icon: '' },
                    { id: 'Makan Malam', icon: '' },
                    { id: 'Cemilan', icon: '' }
                ],

                plans: {},

                systemRecipes: [
                    { id: 1, title: "Oatmeal Buah Naga", badge: "SARAPAN IDEAL", cal: 380, protein: 10, carbs: 65, fat: 8, image: "https://images.unsplash.com/photo-1511690656952-34342bb7c2f2?q=80&w=800" },
                    { id: 2, title: "Quinoa Power Bowl", badge: "PLANT-BASED", cal: 450, protein: 18, carbs: 55, fat: 15, image: "https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=800" },
                    { id: 3, title: "Dada Ayam Panggang", badge: "HIGH PROTEIN", cal: 410, protein: 45, carbs: 10, fat: 12, image: "https://images.unsplash.com/photo-1532550907401-a500c9a57435?q=80&w=800" },
                    { id: 4, title: "Green Goddess Salad", badge: "RENDAH KALORI", cal: 320, protein: 12, carbs: 20, fat: 22, image: "https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=800" },
                    { id: 5, title: "Apel & Selai Kacang", badge: "CEMILAN", cal: 180, protein: 5, carbs: 25, fat: 9, image: "https://images.unsplash.com/photo-1568702846914-96b305d2aaeb?q=80&w=800" }
                ],

                init() {
                    // 1. Siapkan wadah kosong
                    @foreach($weekDates as $date)
                        this.plans['{{ $date->format('Y-m-d') }}'] = {
                            'Sarapan': null, 'Makan Siang': null, 'Makan Malam': null, 'Cemilan': null
                        };
                    @endforeach

                    // 2. INJEKSI DATA MYSQL KE DALAM ALPINE.JS
                    @if(isset($plannedFoods) && $plannedFoods->count() > 0)
                        @foreach($plannedFoods as $plan)
                            @php $formattedDate = \Carbon\Carbon::parse($plan->plan_date)->format('Y-m-d'); @endphp
                            
                            if (this.plans['{{ $formattedDate }}']) {
                                this.plans['{{ $formattedDate }}']['{{ $plan->meal_type }}'] = {
                                    id: '{{ $plan->id }}', // <--- TAMBAHKAN BARIS INI
                                    title: '{{ $plan->food_name }}',
                                    cal: {{ $plan->calories }},
                                    protein: {{ $plan->protein ?? 0 }},
                                    image: `{!! $plan->image ?? 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=800' !!}` 
                                };
                            }
                        @endforeach
                    @endif
                },

                openRecipeSelector(category) {
                    this.activeCategory = category;
                    this.isModalOpen = true;
                },

                removeRecipe(category) {
                    this.plans[this.activeDate][category] = null;
                    alert("Menu disembunyikan dari layar. Untuk menghapus permanen dari Database, fungsi rute hapusnya harus dibuat dulu ya!");
                },

                openRecipeDetails(recipe) {
                    alert("Menampilkan detail " + recipe.title);
                },

                getDailyTotal(nutrient) {
                    let total = 0;
                    let todayPlan = this.plans[this.activeDate];
                    if(todayPlan) {
                        ['Sarapan', 'Makan Siang', 'Makan Malam', 'Cemilan'].forEach(cat => {
                            if(todayPlan[cat] && todayPlan[cat][nutrient]) {
                                total += todayPlan[cat][nutrient];
                            }
                        });
                    }
                    return total;
                }
            }));
        });
    </script>
    <style>.custom-scrollbar::-webkit-scrollbar { display: none; } .custom-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }</style>
</x-app-layout>
<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <!-- HEADER -->
            <div class="mb-8 px-4 sm:px-0 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Catat Makanan 🍽️</h1>
                    <p class="text-gray-500 mt-2 text-sm font-medium">Cari dari database global atau masukkan info gizi secara manual.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 bg-indigo-50 px-4 py-2 rounded-full transition">
                    &laquo; Kembali
                </a>
            </div>

            <!-- ALERT MESSAGES (Muncul jika berhasil tambah makanan manual) -->
            @if(session('success'))
                <div class="mb-6 mx-4 sm:mx-0 bg-green-50 border border-green-200 p-4 rounded-2xl shadow-sm flex items-center">
                    <span class="text-green-500 mr-3 text-xl">✅</span>
                    <p class="text-green-700 font-bold text-sm">{{ session('success') }}</p>
                </div>
            @endif

            <!-- KARTU PENCARIAN API -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8 mb-8 mx-4 sm:mx-0">
                <form action="{{ route('food.search') }}" method="GET">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                <span class="text-gray-400 text-lg">🔍</span>
                            </div>
                            <input type="text" name="query" value="{{ request('query') }}" placeholder="Cari Nasi Goreng, Ayam Bakar, dll..." required
                                   class="w-full pl-12 pr-4 py-4 rounded-2xl border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition shadow-inner font-medium text-gray-700">
                        </div>
                        <button type="submit" class="bg-indigo-600 text-white font-bold py-4 px-8 rounded-2xl hover:bg-indigo-700 transition shadow-md whitespace-nowrap">
                            Cari Database
                        </button>
                    </div>
                </form>

                <!-- HASIL PENCARIAN API -->
                <!-- Catatan: Sesuaikan variabel $results dengan variabel yang kamu lempar dari FoodController -->
                @if(isset($results) && count($results) > 0)
                    <div class="mt-8">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Hasil Pencarian</h3>
                        <div class="space-y-3">
                            @foreach($results as $food)
                                <div class="border border-gray-100 rounded-2xl p-4 hover:border-indigo-300 hover:shadow-md transition bg-white flex flex-col sm:flex-row justify-between sm:items-center gap-4">
                                    <div>
                                        <h4 class="text-lg font-bold text-gray-800">{{ $food['food_name'] ?? $food->food_name }}</h4>
                                        <p class="text-sm text-gray-500 mt-1 flex gap-3">
                                            <span class="font-extrabold text-orange-500">{{ $food['calories'] ?? $food->calories }} kcal</span>
                                            <span>Protein: {{ $food['protein'] ?? $food->protein }}g</span>
                                            <span>Gula: {{ $food['sugar'] ?? $food->sugar }}g</span>
                                        </p>
                                    </div>
                                    <form action="{{ route('food.log') }}" method="POST" class="flex gap-2 w-full sm:w-auto">
                                        @csrf
                                        <input type="hidden" name="food_name" value="{{ $food['food_name'] ?? $food->food_name }}">
                                        <input type="hidden" name="calories" value="{{ $food['calories'] ?? $food->calories }}">
                                        <input type="hidden" name="protein" value="{{ $food['protein'] ?? $food->protein }}">
                                        <input type="hidden" name="sugar" value="{{ $food['sugar'] ?? $food->sugar }}">
                                        
                                        <select name="meal_type" class="text-sm border-gray-200 rounded-xl focus:ring-indigo-500 bg-gray-50 font-bold text-gray-600 flex-1 sm:w-auto" required>
                                            <option value="Breakfast">Breakfast</option>
                                            <option value="Lunch">Lunch</option>
                                            <option value="Dinner">Dinner</option>
                                            <option value="Snack">Snack</option>
                                        </select>
                                        <button type="submit" class="bg-indigo-100 text-indigo-700 hover:bg-indigo-600 hover:text-white font-extrabold px-4 py-2 rounded-xl transition">
                                            +
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @elseif(request()->has('query'))
                    <div class="mt-8 text-center py-8 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                        <span class="text-3xl mb-2 block">🤷‍♂️</span>
                        <p class="text-gray-500 font-medium">Hmm, makanan tidak ditemukan di database API.</p>
                        <p class="text-sm text-gray-400 mt-1">Gunakan input manual di bawah ya!</p>
                    </div>
                @endif
            </div>

            <!-- DIVIDER -->
            <div class="flex items-center justify-center my-10 mx-4 sm:mx-0">
                <div class="border-t border-gray-200 flex-grow"></div>
                <span class="px-4 text-xs font-bold text-gray-400 bg-gray-50 uppercase tracking-widest">Atau</span>
                <div class="border-t border-gray-200 flex-grow"></div>
            </div>

            <!-- KARTU INPUT MANUAL -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8 mb-8 mx-4 sm:mx-0 relative overflow-hidden">
                <!-- Aksen visual kecil di pojok -->
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-indigo-50 rounded-full opacity-50"></div>
                
                <div class="mb-8 relative z-10">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <span>✍️</span> Input Nilai Gizi Manual
                    </h2>
                    <p class="text-sm text-gray-500 mt-1 font-medium">Salin informasi nilai gizi dari belakang kemasan jajananmu.</p>
                </div>

                <form action="{{ route('food.custom') }}" method="POST" class="relative z-10">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                        
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Nama Makanan / Snack</label>
                            <input type="text" name="food_name" required placeholder="Contoh: Chitato Sapi Panggang" 
                                   class="w-full rounded-2xl border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition py-3 font-medium text-gray-700">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Waktu Konsumsi</label>
                            <select name="meal_type" required 
                                    class="w-full rounded-2xl border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition py-3 font-medium text-gray-700">
                                <option value="Breakfast">Sarapan (Breakfast)</option>
                                <option value="Lunch">Makan Siang (Lunch)</option>
                                <option value="Dinner">Makan Malam (Dinner)</option>
                                <option value="Snack" selected>Cemilan (Snack)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-orange-500 uppercase tracking-wider mb-2">Total Kalori</label>
                            <div class="relative">
                                <input type="number" step="0.1" name="calories" required placeholder="0" 
                                       class="w-full rounded-2xl border-gray-200 bg-orange-50/50 focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-transparent transition py-3 pr-12 font-bold text-gray-800">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-gray-400 font-bold text-sm">kcal</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-indigo-500 uppercase tracking-wider mb-2">Total Protein</label>
                            <div class="relative">
                                <input type="number" step="0.1" name="protein" required placeholder="0" 
                                       class="w-full rounded-2xl border-gray-200 bg-indigo-50/50 focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition py-3 pr-10 font-bold text-gray-800">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-gray-400 font-bold text-sm">g</span>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-pink-500 uppercase tracking-wider mb-2">Total Gula</label>
                            <div class="relative">
                                <input type="number" step="0.1" name="sugar" required placeholder="0" 
                                       class="w-full rounded-2xl border-gray-200 bg-pink-50/50 focus:bg-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition py-3 pr-10 font-bold text-gray-800">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-gray-400 font-bold text-sm">g</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-slate-800 text-white font-bold py-4 px-4 rounded-2xl hover:bg-slate-900 transition shadow-lg flex justify-center items-center gap-2">
                        <span class="text-xl">+</span> Simpan ke Jurnal Hari Ini
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
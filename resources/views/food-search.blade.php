<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cari Makanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="GET" action="{{ route('food.search') }}" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari makanan, misal: Telur Rebus..." value="{{ $query }}">
                        <button type="submit" class="btn btn-primary">Cari Database</button>
                    </div>
                </form>
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8 mt-8">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
            <span>🏷️</span> Input Makanan Manual
        </h2>
        <p class="text-sm text-gray-500 mt-1">Tidak menemukan makanan di pencarian? Masukkan data dari kemasan snack Anda di sini.</p>
    </div>

    <form action="{{ route('food.custom') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            
            <div class="md:col-span-2">
                <label for="food_name" class="block text-sm font-bold text-gray-700 mb-1">Nama Makanan / Snack</label>
                <input type="text" name="food_name" id="food_name" required placeholder="Contoh: Chitato Sapi Panggang" 
                       class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div class="md:col-span-2">
                <label for="meal_type" class="block text-sm font-bold text-gray-700 mb-1">Waktu Makan</label>
                <select name="meal_type" id="meal_type" required 
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="Breakfast">Sarapan (Breakfast)</option>
                    <option value="Lunch">Makan Siang (Lunch)</option>
                    <option value="Dinner">Makan Malam (Dinner)</option>
                    <option value="Snack" selected>Cemilan (Snack)</option>
                </select>
            </div>

            <div>
                <label for="calories" class="block text-sm font-bold text-gray-700 mb-1">Total Kalori (kcal)</label>
                <input type="number" step="0.1" name="calories" id="calories" required placeholder="Contoh: 150" 
                       class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="protein" class="block text-sm font-bold text-gray-700 mb-1">Protein (g)</label>
                <input type="number" step="0.1" name="protein" id="protein" required placeholder="Contoh: 5" 
                       class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="sugar" class="block text-sm font-bold text-gray-700 mb-1">Gula (g)</label>
                <input type="number" step="0.1" name="sugar" id="sugar" required placeholder="Contoh: 12" 
                       class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-xl hover:bg-indigo-700 transition shadow-md">
            + Simpan ke Jurnal Hari Ini
        </button>
    </form>
</div>

                @if($query && count($foods) > 0)
                    <h4 class="mb-3">Hasil pencarian untuk: <strong>{{ $query }}</strong></h4>
                    <div class="list-group">
                        @foreach($foods as $food)
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1">{{ $food['food_name'] }}</h5>
                                    <small class="text-muted">{{ $food['food_description'] }}</small>
                                </div>
                                <form action="{{ route('food.log') }}" method="POST" class="d-flex align-items-center gap-2">
                                 @csrf
                                <input type="hidden" name="food_name" value="{{ $food['food_name'] }}">
                                <input type="hidden" name="food_description" value="{{ $food['food_description'] }}">
    
                                <select name="meal_type" class="form-select form-select-sm" required>
                                <option value="" disabled selected>Waktu...</option>
                                <option value="breakfast">Sarapan</option>
                                <option value="lunch">Makan Siang</option>
                                <option value="dinner">Makan Malam</option>
                                <option value="snack">Cemilan</option>
    </select>
    
    <button type="submit" class="btn btn-sm btn-success fw-bold">+ Catat</button>
</form>
                            </div>
                        @endforeach
                    </div>
                @elseif($query)
                    <div class="alert alert-warning">Makanan tidak ditemukan. Coba kata kunci lain.</div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
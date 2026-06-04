<x-app-layout>
    <div class="py-8 bg-slate-50 min-h-screen selection:bg-[#008f5d] selection:text-white">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-[#008f5d] transition-colors">
                <span class="text-lg leading-none">&larr;</span> Kembali ke Dashboard
            </a>

            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-8 border-b border-gray-50 pb-6">
                    <div>
                        <h2 class="text-2xl font-black text-[#003d29]">Hasil Database FatSecret</h2>
                        <p class="text-gray-400 text-sm font-medium mt-1">Menampilkan hasil untuk: <strong class="text-[#008f5d]">"{{ $query }}"</strong></p>
                    </div>
                    <div class="w-12 h-12 bg-[#e9fbf0] rounded-2xl flex items-center justify-center text-2xl">🔍</div>
                </div>

                <div class="space-y-4">
                    @forelse($foods as $food)
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between p-5 rounded-2xl border border-gray-100 bg-gray-50/30 hover:bg-white hover:border-[#008f5d] hover:shadow-md transition-all gap-4 group">
                            <div class="flex-1">
                                <h4 class="text-base font-black text-gray-800 group-hover:text-[#003d29] transition-colors">
                                    {{ $food['food_name'] }}
                                </h4>
                                <p class="text-xs text-gray-400 mt-1 font-semibold leading-relaxed">
                                    {{ $food['food_description'] ?? 'Tidak ada rincian deskripsi makronutrisi.' }}
                                </p>
                            </div>
                            
                            <form action="{{ route('food.log') }}" method="POST" class="flex items-center gap-3 w-full sm:w-auto justify-between sm:justify-end">
                                @csrf
                                <input type="hidden" name="food_name" value="{{ $food['food_name'] }}">
                                <input type="hidden" name="food_description" value="{{ $food['food_description'] }}">
                                
                                <div class="relative">
                                    <select name="meal_type" class="bg-white border border-gray-200 rounded-xl px-3 py-2 text-xs font-bold text-gray-700 outline-none focus:border-[#008f5d] cursor-pointer shadow-sm appearance-none pr-8" required>
                                        <option value="breakfast">🌅 Sarapan</option>
                                        <option value="lunch">☀️ Makan Siang</option>
                                        <option value="dinner">🌙 Makan Malam</option>
                                        <option value="snack">🍿 Cemilan</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-2.5 flex items-center pointer-events-none text-gray-400 text-[9px]">▼</div>
                                </div>
                                
                                <button type="submit" class="bg-[#003d29] text-white px-4 py-2.5 rounded-xl font-black text-xs uppercase tracking-wider hover:bg-[#008f5d] transition-all shadow-sm flex items-center gap-1 whitespace-nowrap">
                                    + Catat
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="text-center py-16">
                            <div class="text-5xl mb-4 opacity-50">🍽️</div>
                            <h3 class="text-lg font-black text-gray-800 mb-1">Makanan Tidak Ditemukan</h3>
                            <p class="text-xs text-gray-400 font-semibold">Database FatSecret tidak menemukan hasil untuk kata kunci "{{ $query }}".</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
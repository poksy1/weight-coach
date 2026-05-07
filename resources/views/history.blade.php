<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight mb-8 px-4 sm:px-0">
                Riwayat Makanan
            </h1>

            <div class="flex justify-between items-center mb-8 bg-white p-4 rounded-3xl shadow-sm border border-gray-100 mx-4 sm:mx-0">
                <a href="{{ route('history', ['date' => $prevDate]) }}" class="px-5 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold transition">
                    &laquo; Kemarin
                </a>
                
                <div class="font-bold text-center">
                    @if($isToday)
                        <span class="text-indigo-600 block text-sm uppercase tracking-wider">Hari Ini</span>
                    @endif
                    <span class="text-gray-800 text-lg">{{ $displayDate }}</span>
                </div>

                @if(!$isToday)
                    <a href="{{ route('history', ['date' => $nextDate]) }}" class="px-5 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold transition">
                        Besok &raquo;
                    </a>
                @else
                    <span class="px-5 py-2 bg-gray-50 text-gray-300 rounded-full text-sm font-bold cursor-not-allowed">Besok &raquo;</span>
                @endif
            </div>

            @if($dailyFoods->count() > 0)
                <div class="space-y-4 px-4 sm:px-0">
                    @foreach($dailyFoods as $food)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex justify-between items-center">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-indigo-50 rounded-full flex items-center justify-center text-2xl">
                                    🍽️
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-indigo-500 uppercase tracking-wider mb-0.5">{{ $food->meal_type }}</p>
                                    <h3 class="text-lg font-bold text-gray-900">{{ $food->food_name }}</h3>
                                </div>
                            </div>
                            
                            <div class="text-right">
                                <p class="text-xl font-extrabold text-gray-800">{{ number_format($food->calories, 0) }} <span class="text-sm font-medium text-gray-400">kcal</span></p>
                                <p class="text-sm font-bold text-gray-500">{{ $food->protein }}g <span class="font-medium text-gray-400">protein</span></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="mx-4 sm:mx-0 bg-white rounded-3xl border border-dashed border-gray-300 p-10 text-center">
                    <span class="text-4xl block mb-3">📭</span>
                    <p class="text-gray-500 font-medium">Tidak ada catatan makanan pada tanggal ini.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
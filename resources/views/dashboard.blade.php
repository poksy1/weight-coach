<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-end mb-8 px-4 sm:px-0">
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    Hello, {{ explode(' ', auth()->user()->name)[0] }}!
                </h1>
                <p class="text-sm font-medium text-gray-500">
                    {{ \Carbon\Carbon::now()->translatedFormat('l, F d, Y') }}
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8 mb-8 mx-4 sm:mx-0">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-gray-800">Today's Progress</h2>
                </div>
                
                <div class="mb-8">
                    <span class="text-5xl font-extrabold text-indigo-600">{{ number_format($caloriesConsumedToday, 0) }}</span>
                    <span class="text-lg font-medium text-gray-400 ml-1">cal of {{ number_format($targetCalorie, 0) }} cal</span>
                </div>

                <div class="space-y-5">
                    @php 
                        $proteinTotal = $dailyFoods->sum('protein');
                        $proteinTarget = 100; // Standar visualisasi
                        $proteinPercent = min(100, ($proteinTotal / $proteinTarget) * 100);
                    @endphp
                    <div>
                        <div class="flex justify-between text-sm font-bold mb-1">
                            <span class="text-gray-700">Protein</span>
                            <span class="text-gray-500">{{ $proteinTotal }}g / {{ $proteinTarget }}g</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5">
                            <div class="bg-indigo-500 h-2.5 rounded-full" style="width: {{ $proteinPercent }}%"></div>
                        </div>
                    </div>

                    @php 
                        $sugarTotal = $dailyFoods->sum('sugar');
                        $sugarTarget = 50; // Batas WHO
                        $sugarPercent = min(100, ($sugarTotal / $sugarTarget) * 100);
                    @endphp
                    <div>
                        <div class="flex justify-between text-sm font-bold mb-1">
                            <span class="text-gray-700">Sugar (Gula)</span>
                            <span class="text-gray-500">{{ $sugarTotal }}g / {{ $sugarTarget }}g</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5">
                            <div class="bg-pink-500 h-2.5 rounded-full" style="width: {{ $sugarPercent }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-4 sm:px-0 mb-4 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">Today's Meals</h2>
                <a href="{{ route('food.search') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 flex items-center">
                    + Add Meal
                </a>
            </div>

            @if($dailyFoods->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 px-4 sm:px-0">
                    @foreach($dailyFoods as $food)
                        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                            <div class="h-40 bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center relative">
                                <span class="text-4xl">🍽️</span>
                                <form action="{{ route('food.destroy', $food->id) }}" method="POST" class="absolute top-3 right-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-white text-red-500 hover:bg-red-500 hover:text-white rounded-full w-8 h-8 flex items-center justify-center shadow transition">
                                        ✕
                                    </button>
                                </form>
                            </div>
                            
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <p class="text-xs font-bold text-indigo-500 uppercase tracking-wider mb-1">{{ $food->meal_type }}</p>
                                    <h3 class="text-lg font-bold text-gray-900 leading-tight mb-4">{{ $food->food_name }}</h3>
                                </div>
                                
                                <div class="flex justify-between items-end border-t border-gray-50 pt-4 mt-auto">
                                    <div>
                                        <p class="text-xl font-extrabold text-gray-800">{{ number_format($food->calories, 0) }}</p>
                                        <p class="text-xs font-medium text-gray-400">calories</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-gray-800">{{ $food->protein }}g</p>
                                        <p class="text-xs font-medium text-gray-400">protein</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="mx-4 sm:mx-0 bg-white rounded-3xl border border-dashed border-gray-300 p-10 text-center">
                    <span class="text-4xl block mb-3">🍳</span>
                    <p class="text-gray-500 font-medium">Belum ada makanan hari ini.</p>
                    <a href="{{ route('food.search') }}" class="mt-4 inline-block bg-indigo-600 text-white font-bold py-2 px-6 rounded-full hover:bg-indigo-700 transition">
                        Catat Sekarang
                    </a>
                </div>
            @endif

            <div class="mt-8 bg-blue-50 rounded-3xl p-6 mx-4 sm:mx-0 flex justify-between items-center border border-blue-100">
                <div>
                    <h3 class="font-bold text-blue-800 mb-1">Water Intake</h3>
                    <p class="text-blue-600 font-medium">{{ session('water', 0) }} ml / 2000 ml</p>
                </div>
                <form action="{{ route('water.add') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white w-12 h-12 rounded-full font-bold shadow-md text-xl flex items-center justify-center">
                        +
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
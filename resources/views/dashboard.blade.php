<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ringkasan Kesehatanmu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @php
                $todayFoods = auth()->user()->foodLogs()->whereDate('consumed_at', \Carbon\Carbon::today())->get();
                $totalSugar = $todayFoods->sum('sugar');
            @endphp

            @if($totalSugar >= 40)
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded shadow-sm" role="alert">
                    <p class="font-bold">⚠️ Peringatan Konsumsi Gula</p>
                    <p>Total gula Anda hari ini mencapai {{ $totalSugar }}g (Mendekati batas maksimal WHO 50g/hari). Kurangi makanan manis!</p>
                </div>
            @endif

            @if($remainingCalorie < 0)
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm" role="alert">
                    <p class="font-bold">🚨 Batas Kalori Terlewati</p>
                    <p>Anda telah mengonsumsi kalori melebihi target harian. Tetap aktif dan perbanyak minum air putih!</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
                    <div class="p-4 bg-blue-50 rounded-lg">
                        <h4 class="text-sm font-medium text-blue-600 uppercase">Berat Saat Ini</h4>
                        <p class="text-3xl font-bold">{{ auth()->user()->weight ?? '-' }} kg</p>
                    </div>
                    <div class="p-4 bg-green-50 rounded-lg">
                        <h4 class="text-sm font-medium text-green-600 uppercase">Fokus / Goal</h4>
                        <p class="text-xl font-bold mt-1 uppercase">{{ auth()->user()->goal ?? 'MAINTAIN' }}</p>
                    </div>
                    <div class="p-4 bg-orange-50 rounded-lg">
                        <h4 class="text-sm font-medium text-orange-600 uppercase">Terkonsumsi</h4>
                        <p class="text-3xl font-bold text-orange-600">{{ number_format($caloriesConsumedToday, 0) }}</p>
                        <p class="text-xs text-orange-500">dari {{ number_format($targetCalorie, 0) }} kkal</p>
                    </div>
                    <div class="p-4 bg-purple-50 rounded-lg">
                        <h4 class="text-sm font-medium text-purple-600 uppercase">Sisa Kalori</h4>
                        <p class="text-3xl font-bold text-purple-600">{{ number_format(max(0, $remainingCalorie), 0) }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <div class="flex justify-between text-sm font-medium text-gray-700 mb-1">
                        <span>Progress Kalori Harian</span>
                        <span>{{ round($progressPercentage) }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="h-4 rounded-full transition-all duration-500
                            @if($progressPercentage > 100) bg-red-500 
                            @elseif($progressPercentage > 85) bg-yellow-500 
                            @else bg-green-500 @endif" 
                            style="width: {{ min(100, $progressPercentage) }}%">
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex flex-wrap justify-center gap-4">
                    <a href="{{ route('food.search') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                        + Catat Makanan
                    </a>
                    
                    <form action="{{ route('water.add') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600">
                            + 250ml Gelas Air
                        </button>
                    </form>
                </div>
                
                <p class="text-center mt-4 text-blue-600 font-bold">
                    Total Air Hari Ini: {{ session('water', 0) }} ml
                </p>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-700">Riwayat Makan Hari Ini</h3>

                @if($todayFoods->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Makanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kalori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Protein</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gula</th>
                                    <th class="px-6 py-3 text-center w-32 text-xs font-medium text-red-500 uppercase">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($todayFoods as $log)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $log->food_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 uppercase">{{ $log->meal_type }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600 font-bold">{{ number_format($log->calories, 0) }} kkal</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->protein }} g</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->sugar }} g</td>
                                        <td class="px-6 py-4 text-center w-32">
                                            <form action="{{ route('food.destroy', $log->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4 text-gray-500 bg-gray-50 rounded">
                        Belum ada makanan yang dicatat hari ini. Yuk, mulai catat makananmu!
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
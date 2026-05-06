<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ringkasan Kesehatanmu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
                    <div class="p-4 bg-blue-50 rounded-lg">
                        <h4 class="text-sm font-medium text-blue-600 uppercase">Berat Saat Ini</h4>
                        <p class="text-3xl font-bold">{{ $profile->weight }} kg</p>
                    </div>
                    <div class="p-4 bg-green-50 rounded-lg">
                        <h4 class="text-sm font-medium text-green-600 uppercase">Target Berat</h4>
                        <p class="text-3xl font-bold">{{ $profile->target_weight }} kg</p>
                    </div>
                    <div class="p-4 bg-purple-50 rounded-lg">
                        <h4 class="text-sm font-medium text-purple-600 uppercase">Tinggi Badan</h4>
                        <p class="text-3xl font-bold">{{ $profile->height }} cm</p>
                    </div>
                    <div class="p-4 bg-orange-50 rounded-lg">
                        <h4 class="text-sm font-medium text-orange-600 uppercase">Kalori Hari Ini</h4>
                        <p class="text-3xl font-bold text-orange-600">{{ number_format($totalCaloriesToday, 0) }} / {{ $targetCalories }} kkal</p>
                    </div>
                </div>

                <div class="mt-8 flex justify-center gap-4">
                    <a href="{{ route('food.search') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                        + Catat Makanan
                    </a>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-700">Riwayat Makan Hari Ini</h3>
                
                @php
                    $todayFoods = auth()->user()->foodLogs()->whereDate('consumed_at', \Carbon\Carbon::today())->get();
                @endphp

                @if($todayFoods->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Makanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kalori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Protein</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Karbo/Gula</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-red-500 uppercase">Aksi</th>
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
    <td class="px-6 py-4 whitespace-nowrap text-sm">
    <form action="{{ route('food.destroy', $log->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit"
            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
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
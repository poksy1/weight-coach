<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ringkasan Kesehatanmu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
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
                </div>

                <div class="mt-8 flex justify-center gap-4">
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                        + Catat Makanan
                    </a>
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                        Catat Minum
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
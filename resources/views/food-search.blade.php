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
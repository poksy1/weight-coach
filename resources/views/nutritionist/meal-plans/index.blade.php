<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Klien • Rencana Makan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f4f7f6] text-slate-900">

@php
    $totalClients = $clients->count();

    $totalCalories = $clients->sum('calorie_target');
    $averageCalories = $totalClients > 0 ? round($clients->avg('calorie_target')) : 0;

    $totalProtein = $clients->sum('protein_target');
    $totalCarbs = $clients->sum('carb_target');
    $totalFat = $clients->sum('fat_target');
@endphp

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="fixed left-0 top-0 bottom-0 w-[245px] bg-white border-r border-slate-200 px-5 py-6 flex flex-col justify-between">

        <div>
            <div>
                <h1 class="text-2xl font-black text-emerald-800">
                    WeightCoach
                </h1>

                <p class="text-xs text-slate-500 mt-1">
                    Kesehatan Harian
                </p>
            </div>

            <nav class="mt-10 space-y-2 text-sm">

                <a href="{{ route('nutritionist.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">
                    ▦ Dashboard
                </a>

                <a href="{{ route('nutritionist.meal-plans') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-700 text-white font-bold shadow-sm">
                    🍽 Rencana Makan
                </a>

                <a href="{{ route('nutritionist.water') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">
                    ♢ Pantau Air
                </a>

                <a href="{{ route('nutritionist.progress') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">
                    ⌁ Progress
                </a>

                <a href="{{ route('nutritionist.settings') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">
                    ⚙ Pengaturan
                </a>

            </nav>
        </div>

        <button
            class="w-full py-3 rounded-xl bg-emerald-800 text-white font-black text-sm hover:bg-emerald-900 transition">
            + Catat Entri Baru
        </button>

    </aside>

    <!-- MAIN -->
    <main class="ml-[245px] flex-1">

        <!-- HEADER -->
        <header class="h-[88px] bg-white border-b border-slate-200 px-8 flex items-center justify-between">

            <div>
                <h1 class="text-2xl font-black text-emerald-900">
                    Rencana Makan Klien
                </h1>

                <p class="text-xs text-slate-400 mt-1">
                    Pilih klien untuk mengelola rencana makan berdasarkan target nutrisi harian.
                </p>
            </div>

            <div class="flex items-center gap-5">
                <button class="text-slate-500 hover:text-emerald-700 transition">
                    🔔
                </button>

                <div class="w-11 h-11 rounded-full bg-slate-100 border border-slate-200"></div>
            </div>

        </header>

        <!-- CONTENT -->
        <div class="p-8">

            <!-- SUMMARY -->
<div class="grid grid-cols-4 gap-5 mb-8">

    <!-- Total Klien -->
    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">

        <p class="text-sm text-slate-500">
            Total Klien
        </p>

        <h2 class="text-5xl font-black text-emerald-800 mt-5">
            {{ $totalClients }}
        </h2>

    </div>

    <!-- Rencana Aktif -->
    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">

        <p class="text-sm text-slate-500">
            Rencana Aktif
        </p>

        <h2 class="text-5xl font-black text-blue-700 mt-5">
            {{ $totalClients }}
        </h2>

    </div>

    <!-- Rata-rata -->
    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">

        <p class="text-sm text-slate-500">
            Rata-rata Kalori
        </p>

        <h2 class="text-5xl font-black text-orange-600 mt-5">
            {{ number_format($averageCalories) }}
        </h2>

    </div>

    <!-- Target Tertinggi -->
    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">

        <p class="text-sm text-slate-500">
            Target Tertinggi
        </p>

        <h2 class="text-5xl font-black text-purple-700 mt-5">
            {{ number_format($clients->max('calorie_target')) }}
        </h2>

    </div>

</div>

            <!-- SEARCH -->
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 mb-8">

                <div class="flex items-center gap-4">

                    <input
                        id="clientSearch"
                        type="text"
                        placeholder="Cari nama klien..."
                        class="flex-1 rounded-2xl border border-slate-200 px-5 py-4 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-emerald-200">

                    <button
                        type="button"
                        onclick="searchClient()"
                        class="px-6 py-4 rounded-2xl bg-emerald-700 text-white font-bold hover:bg-emerald-800 transition">
                        Cari
                    </button>

                </div>

                <p id="emptySearchText"
                   class="hidden text-sm text-red-500 font-bold mt-4">
                    Klien tidak ditemukan.
                </p>

            </div>

            @if($clients->count() === 0)

                <!-- EMPTY -->
                <div class="bg-white rounded-3xl border border-dashed border-slate-300 p-20 text-center">

                    <div class="text-7xl mb-6">
                        🍽
                    </div>

                    <h2 class="text-3xl font-black text-slate-800">
                        Belum Ada Klien
                    </h2>

                    <p class="text-slate-500 mt-3">
                        Tambahkan klien terlebih dahulu untuk membuat rencana makan.
                    </p>

                </div>

            @else

                <!-- CLIENT GRID -->
                <div id="clientGrid" class="grid grid-cols-3 gap-6">

                    @foreach($clients as $client)

                        <a
                            href="{{ route('nutritionist.clients.meal-plans', $client->slug) }}"
                            data-client-name="{{ strtolower($client->name) }}"
                            class="client-card bg-white rounded-[32px] border border-slate-200 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition overflow-hidden">

                            <!-- CARD HEADER -->
                            <div class="h-32 bg-gradient-to-r from-emerald-700 to-emerald-500 relative">

                                <div class="absolute left-7 bottom-0 translate-y-1/2">

                                    <div class="w-20 h-20 rounded-3xl bg-white border-4 border-white shadow-lg flex items-center justify-center text-2xl font-black text-emerald-700">
                                        {{ strtoupper(substr($client->name, 0, 1)) }}
                                    </div>

                                </div>

                                <div class="absolute right-6 top-6 bg-white/20 backdrop-blur text-white px-4 py-2 rounded-full text-xs font-black">
                                    TARGET HARIAN
                                </div>

                            </div>

                            <!-- CARD CONTENT -->
                            <div class="pt-16 px-7 pb-7">

                                <h2 class="text-2xl font-black text-slate-900 leading-tight">
                                    {{ $client->name }}
                                </h2>

                                <p class="text-sm text-slate-400 mt-1">
                                    Target nutrisi yang harus dipenuhi melalui rencana makan.
                                </p>

                                <!-- TARGET LIST -->
                                <div class="mt-7 grid grid-cols-2 gap-4">

                                    <div class="rounded-2xl bg-emerald-50 p-4">
                                        <p class="text-xs text-emerald-700 font-bold uppercase">
                                            Target Kalori
                                        </p>

                                        <h3 class="text-2xl font-black text-emerald-900 mt-2">
                                            {{ number_format($client->calorie_target) }}
                                        </h3>

                                        <p class="text-xs text-slate-500 mt-1">
                                            kkal / hari
                                        </p>
                                    </div>

                                    <div class="rounded-2xl bg-blue-50 p-4">
                                        <p class="text-xs text-blue-700 font-bold uppercase">
                                            Target Protein
                                        </p>

                                        <h3 class="text-2xl font-black text-blue-900 mt-2">
                                            {{ $client->protein_target }}g
                                        </h3>

                                        <p class="text-xs text-slate-500 mt-1">
                                            per hari
                                        </p>
                                    </div>

                                    <div class="rounded-2xl bg-orange-50 p-4">
                                        <p class="text-xs text-orange-700 font-bold uppercase">
                                            Target Karbo
                                        </p>

                                        <h3 class="text-2xl font-black text-orange-900 mt-2">
                                            {{ $client->carb_target }}g
                                        </h3>

                                        <p class="text-xs text-slate-500 mt-1">
                                            per hari
                                        </p>
                                    </div>

                                    <div class="rounded-2xl bg-yellow-50 p-4">
                                        <p class="text-xs text-yellow-700 font-bold uppercase">
                                            Target Lemak
                                        </p>

                                        <h3 class="text-2xl font-black text-yellow-900 mt-2">
                                            {{ $client->fat_target }}g
                                        </h3>

                                        <p class="text-xs text-slate-500 mt-1">
                                            per hari
                                        </p>
                                    </div>

                                </div>

                                <!-- INFO -->
                                <div class="mt-6 rounded-2xl bg-slate-50 border border-slate-100 p-4">

                                    <p class="text-sm text-slate-600 leading-6">
                                        Halaman ini menampilkan <strong>target nutrisi</strong>.
                                        Progress pemenuhan makanan akan terlihat setelah membuka rencana makan klien.
                                    </p>

                                </div>

                                <!-- ACTION -->
                                <div class="mt-7">

                                    <div class="w-full rounded-2xl bg-emerald-700 text-white py-4 font-black text-center hover:bg-emerald-800 transition">
                                        Buka Rencana Makan →
                                    </div>

                                </div>

                            </div>

                        </a>

                    @endforeach

                </div>

            @endif

        </div>

    </main>

</div>

<script>
const searchInput = document.getElementById('clientSearch');
const emptySearchText = document.getElementById('emptySearchText');

function searchClient()
{
    const keyword = searchInput.value.toLowerCase();
    const cards = document.querySelectorAll('.client-card');

    let visibleCount = 0;

    cards.forEach(card => {
        const name = card.dataset.clientName;

        if (name.includes(keyword)) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    if (visibleCount === 0) {
        emptySearchText.classList.remove('hidden');
    } else {
        emptySearchText.classList.add('hidden');
    }
}

searchInput.addEventListener('keyup', searchClient);
</script>

</body>
</html>
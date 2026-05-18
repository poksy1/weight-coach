<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rencana Makan - {{ $client->name }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-[#f4f7f6] text-slate-900">

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
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50">
                    ▦ Dashboard
                </a>

                <a href="{{ route('nutritionist.clients.meal-plans', $client->slug) }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-700 text-white font-bold">
                    🍽 Rencana Makan
                </a>

                <a href="{{ route('nutritionist.water') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50">
                    ♢ Pantau Air
                </a>

                <a href="{{ route('nutritionist.progress') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50">
                    ⌁ Progress
                </a>

                <a href="{{ route('nutritionist.settings') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50">
                    ⚙ Pengaturan
                </a>

            </nav>

        </div>

        <button
            class="w-full py-3 rounded-xl bg-emerald-800 text-white font-black text-sm">

            + Catat Entri Baru

        </button>

    </aside>

    <!-- CONTENT -->
    <main class="ml-[245px] flex-1">

        <!-- HEADER -->
        <header class="h-[88px] bg-white border-b border-slate-200 px-8 flex items-center justify-between">

            <div>

                <h1 class="text-2xl font-black text-emerald-900">
                    WeightCoach
                </h1>

                <p class="text-xs text-slate-400 mt-1">
                    Penyusun Rencana Makan • {{ $client->name }}
                </p>

            </div>

            <div class="flex items-center gap-5">

                <span class="text-slate-500">📅</span>
                <span class="text-slate-500">🔔</span>

                <div class="w-11 h-11 rounded-full bg-slate-100"></div>

            </div>

        </header>

        <div class="px-8 py-8">

            @if(session('success'))

                <div class="mb-6 bg-emerald-100 text-emerald-800 px-5 py-4 rounded-2xl font-bold">
                    {{ session('success') }}
                </div>

            @endif
            @if(session('error'))
    <div class="mb-6 bg-red-100 text-red-700 px-5 py-4 rounded-2xl font-bold">
        {{ session('error') }}
    </div>
@endif
            <!-- TOP BAR -->
            <div class="mb-7 bg-blue-50 border-y border-blue-100 px-5 py-3 flex items-center gap-8 text-sm">

                <span class="font-black text-emerald-800">
                    ▣ Penyusun Rencana Makan
                </span>

                <span class="text-slate-600">
                    Draf: Klien_{{ str_replace(' ', '_', $client->name) }}_Q3
                </span>

            </div>

            <!-- MAIN GRID -->
            <div class="grid grid-cols-12 gap-6 items-start">

                <!-- LEFT -->
                <section class="col-span-3 space-y-6">

                    <!-- TARGET -->
                    <div class="bg-white rounded-3xl p-7 border border-slate-200 shadow-sm">

                        <div class="flex items-center justify-between">

                            <h2 class="text-xl font-black text-emerald-900">
                                Target Makro
                            </h2>

                            <span class="text-slate-400">☷</span>

                        </div>

                        <p class="text-slate-500 mt-7">
                            Kalori Harian
                        </p>

                        <div class="flex items-end gap-3 mt-2">

                            <h3 class="text-[52px] leading-none font-black text-emerald-800">
                                {{ $client->calorie_target }}
                            </h3>

                            <span class="text-slate-500 mb-2">
                                kkal
                            </span>

                        </div>

                        <div class="grid grid-cols-3 gap-2 mt-8 text-center text-sm">

                            <div>

                                <p class="text-slate-500 mb-2">
                                    Protein
                                </p>

                                <div class="bg-emerald-50 text-emerald-700 rounded-xl py-2 font-black">
                                    {{ $client->protein_target }}g
                                </div>

                            </div>

                            <div>

                                <p class="text-slate-500 mb-2">
                                    Karbo
                                </p>

                                <div class="bg-blue-50 text-blue-700 rounded-xl py-2 font-black">
                                    {{ $client->carb_target }}g
                                </div>

                            </div>

                            <div>

                                <p class="text-slate-500 mb-2">
                                    Lemak
                                </p>

                                <div class="bg-yellow-50 text-yellow-700 rounded-xl py-2 font-black">
                                    {{ $client->fat_target }}g
                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- RECIPE -->
                    <div class="bg-white rounded-3xl p-7 border border-slate-200 shadow-sm h-[770px] flex flex-col">

                        <h2 class="text-xl font-black text-emerald-900">
                            Daftar Resep
                        </h2>

                        <input
                            type="text"
                            placeholder="Cari makanan sehat..."
                            class="mt-6 w-full rounded-full border-0 bg-slate-100 px-5 py-3 text-sm">

                        <div class="flex gap-2 mt-5 text-xs">

                            <span class="bg-emerald-700 text-white px-4 py-2 rounded-full font-bold">
                                Protein Tinggi
                            </span>

                            <span class="bg-slate-100 text-slate-600 px-4 py-2 rounded-full font-bold">
                                Vegan
                            </span>

                        </div>

                        <!-- SCROLL -->
                        <div class="mt-7 space-y-5 overflow-y-auto pr-2 flex-1">

                            @foreach ([
                                ['name' => 'Quinoa Bowl', 'cal' => '420', 'protein' => '28', 'color' => 'bg-emerald-100'],
                                ['name' => 'Salmon Panggang', 'cal' => '380', 'protein' => '35', 'color' => 'bg-orange-100'],
                                ['name' => 'Oat Pisang', 'cal' => '310', 'protein' => '12', 'color' => 'bg-blue-100'],
                                ['name' => 'Greek Yogurt', 'cal' => '220', 'protein' => '18', 'color' => 'bg-pink-100'],
                                ['name' => 'Chicken Salad', 'cal' => '340', 'protein' => '30', 'color' => 'bg-lime-100'],
                                ['name' => 'Nasi Ayam', 'cal' => '510', 'protein' => '40', 'color' => 'bg-yellow-100'],
                                ['name' => 'Smoothie Berry', 'cal' => '260', 'protein' => '15', 'color' => 'bg-purple-100'],
                                ['name' => 'Avocado Toast', 'cal' => '290', 'protein' => '10', 'color' => 'bg-teal-100'],
                                ['name' => 'Wrap Tuna', 'cal' => '330', 'protein' => '26', 'color' => 'bg-cyan-100'],
                                ['name' => 'Smoothie Pisang', 'cal' => '210', 'protein' => '9', 'color' => 'bg-amber-100'],
                            ] as $recipe)

                                <button
                                    type="button"
                                    data-recipe-card
                                    onclick="fillMealForm(
                                        '{{ $recipe['name'] }}',
                                        '{{ $recipe['cal'] }}'
                                    )"
    class="w-full flex items-center gap-4 border-2 border-transparent hover:bg-slate-50 rounded-2xl p-2 transition">

    <div class="w-16 h-16 rounded-2xl {{ $recipe['color'] }}"></div>

    <div class="flex-1 text-left">

        <h3 class="font-black leading-tight">
            {{ $recipe['name'] }}
        </h3>

        <p class="text-sm text-slate-500">
            {{ $recipe['cal'] }} kkal
        </p>

        <p class="text-sm text-slate-500">
            {{ $recipe['protein'] }}g Protein
        </p>

    </div>

    <span class="text-slate-400 hover:text-emerald-700">
        ☰
    </span>

</button>


                            @endforeach

                        </div>

                    </div>

                </section>

                <!-- CENTER -->
                <section class="col-span-6 bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

                    <!-- TOP -->
                    <div class="px-7 py-6 border-b border-slate-200 flex items-center justify-between">

                        <div>

                            <h2 class="text-2xl font-black text-emerald-900">
                                Rencana Makan 7 Hari
                            </h2>

                            <p class="text-xs text-slate-400 mt-1">
                                Klik tambah untuk mengisi menu klien
                            </p>

                        </div>

                        <div class="flex gap-5 text-2xl">

                            <button>‹</button>
                            <button>›</button>

                        </div>

                    </div>

                    <!-- FORM -->
                    <div class="px-7 py-6 border-b border-slate-100 bg-slate-50">

                        <form
                            method="POST"
                            action="{{ route('nutritionist.clients.meal-plans.store', $client->slug) }}"
                            class="grid grid-cols-5 gap-3">

                            @csrf

                            <select
                                name="day"
                                class="rounded-xl border-slate-200 text-sm">

                                <option>Senin</option>
                                <option>Selasa</option>
                                <option>Rabu</option>

                            </select>

                            <select
                                name="meal_type"
                                class="rounded-xl border-slate-200 text-sm">

                                <option>Sarapan</option>
                                <option>Makan Siang</option>
                                <option>Makan Malam</option>
                                <option>Camilan</option>

                            </select>

                            <input
                            id="mealNameInput"
                            type="text"
                            name="meal_name"
                            placeholder="Nama makanan"
                            class="rounded-xl border-slate-200 text-sm">

                            <input
                            id="calorieInput"
                                type="number"
                                name="calories"
                                placeholder="kkal"
                                class="rounded-xl border-slate-200 text-sm">

                            <button
                                type="submit"
                                class="rounded-xl bg-emerald-800 text-white font-black text-sm">

                                Tambah

                            </button>

                        </form>

                    </div>

                    @php

                        $days = [
                            'Senin',
                            'Selasa',
                            'Rabu',
                        ];

                        $mealTypes = [
                            'Sarapan',
                            'Makan Siang',
                            'Makan Malam',
                            'Camilan',
                        ];

                    @endphp

                    <!-- PLANNER -->
                    <div class="p-7">

                        <!-- DAYS -->
                        <div class="grid grid-cols-3 gap-5 mb-6 text-center">

                            @foreach ($days as $day)

                                <div>

                                    <h3 class="text-2xl font-black text-emerald-900">
                                        {{ strtoupper(substr($day, 0, 3)) }}
                                    </h3>

                                    <p class="text-sm text-slate-400 mt-1">
                                        {{ $loop->iteration + 13 }} Okt
                                    </p>

                                    <div class="h-[2px] mt-4 {{ $loop->first ? 'bg-emerald-700' : 'bg-transparent' }}"></div>

                                </div>

                            @endforeach

                        </div>

                        <!-- GRID -->
                        <div class="grid grid-cols-3 gap-5">

                            @foreach ($mealTypes as $mealType)

                                @foreach ($days as $day)

                                    @php
                                        $meal = $mealPlans
                                            ->where('day', $day)
                                            ->where('meal_type', $mealType)
                                            ->first();
                                    @endphp

                                    @if ($meal)

                                        <div class="min-h-[170px] rounded-3xl border border-slate-200 bg-slate-50 p-5 flex flex-col justify-between">

                                            <div>

                                                <p class="text-xs uppercase tracking-wide text-slate-400 font-bold">
                                                    {{ $mealType }}
                                                </p>

                                                <h4 class="font-black text-2xl text-slate-900 mt-3 leading-tight">
                                                    {{ $meal->meal_name }}
                                                </h4>

                                            </div>

                                            <div class="flex items-center justify-between mt-6">

                                                <p class="text-xl text-slate-500">
                                                    {{ $meal->calories }} kkal
                                                </p>

                                                <div class="flex items-center gap-4">

                                                    <button
                                                        onclick="openEditModal('{{ $meal->id }}', '{{ $meal->meal_name }}', '{{ $meal->calories }}')"
                                                        class="text-blue-600 text-sm font-bold hover:underline">

                                                        Edit

                                                    </button>

                                                    <form
                                                        method="POST"
                                                        action="{{ route('nutritionist.clients.meal-plans.destroy', [$client->slug, $meal->id]) }}">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="text-red-500 text-sm font-bold hover:underline">

                                                            Hapus

                                                        </button>

                                                    </form>

                                                </div>

                                            </div>

                                        </div>

                                    @else

                                        <button
                                            class="min-h-[170px] rounded-3xl border border-dashed border-slate-300 bg-white text-slate-300 text-4xl flex items-center justify-center hover:bg-slate-50">

                                            +

                                        </button>

                                    @endif

                                @endforeach

                            @endforeach

                        </div>

                    </div>

                </section>
    @php
    $totalCalories = $mealPlans->sum('calories');

    $caloriePercent = $client->calorie_target > 0
        ? min(($totalCalories / $client->calorie_target) * 100, 100)
        : 0;
@endphp

<!-- RIGHT -->
<section class="col-span-3 space-y-6 self-start">

    <!-- MACRO -->
<div class="bg-white rounded-3xl p-7 border border-slate-200 shadow-sm">

    <div class="flex justify-between items-start">
        <h2 class="text-xl font-black text-emerald-900">
            Makro Real-time
        </h2>

        <span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full text-xs font-black">
            LIVE
        </span>
    </div>

    <div class="h-[220px] mt-5">
        <canvas id="macroChart"></canvas>
    </div>

    <div class="text-center mt-5">
        <p class="text-[44px] font-black text-emerald-800">
            {{ $totalCalories }}
        </p>

        <p class="text-xs font-bold text-slate-400 uppercase">
            kkal total
        </p>
    </div>

    <div class="mt-6">
        <div class="flex justify-between font-bold">
            <span>Total Kalori</span>
            <span>{{ $totalCalories }} / {{ $client->calorie_target }} kkal</span>
        </div>

        <div class="h-2 bg-slate-100 rounded-full mt-2">
            <div
                class="h-2 bg-emerald-700 rounded-full"
                style="width: {{ $caloriePercent }}%">
            </div>
        </div>
    </div>

    <div class="space-y-4 mt-6 pt-6 border-t border-slate-100">

        <div>
            <div class="flex justify-between font-bold">
                <span>Protein</span>
                <span>40g / {{ $client->protein_target }}g</span>
            </div>

            <div class="h-2 bg-slate-100 rounded-full mt-2">
                <div class="h-2 bg-emerald-700 rounded-full w-[40%]"></div>
            </div>
        </div>

        <div>
            <div class="flex justify-between font-bold">
                <span>Karbo</span>
                <span>65g / {{ $client->carb_target }}g</span>
            </div>

            <div class="h-2 bg-slate-100 rounded-full mt-2">
                <div class="h-2 bg-blue-600 rounded-full w-[55%]"></div>
            </div>
        </div>

        <div>
            <div class="flex justify-between font-bold">
                <span>Lemak</span>
                <span>18g / {{ $client->fat_target }}g</span>
            </div>

            <div class="h-2 bg-slate-100 rounded-full mt-2">
                <div class="h-2 bg-yellow-500 rounded-full w-[30%]"></div>
            </div>
        </div>

    </div>

</div>
    <!-- GOALS -->
    <div class="bg-white rounded-3xl p-7 border border-slate-200 shadow-sm">

        <p class="text-xs uppercase tracking-widest text-slate-400 font-black">
            Kesesuaian Target Klien
        </p>

        <div class="space-y-5 mt-6 text-sm">

            <div class="flex gap-3">

                <span class="text-emerald-600">✅</span>

                <p class="font-bold text-slate-700">
                    Target protein tinggi mulai terpenuhi
                </p>

            </div>

            <div class="flex gap-3">

                <span class="text-slate-500">ⓘ</span>

                <p class="text-slate-600">
                    Tambahkan 15g lemak sehat untuk mencapai target
                </p>

            </div>

            <div class="flex gap-3">

                <span class="text-slate-500">⇩</span>

                <p class="text-slate-600">
                    Ekspor PDF tersedia di tahap berikutnya
                </p>

            </div>

        </div>

        <form method="POST"
      action="{{ route('nutritionist.clients.meal-plans.share', $client->slug) }}">

    @csrf

    <button
        type="submit"
        onclick="return confirm('Selesaikan dan bagikan rencana makan ini ke klien?')"
        class="w-full mt-7 py-4 rounded-2xl bg-emerald-800 text-white font-black">

        ▶ Selesaikan & Bagikan

    </button>

</form>

    </div>

</section>

</div>

</main>
<!-- EDIT MODAL -->
<div id="editModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-3xl p-8 w-full max-w-md">

        <h2 class="text-2xl font-black mb-6">
            Edit Makanan
        </h2>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-4">

                <div>
                    <label class="text-sm font-bold text-slate-600">
                        Nama Makanan
                    </label>

                    <input
                        type="text"
                        name="meal_name"
                        id="editMealName"
                        class="w-full mt-2 rounded-xl border border-slate-200 px-4 py-3">
                </div>

                <div>
                    <label class="text-sm font-bold text-slate-600">
                        Kalori
                    </label>

                    <input
                        type="number"
                        name="calories"
                        id="editCalories"
                        class="w-full mt-2 rounded-xl border border-slate-200 px-4 py-3">
                </div>

            </div>

            <div class="flex justify-end gap-3 mt-8">

                <button
                    type="button"
                    onclick="closeEditModal()"
                    class="px-5 py-3 rounded-xl bg-slate-100 font-bold">
                    Batal
                </button>

                <button
                    type="submit"
                    class="px-5 py-3 rounded-xl bg-emerald-700 text-white font-bold">
                    Simpan
                </button>

            </div>

        </form>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('macroChart');

new Chart(ctx, {
    type: 'doughnut',

    data: {

        labels: [
            'Protein',
            'Karbo',
            'Lemak'
        ],

        datasets: [{

            data: [
                30,
                50,
                20
            ],

            backgroundColor: [
                '#047857',
                '#2563eb',
                '#eab308'
            ],

            borderWidth: 0

        }]
    },

    options: {

        responsive: true,
        maintainAspectRatio: false,

        plugins: {

            legend: {
                display: false
            }

        },

        cutout: '72%'

    }
});

function fillMealForm(name, calories)
{
    document.getElementById('mealNameInput').value = name;
    document.getElementById('calorieInput').value = calories;

    const cards = document.querySelectorAll('[data-recipe-card]');

    cards.forEach(card => {

        card.classList.remove(
            'bg-emerald-50',
            'border-2',
            'border-emerald-500'
        );

    });

    event.currentTarget.classList.add(
        'bg-emerald-50',
        'border-2',
        'border-emerald-500'
    );
}

function quickAddMeal(day, mealType)
{
    document.getElementById('daySelect').value = day;
    document.getElementById('mealTypeSelect').value = mealType;

    document.getElementById('mealNameInput').focus();

    window.scrollTo({
        top: 250,
        behavior: 'smooth'
    });
}

function openEditModal(id, mealName, calories)
{
    const modal = document.getElementById('editModal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.getElementById('editMealName').value = mealName;
    document.getElementById('editCalories').value = calories;

    document.getElementById('editForm').action =
        `/nutritionist/clients/{{ $client->slug }}/meal-plans/${id}`;
}

function closeEditModal()
{
    const modal = document.getElementById('editModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>

</body>
</html>
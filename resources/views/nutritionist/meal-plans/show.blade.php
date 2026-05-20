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

@php

$days = [
    'Senin',
    'Selasa',
    'Rabu',
    'Kamis',
    'Jumat',
    'Sabtu',
    'Minggu',
];

$mealTypes = [
    'Sarapan',
    'Makan Siang',
    'Makan Malam',
    'Camilan',
];

$recipes = [
    ['name' => 'Quinoa Bowl', 'cal' => 420, 'protein' => 28, 'carb' => 40, 'fat' => 12, 'color' => 'bg-emerald-100'],
    ['name' => 'Salmon Panggang', 'cal' => 380, 'protein' => 35, 'carb' => 10, 'fat' => 15, 'color' => 'bg-orange-100'],
    ['name' => 'Oat Pisang', 'cal' => 310, 'protein' => 12, 'carb' => 52, 'fat' => 7, 'color' => 'bg-blue-100'],
    ['name' => 'Greek Yogurt', 'cal' => 220, 'protein' => 18, 'carb' => 14, 'fat' => 8, 'color' => 'bg-pink-100'],
    ['name' => 'Chicken Salad', 'cal' => 340, 'protein' => 30, 'carb' => 18, 'fat' => 10, 'color' => 'bg-lime-100'],
    ['name' => 'Nasi Ayam', 'cal' => 510, 'protein' => 40, 'carb' => 65, 'fat' => 18, 'color' => 'bg-yellow-100'],
    ['name' => 'Smoothie Berry', 'cal' => 260, 'protein' => 15, 'carb' => 38, 'fat' => 5, 'color' => 'bg-purple-100'],
    ['name' => 'Avocado Toast', 'cal' => 290, 'protein' => 10, 'carb' => 35, 'fat' => 14, 'color' => 'bg-teal-100'],
    ['name' => 'Wrap Tuna', 'cal' => 330, 'protein' => 26, 'carb' => 28, 'fat' => 11, 'color' => 'bg-cyan-100'],
    ['name' => 'Smoothie Pisang', 'cal' => 210, 'protein' => 9, 'carb' => 32, 'fat' => 4, 'color' => 'bg-amber-100'],
];

$totalCalories = $mealPlans->sum('calories');

$totalProtein = 0;
$totalCarbs = 0;
$totalFat = 0;

foreach ($mealPlans as $meal)
{
    foreach ($recipes as $recipe)
    {
        if ($recipe['name'] === $meal->meal_name)
        {
            $totalProtein += $recipe['protein'];
            $totalCarbs += $recipe['carb'];
            $totalFat += $recipe['fat'];
        }
    }
}

$proteinPercent = $client->protein_target > 0
    ? min(($totalProtein / $client->protein_target) * 100, 100)
    : 0;

$carbPercent = $client->carb_target > 0
    ? min(($totalCarbs / $client->carb_target) * 100, 100)
    : 0;

$fatPercent = $client->fat_target > 0
    ? min(($totalFat / $client->fat_target) * 100, 100)
    : 0;

$caloriePercent = $client->calorie_target > 0
    ? min(($totalCalories / $client->calorie_target) * 100, 100)
    : 0;

$proteinReached = $totalProtein >= $client->protein_target;
$fatReached = $totalFat >= $client->fat_target;
$calorieReached = $totalCalories >= $client->calorie_target;

$proteinRemaining = max($client->protein_target - $totalProtein, 0);
$fatRemaining = max($client->fat_target - $totalFat, 0);

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
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50">
                    ▦ Dashboard
                </a>

                <a href="{{ route('nutritionist.meal-plans') }}"
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

            <!-- TOP -->
            <div class="mb-7 bg-blue-50 border-y border-blue-100 px-5 py-3 flex items-center gap-8 text-sm">

                <span class="font-black text-emerald-800">
                    ▣ Penyusun Rencana Makan
                </span>

                <span class="text-slate-600">
                    Draf: Klien_{{ str_replace(' ', '_', $client->name) }}_Q3
                </span>

            </div>

            <!-- MAIN GRID -->
            <div class="grid grid-cols-12 gap-6 items-stretch">

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

                    <!-- RESEP -->
                    <div class="bg-white rounded-3xl p-7 border border-slate-200 shadow-sm h-[900px] flex flex-col">

                        <h2 class="text-xl font-black text-emerald-900">
                            Daftar Resep
                        </h2>

                        <input
                            id="recipeSearch"
                            type="text"
                            placeholder="Cari makanan sehat..."
                            class="mt-6 w-full rounded-full border-0 bg-slate-100 px-5 py-3 text-sm">

                        <div class="mt-7 space-y-5 overflow-y-auto pr-2 flex-1">

                            @foreach ($recipes as $recipe)

                                <button
                                    type="button"
                                    data-recipe-card
                                    data-name="{{ strtolower($recipe['name']) }}"
                                    onclick="fillMealForm(
                                        '{{ $recipe['name'] }}',
                                        '{{ $recipe['cal'] }}'
                                    )"
                                    class="recipe-card w-full flex items-center gap-4 border-2 border-transparent hover:bg-slate-50 rounded-2xl p-3 transition overflow-hidden">

                                    <div class="w-16 h-16 rounded-2xl shrink-0 {{ $recipe['color'] }}"></div>

                                    <div class="flex-1 text-left min-w-0">

                                        <h3 class="font-black leading-tight text-slate-900">
                                            {{ $recipe['name'] }}
                                        </h3>

                                        <p class="text-sm text-slate-500">
                                            {{ $recipe['cal'] }} kkal
                                        </p>

                                        <p class="text-sm text-slate-500">
                                            {{ $recipe['protein'] }}g Protein
                                        </p>

                                    </div>

                                    <span class="text-slate-400 shrink-0">
                                        ☰
                                    </span>

                                </button>

                            @endforeach

                        </div>

                    </div>

                </section>

                <!-- CENTER -->
               <section class="col-span-6 bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden flex flex-col h-full">

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

                            <button
                                onclick="scrollPlanner('left')"
                                class="hover:text-emerald-700 transition">
                                ‹
                            </button>

                            <button
                                onclick="scrollPlanner('right')"
                                class="hover:text-emerald-700 transition">
                                ›
                            </button>

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
                                id="daySelect"
                                name="day"
                                class="rounded-xl border-slate-200 text-sm">

                                @foreach($days as $day)
                                    <option>{{ $day }}</option>
                                @endforeach

                            </select>

                            <select
                                id="mealTypeSelect"
                                name="meal_type"
                                class="rounded-xl border-slate-200 text-sm">

                                @foreach($mealTypes as $type)
                                    <option>{{ $type }}</option>
                                @endforeach

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
                                class="rounded-xl bg-emerald-800 text-white font-black text-sm hover:bg-emerald-900 transition">

                                Tambah

                            </button>

                        </form>

                    </div>

                    <!-- PLANNER -->
                    <div
                        id="plannerScroll"
                         class="overflow-x-auto flex-1">

                        <div class="p-7 min-w-[1350px]">

                            <!-- DAYS -->
                            <div class="grid grid-cols-7 gap-4 mb-6 text-center">

                                @foreach ($days as $day)

                                    <div>

                                        <h3 class="text-2xl font-black text-emerald-900">
                                            {{ strtoupper(substr($day, 0, 6)) }}
                                        </h3>

                                        <p class="text-sm text-slate-400 mt-1">
                                            {{ $loop->iteration + 13 }} Mei
                                        </p>

                                        <div class="h-[2px] mt-4 {{ $loop->first ? 'bg-emerald-700' : 'bg-transparent' }}"></div>

                                    </div>

                                @endforeach

                            </div>

                            <!-- GRID -->
                            <div class="grid grid-cols-7 gap-4">

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

                                                    <p class="text-lg text-slate-500">
                                                        {{ $meal->calories }} kkal
                                                    </p>

                                                    <div class="flex items-center gap-4">

                                                        <button
                                                            type="button"
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
                                                type="button"
                                                onclick="quickAddMeal('{{ $day }}', '{{ $mealType }}')"
                                                class="min-h-[170px] rounded-3xl border border-dashed border-slate-300 bg-white text-slate-300 text-4xl flex items-center justify-center hover:bg-slate-50">

                                                +

                                            </button>

                                        @endif

                                    @endforeach

                                @endforeach

                            </div>

                        </div>

                    </div>

                </section>

                <!-- RIGHT -->
                <section class="col-span-3 space-y-6 h-full flex flex-col">

                    <!-- MACRO -->
                    <div class="bg-white rounded-3xl p-7 border border-slate-200 shadow-sm">

                        <div class="flex justify-between items-start">

                            <h2 class="text-xl font-black text-emerald-900">
                                Makro Saat Ini
                            </h2>

                            <span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full text-xs font-black">
                                AKTIF
                            </span>

                        </div>

                        <div class="relative h-[260px] mt-5 flex items-center justify-center">

                            <canvas id="macroChart"></canvas>

                            <div class="absolute flex flex-col items-center justify-center">

                                <p class="text-[48px] font-black text-emerald-800 leading-none">
                                    {{ $totalCalories }}
                                </p>

                                <p class="text-xs font-bold text-slate-400 uppercase mt-2">
                                    kkal total
                                </p>

                            </div>

                        </div>

                        <!-- KALORI -->
                        <div class="mt-6">

                            <div class="flex justify-between font-bold">
                                <span>Total Kalori</span>
                                <span>{{ $totalCalories }} / {{ $client->calorie_target }} kkal</span>
                            </div>

                            <div class="h-2 bg-slate-100 rounded-full mt-2">

                                <div
                                    class="h-2 bg-emerald-700 rounded-full"
                                    style="width: {{ $caloriePercent }}%"></div>

                            </div>

                        </div>

                        <!-- PROTEIN -->
                        <div class="mt-6">

                            <div class="flex justify-between font-bold">
                                <span>Protein</span>
                                <span>{{ $totalProtein }}g / {{ $client->protein_target }}g</span>
                            </div>

                            <div class="h-2 bg-slate-100 rounded-full mt-2">

                                <div
                                    class="h-2 bg-emerald-700 rounded-full"
                                    style="width: {{ $proteinPercent }}%"></div>

                            </div>

                        </div>

                        <!-- KARBO -->
                        <div class="mt-6">

                            <div class="flex justify-between font-bold">
                                <span>Karbo</span>
                                <span>{{ $totalCarbs }}g / {{ $client->carb_target }}g</span>
                            </div>

                            <div class="h-2 bg-slate-100 rounded-full mt-2">

                                <div
                                    class="h-2 bg-blue-600 rounded-full"
                                    style="width: {{ $carbPercent }}%"></div>

                            </div>

                        </div>

                        <!-- FAT -->
                        <div class="mt-6">

                            <div class="flex justify-between font-bold">
                                <span>Lemak</span>
                                <span>{{ $totalFat }}g / {{ $client->fat_target }}g</span>
                            </div>

                            <div class="h-2 bg-slate-100 rounded-full mt-2">

                                <div
                                    class="h-2 bg-yellow-500 rounded-full"
                                    style="width: {{ $fatPercent }}%"></div>

                            </div>

                        </div>

                    </div>

                    <!-- GOALS -->
                    <div class="bg-white rounded-[32px] border border-slate-200 p-7 shadow-sm">

                        <div class="bg-white rounded-[32px] border border-slate-200 p-7 shadow-sm flex flex-col flex-1">
                            Kesesuaian Target Klien
                        </p>

                        <div class="mt-6 space-y-5">

                            <!-- Protein -->
                            <div class="flex items-start gap-3">

                                @if($proteinReached)

                                    <div class="w-5 h-5 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 text-xs mt-0.5">
                                        ✓
                                    </div>

                                    <p class="font-bold text-slate-800">
                                        Target protein tinggi mulai terpenuhi
                                    </p>

                                @else

                                    <div class="w-5 h-5 rounded-full bg-amber-100 flex items-center justify-center text-amber-700 text-xs mt-0.5">
                                        !
                                    </div>

                                    <p class="font-bold text-slate-800">
                                        Tambahkan {{ $proteinRemaining }}g protein lagi
                                    </p>

                                @endif

                            </div>

                            <!-- Fat -->
                            <div class="flex items-start gap-3">

                                @if($fatReached)

                                    <div class="w-5 h-5 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 text-xs mt-0.5">
                                        ✓
                                    </div>

                                    <p class="text-slate-600">
                                        Target lemak sehat sudah terpenuhi
                                    </p>

                                @else

                                    <div class="w-5 h-5 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs mt-0.5">
                                        i
                                    </div>

                                    <p class="text-slate-600">
                                        Tambahkan {{ $fatRemaining }}g lemak sehat untuk mencapai target
                                    </p>

                                @endif

                            </div>

                            <!-- Calories -->
                            <div class="flex items-start gap-3">

                                @if($calorieReached)

                                    <div class="w-5 h-5 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 text-xs mt-0.5">
                                        ✓
                                    </div>

                                    <p class="text-slate-600">
                                        Target kalori harian sudah tercapai
                                    </p>

                                @else

                                    <div class="w-5 h-5 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs mt-0.5">
                                        i
                                    </div>

                                    <p class="text-slate-600">
                                        Total kalori masih di bawah target harian
                                    </p>

                                @endif

                            </div>

                        </div>

                        <!-- BUTTONS -->
                        <div class="mt-auto pt-8 space-y-3">

                            <form
    method="POST"
    action="{{ route('nutritionist.clients.meal-plans.duplicate', $client->slug) }}">

    @csrf

    <form
    method="POST"
    action="{{ route('nutritionist.clients.meal-plans.duplicate', $client->slug) }}">

    @csrf

    <input
        type="hidden"
        name="source_day"
        id="duplicateDayInput">

    <button
        type="submit"
        onclick="setDuplicateDay()"
        class="w-full rounded-2xl border border-slate-200 px-5 py-4 font-bold text-slate-700 hover:bg-slate-50 transition">

        📋 Duplikat Hari Terpilih

    </button>

</form>
</button>

    </button>

</form>


    <a
    href="{{ route('nutritionist.clients.meal-plans.export-pdf', $client->slug) }}"
    class="block w-full rounded-2xl border border-slate-200 px-5 py-4 font-bold text-slate-700 hover:bg-slate-50 transition text-center">

    ↓ Ekspor PDF untuk Klien

</a>

                            </button>

                            <form
                                method="POST"
                                action="{{ route('nutritionist.clients.meal-plans.share', $client->slug) }}">

                                @csrf

                                <button
                                    type="submit"
                                    onclick="return confirm('Selesaikan dan bagikan rencana makan ini ke klien?')"
                                    class="w-full rounded-2xl bg-emerald-700 text-white py-4 font-black hover:bg-emerald-800 transition">

                                    ▶ Selesaikan & Bagikan

                                </button>

                            </form>

                        </div>

                    </div>

                </section>

            </div>

        </div>

    </main>

</div>

<!-- MODAL -->
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
                {{ $totalProtein }},
                {{ $totalCarbs }},
                {{ $totalFat }}
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
            'border-emerald-500'
        );

    });

    event.currentTarget.classList.add(
        'bg-emerald-50',
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

function scrollPlanner(direction)
{
    const planner = document.getElementById('plannerScroll');

    planner.scrollBy({
        left: direction === 'right' ? 500 : -500,
        behavior: 'smooth'
    });
}


/* SEARCH RECIPE */
function duplicateSelectedDay()
{
    const day = document.getElementById('daySelect').value;

    alert('Fitur duplikat untuk hari ' + day + ' akan dibuat nanti.');
}

const recipeSearch = document.getElementById('recipeSearch');

recipeSearch.addEventListener('keyup', function() {

    const keyword = this.value.toLowerCase();

    const cards = document.querySelectorAll('.recipe-card');

    cards.forEach(card => {

        const name = card.dataset.name;

        if (name.includes(keyword))
        {
            card.style.display = 'flex';
        }
        else
        {
            card.style.display = 'none';
        }

    });

});

function setDuplicateDay()
{
    const selectedDay =
        document.getElementById('daySelect').value;

    document.getElementById('duplicateDayInput').value =
        selectedDay;
}
</script>

</body>
</html>
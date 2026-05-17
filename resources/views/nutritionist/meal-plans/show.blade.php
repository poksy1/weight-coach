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
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    ▦ Dashboard
                </a>

                <a href="{{ route('nutritionist.clients.meal-plans', $client->slug) }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-emerald-700 text-white font-bold">
                    🍽 Rencana Makan
                </a>

                <a href="{{ route('nutritionist.water') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    ♢ Pantau Air
                </a>

                <a href="{{ route('nutritionist.progress') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    ⌁ Progress
                </a>

                <a href="{{ route('nutritionist.settings') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    ⚙ Pengaturan
                </a>

            </nav>

        </div>

        <button onclick="alert('Fitur template meal plan akan dikembangkan pada tahap berikutnya')"
                class="w-full bg-emerald-800 text-white py-3 rounded-lg font-bold text-sm">
            + Simpan Template
        </button>

    </aside>

    <!-- CONTENT -->
    <main class="ml-[245px] flex-1 px-10 py-8 overflow-y-auto">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-8">

            <div class="flex items-center gap-4">

                <a href="{{ route('nutritionist.clients.show', $client->slug) }}"
                   class="text-emerald-700 text-2xl">
                    ←
                </a>

                <div>

                    <h1 class="text-[42px] leading-tight font-black text-emerald-900">
                        Rencana Makan
                    </h1>

                    <p class="text-slate-500 mt-2 text-base">
                        Program nutrisi untuk {{ $client->name }}
                    </p>

                </div>

            </div>

            <div class="flex items-center gap-4">

                <button onclick="alert('Fitur duplikat meal plan akan dikembangkan pada tahap berikutnya')"
                        class="bg-white border border-slate-200 px-5 py-3 rounded-2xl font-bold text-slate-600 shadow-sm">
                    Duplikat
                </button>

                <button onclick="alert('Fitur ekspor PDF akan dikembangkan pada tahap berikutnya')"
                        class="bg-white border border-slate-200 px-5 py-3 rounded-2xl font-bold text-slate-600 shadow-sm">
                    Ekspor PDF
                </button>

                <button onclick="alert('Meal plan berhasil dibagikan')"
                        class="bg-emerald-800 text-white px-5 py-3 rounded-2xl font-bold shadow-sm">
                    Selesaikan & Bagikan
                </button>

            </div>

        </div>

        <!-- CARD ATAS -->
        <div class="grid grid-cols-4 gap-6 mb-8">

            <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">
                <p class="text-xs text-slate-400 font-bold uppercase">
                    Target Kalori
                </p>

                <h2 class="text-[56px] leading-none font-black text-emerald-700 mt-4">
                    {{ $client->calorie_target }}
                </h2>

                <p class="text-sm text-slate-500 mt-3">
                    kkal per hari
                </p>
            </div>

            <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">
                <p class="text-xs text-slate-400 font-bold uppercase">
                    Protein
                </p>

                <h2 class="text-[56px] leading-none font-black text-blue-600 mt-4">
                    {{ $client->protein_target }}g
                </h2>

                <p class="text-sm text-slate-500 mt-3">
                    target harian
                </p>
            </div>

            <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">
                <p class="text-xs text-slate-400 font-bold uppercase">
                    Karbohidrat
                </p>

                <h2 class="text-[56px] leading-none font-black text-yellow-500 mt-4">
                    {{ $client->carb_target }}g
                </h2>

                <p class="text-sm text-slate-500 mt-3">
                    target harian
                </p>
            </div>

            <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">
                <p class="text-xs text-slate-400 font-bold uppercase">
                    Lemak
                </p>

                <h2 class="text-[56px] leading-none font-black text-red-500 mt-4">
                    {{ $client->fat_target }}g
                </h2>

                <p class="text-sm text-slate-500 mt-3">
                    target harian
                </p>
            </div>

        </div>

        <!-- GRID -->
        <div class="grid grid-cols-12 gap-6">

            <!-- RENCANA MAKAN -->
            <div class="col-span-8 bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                <div class="flex items-center justify-between mb-8">

                    <div>
                        <h2 class="text-[34px] leading-tight font-black text-slate-950">
                            Rencana Makan 7 Hari
                        </h2>

                        <p class="text-sm text-slate-500 mt-2">
                            Distribusi nutrisi dan jadwal makan klien.
                        </p>
                    </div>

                    <button onclick="alert('Fitur tambah hari akan dikembangkan pada tahap berikutnya')"
                            class="bg-slate-100 hover:bg-slate-200 transition px-5 py-3 rounded-2xl text-sm font-bold">
                        + Tambah Hari
                    </button>

                </div>

                <div class="space-y-6">

                    <!-- SENIN -->
                    <div class="border border-slate-100 rounded-2xl p-6">

                        <div class="flex items-center justify-between mb-5">

                            <div>
                                <h3 class="text-xl font-black text-slate-900">
                                    Senin
                                </h3>

                                <p class="text-sm text-slate-400">
                                    2.140 kkal
                                </p>
                            </div>

                            <span class="bg-emerald-100 text-emerald-700 text-xs px-4 py-2 rounded-full font-bold">
                                Sesuai Target
                            </span>

                        </div>

                        <div class="space-y-4">

                            <div class="flex justify-between items-center bg-slate-50 rounded-xl px-5 py-4">
                                <div>
                                    <p class="font-bold">Sarapan</p>
                                    <p class="text-sm text-slate-500">
                                        Overnight oats + greek yogurt
                                    </p>
                                </div>

                                <p class="font-black">
                                    420 kkal
                                </p>
                            </div>

                            <div class="flex justify-between items-center bg-slate-50 rounded-xl px-5 py-4">
                                <div>
                                    <p class="font-bold">Makan Siang</p>
                                    <p class="text-sm text-slate-500">
                                        Ayam panggang + nasi merah
                                    </p>
                                </div>

                                <p class="font-black">
                                    680 kkal
                                </p>
                            </div>

                            <div class="flex justify-between items-center bg-slate-50 rounded-xl px-5 py-4">
                                <div>
                                    <p class="font-bold">Makan Malam</p>
                                    <p class="text-sm text-slate-500">
                                        Salmon + sayuran kukus
                                    </p>
                                </div>

                                <p class="font-black">
                                    610 kkal
                                </p>
                            </div>

                        </div>

                    </div>

                    <!-- SELASA -->
                    <div class="border border-slate-100 rounded-2xl p-6">

                        <div class="flex items-center justify-between mb-5">

                            <div>
                                <h3 class="text-xl font-black text-slate-900">
                                    Selasa
                                </h3>

                                <p class="text-sm text-slate-400">
                                    2.020 kkal
                                </p>
                            </div>

                            <span class="bg-blue-100 text-blue-700 text-xs px-4 py-2 rounded-full font-bold">
                                Stabil
                            </span>

                        </div>

                        <div class="space-y-4">

                            <div class="flex justify-between items-center bg-slate-50 rounded-xl px-5 py-4">
                                <div>
                                    <p class="font-bold">Sarapan</p>
                                    <p class="text-sm text-slate-500">
                                        Smoothie pisang protein
                                    </p>
                                </div>

                                <p class="font-black">
                                    390 kkal
                                </p>
                            </div>

                            <div class="flex justify-between items-center bg-slate-50 rounded-xl px-5 py-4">
                                <div>
                                    <p class="font-bold">Makan Siang</p>
                                    <p class="text-sm text-slate-500">
                                        Chicken wrap tinggi protein
                                    </p>
                                </div>

                                <p class="font-black">
                                    710 kkal
                                </p>
                            </div>

                            <div class="flex justify-between items-center bg-slate-50 rounded-xl px-5 py-4">
                                <div>
                                    <p class="font-bold">Makan Malam</p>
                                    <p class="text-sm text-slate-500">
                                        Sup ayam + salad alpukat
                                    </p>
                                </div>

                                <p class="font-black">
                                    590 kkal
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PANEL KANAN -->
            <div class="col-span-4 space-y-6">

                <!-- GRAFIK -->
                <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                    <h2 class="text-[28px] leading-tight font-black text-slate-950 mb-6">
                        Distribusi Makro
                    </h2>

                    <div class="h-[260px]">
                        <canvas id="macroChart"></canvas>
                    </div>

                </div>

                <!-- TARGET -->
                <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                    <h2 class="text-[28px] leading-tight font-black text-slate-950 mb-6">
                        Kesesuaian Target
                    </h2>

                    <div class="space-y-5 text-sm">

                        <div>
                            <div class="flex justify-between mb-1">
                                <span>Protein</span>
                                <span class="font-bold">88%</span>
                            </div>

                            <div class="h-2 bg-slate-100 rounded-full">
                                <div class="h-2 bg-emerald-700 rounded-full w-[88%]"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between mb-1">
                                <span>Karbohidrat</span>
                                <span class="font-bold">80%</span>
                            </div>

                            <div class="h-2 bg-slate-100 rounded-full">
                                <div class="h-2 bg-blue-500 rounded-full w-[80%]"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between mb-1">
                                <span>Lemak</span>
                                <span class="font-bold">72%</span>
                            </div>

                            <div class="h-2 bg-slate-100 rounded-full">
                                <div class="h-2 bg-yellow-500 rounded-full w-[72%]"></div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- CATATAN -->
                <div class="bg-emerald-50 rounded-3xl p-7 border border-emerald-100">

                    <h2 class="text-[26px] leading-tight font-black text-slate-950 mb-5">
                        Catatan Nutrisi
                    </h2>

                    <div class="text-sm leading-7 text-slate-700">

                        <p>
                            Program nutrisi untuk {{ $client->name }}
                            difokuskan pada:
                        </p>

                        <ul class="mt-4 space-y-2 list-disc pl-5">

                            <li>
                                Menjaga kepatuhan nutrisi harian
                            </li>

                            <li>
                                Meningkatkan kualitas protein
                            </li>

                            <li>
                                Menjaga hidrasi dan pola makan stabil
                            </li>

                            <li>
                                Mengurangi makanan ultra processed
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

<script>

    const macroChart = document.getElementById('macroChart');

    new Chart(macroChart, {
        type: 'doughnut',
        data: {
            labels: ['Protein', 'Karbohidrat', 'Lemak'],
            datasets: [{
                data: [
                    {{ $client->protein_target }},
                    {{ $client->carb_target }},
                    {{ $client->fat_target }}
                ],
                backgroundColor: [
                    '#047857',
                    '#3b82f6',
                    '#eab308'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

</script>

</body>
</html>
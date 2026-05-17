<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Klien - Putri Amanda</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-[#f4f7f6] text-slate-900">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="fixed left-0 top-0 bottom-0 w-[245px] bg-white border-r border-slate-200 px-5 py-6 flex flex-col justify-between">

        <div>
            <h1 class="text-2xl font-black text-emerald-800">
                WeightCoach
            </h1>

            <p class="text-xs text-slate-500 mt-1">
                Kesehatan Harian
            </p>

            <nav class="mt-10 space-y-2 text-sm">

                <a href="{{ route('nutritionist.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-emerald-700 text-white font-bold">
                    ▦ Dashboard
                </a>

                <a href="{{ route('nutritionist.meal-plans') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
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

        <button class="w-full bg-emerald-800 text-white py-3 rounded-lg font-bold text-sm">
            + Catat Entri Baru
        </button>

    </aside>

    <!-- CONTENT -->
    <main class="ml-[245px] flex-1 px-10 py-8 w-full overflow-y-auto">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-8">

            <div class="flex items-center gap-4">

                <a href="{{ route('nutritionist.dashboard') }}"
                   class="text-emerald-700 text-2xl">
                    ←
                </a>

                <div>
                    <h1 class="text-[42px] leading-tight font-black text-emerald-950">
                        Profil Klien: Putri Amanda
                    </h1>

                    <p class="text-slate-500 mt-2 text-base">
                        Program: Manajemen Berat Badan
                    </p>
                </div>

            </div>

            <div class="flex items-center gap-4 text-slate-500">
                <span>📅</span>
                <span>🔔</span>

                <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center font-black">
                    PA
                </div>
            </div>

        </div>

        <!-- BAGIAN ATAS -->
        <div class="grid grid-cols-12 gap-6 w-full">

            <!-- GRAFIK -->
            <section class="col-span-8 bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[430px]">

                <div class="flex items-start justify-between mb-5">

                    <div>
                        <h2 class="text-[30px] leading-tight font-black text-slate-950">
                            Kepatuhan Program Nutrisi
                        </h2>

                        <p class="text-slate-500 text-sm mt-3">
                            Pemantauan kepatuhan program nutrisi selama 7 hari terakhir.
                        </p>
                    </div>

                    <div class="flex gap-5 text-sm mt-2">

                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-emerald-700 rounded-full"></div>
                            <span>Aktual</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-blue-400 rounded-full"></div>
                            <span>Target</span>
                        </div>

                    </div>

                </div>

                <div class="h-[285px] mt-6">
                    <canvas id="grafikPutri"></canvas>
                </div>

            </section>

            <!-- CARD STATUS -->
            <section class="col-span-4 space-y-6">

                <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[260px]">

                    <p class="text-sm text-slate-400 font-bold">
                        Rata-rata Defisit Kalori
                    </p>

                    <h3 class="text-[86px] leading-none font-black text-emerald-700 mt-5">
                        -124
                    </h3>

                    <p class="text-slate-500 mt-3 text-base">
                        kkal / hari
                    </p>

                    <div class="mt-6 bg-emerald-50 text-emerald-700 font-bold rounded-xl px-5 py-4">
                        Sesuai target program
                    </div>

                </div>

                <a href="{{ route('nutritionist.meal-plans') }}"
                   class="block w-full bg-emerald-800 hover:bg-emerald-900 text-white text-center py-5 rounded-2xl font-black text-lg shadow-sm">
                    Atur Rencana Makan
                </a>

            </section>

        </div>

        <!-- BAGIAN BAWAH -->
        <div class="grid grid-cols-12 gap-6 mt-6">

            <!-- CATATAN PROFESIONAL -->
            <section class="col-span-7 bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[420px]">

                <div class="flex items-start justify-between mb-6">

                    <h2 class="text-[34px] leading-tight font-black text-slate-950">
                        Catatan Profesional
                    </h2>

                    <button class="text-emerald-700 font-bold text-sm">
                        Edit Riwayat
                    </button>

                </div>

                <div class="bg-slate-50 rounded-2xl p-6 text-base leading-8 text-slate-700">

                    <p>
                        Putri Amanda menunjukkan kepatuhan yang sangat baik terhadap program manajemen berat badan.
                        Pola makan harian mulai lebih teratur, konsumsi gula menurun, dan target protein tercapai
                        secara konsisten dalam beberapa hari terakhir.
                    </p>

                    <div class="border-l-4 border-slate-300 pl-5 italic mt-6 text-slate-600">
                        Fokus berikutnya adalah meningkatkan asupan cairan menjadi 3 liter per hari,
                        menjaga konsistensi makan malam sehat, dan mengurangi camilan tinggi gula pada malam hari.
                    </div>

                </div>

                <div class="mt-6">

                    <p class="text-sm font-bold text-slate-600 mb-2">
                        Catatan Tambahan
                    </p>

                    <input type="text"
                           class="w-full rounded-xl border-0 bg-slate-100 px-5 py-4 text-sm"
                           placeholder="Tulis observasi singkat...">

                </div>

            </section>

            <!-- MAKANAN TERBARU -->
            <section class="col-span-5 bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[420px]">

                <div class="flex items-start justify-between mb-8">

                    <h2 class="text-[34px] leading-tight font-black text-slate-950">
                        Makanan Terbaru
                    </h2>

                    <span class="bg-emerald-100 text-emerald-700 text-xs px-4 py-2 rounded-full font-bold">
                        Hari Ini
                    </span>

                </div>

                <div class="space-y-7">

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-xl bg-emerald-100"></div>

                            <div>
                                <h3 class="font-black text-lg">
                                    Salad Ayam Panggang
                                </h3>

                                <p class="text-slate-400 text-sm">
                                    Makan Siang • 420g
                                </p>
                            </div>

                        </div>

                        <p class="font-black text-lg">
                            420 kkal
                        </p>

                    </div>

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-xl bg-orange-100"></div>

                            <div>
                                <h3 class="font-black text-lg">
                                    Overnight Oats
                                </h3>

                                <p class="text-slate-400 text-sm">
                                    Sarapan • 310g
                                </p>
                            </div>

                        </div>

                        <p class="font-black text-lg">
                            310 kkal
                        </p>

                    </div>

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-xl bg-yellow-100"></div>

                            <div>
                                <h3 class="font-black text-lg">
                                    Almond Panggang
                                </h3>

                                <p class="text-slate-400 text-sm">
                                    Camilan • 30g
                                </p>
                            </div>

                        </div>

                        <p class="font-black text-lg">
                            170 kkal
                        </p>

                    </div>

                </div>

                <button class="w-full mt-8 border border-slate-200 rounded-xl py-3 text-sm font-bold text-slate-600">
                    Lihat Riwayat Makanan
                </button>

            </section>

            <!-- DISTRIBUSI MAKRONUTRIEN -->
            <section class="col-span-4 bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[220px]">

                <h3 class="text-xl font-black text-slate-950 mb-5">
                    Distribusi Makronutrien
                </h3>

                <div class="space-y-4 text-sm">

                    <div>
                        <div class="flex justify-between mb-1">
                            <span>Protein</span>
                            <span class="font-bold">92g / 100g</span>
                        </div>
                        <div class="h-2 bg-slate-100 rounded-full">
                            <div class="h-2 bg-emerald-700 rounded-full w-[92%]"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-1">
                            <span>Karbohidrat</span>
                            <span class="font-bold">145g / 180g</span>
                        </div>
                        <div class="h-2 bg-slate-100 rounded-full">
                            <div class="h-2 bg-blue-500 rounded-full w-[80%]"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-1">
                            <span>Lemak</span>
                            <span class="font-bold">42g / 60g</span>
                        </div>
                        <div class="h-2 bg-slate-100 rounded-full">
                            <div class="h-2 bg-yellow-500 rounded-full w-[70%]"></div>
                        </div>
                    </div>

                </div>

            </section>

            <!-- ASUPAN CAIRAN -->
            <section class="col-span-4 bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[220px]">

                <h3 class="text-xl font-black text-slate-950 mb-5">
                    Asupan Cairan Harian
                </h3>

                <p class="text-[56px] leading-none font-black text-blue-600">
                    2,8L
                </p>

                <p class="text-slate-500 mt-3">
                    Target harian 3L
                </p>

                <div class="mt-5 h-2 bg-slate-100 rounded-full">
                    <div class="h-2 bg-blue-500 rounded-full w-[93%]"></div>
                </div>

            </section>

            <!-- PENCAPAIAN MINGGUAN -->
            <section class="col-span-4 bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[220px]">

                <h3 class="text-xl font-black text-slate-950 mb-5">
                    Pencapaian Mingguan
                </h3>

                <p class="text-[56px] leading-none font-black text-emerald-700">
                    92%
                </p>

                <p class="text-slate-500 mt-3">
                    Kepatuhan program nutrisi minggu ini.
                </p>

                <div class="mt-5 h-2 bg-slate-100 rounded-full">
                    <div class="h-2 bg-emerald-700 rounded-full w-[92%]"></div>
                </div>

            </section>

        </div>

    </main>

</div>

<script>
    const grafikPutri = document.getElementById('grafikPutri');

    new Chart(grafikPutri, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [
                {
                    label: 'Aktual',
                    data: [78, 82, 85, 88, 90, 91, 95],
                    borderColor: '#047857',
                    backgroundColor: 'rgba(4, 120, 87, 0.12)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#047857'
                },
                {
                    label: 'Target',
                    data: [80, 80, 80, 80, 80, 80, 80],
                    borderColor: '#60a5fa',
                    borderDash: [6, 6],
                    fill: false,
                    tension: 0.4,
                    pointRadius: 3,
                    pointBackgroundColor: '#60a5fa'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                y: {
                    min: 60,
                    max: 100,
                    ticks: {
                        stepSize: 10
                    }
                }
            }
        }
    });
</script>

</body>
</html>
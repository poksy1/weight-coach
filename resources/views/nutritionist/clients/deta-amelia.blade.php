<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Klien - Deta Amelia</title>

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
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-emerald-700 text-white font-bold">
                    ▦ Dashboard
                </a>

                <a href="{{ route('nutritionist.meal-plans') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    🍽 Rencana Makan
                </a>

                <a href="#"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    ♢ Pantau Air
                </a>

                <a href="#"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    ⌁ Progress
                </a>

                <a href="#"
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
    <main class="ml-[245px] flex-1 px-10 py-8 overflow-y-auto">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-8">

            <div class="flex items-center gap-4">

                <a href="{{ route('nutritionist.dashboard') }}"
                   class="text-emerald-700 text-2xl">
                    ←
                </a>

                <div>
                    <h1 class="text-[42px] leading-tight font-black text-emerald-950">
                        Profil Klien: Deta Amelia
                    </h1>

                    <p class="text-slate-500 mt-2 text-base">
                        Program: Pemulihan Pola Makan
                    </p>
                </div>

            </div>

            <div class="flex items-center gap-4 text-slate-500">

                <span>📅</span>
                <span>🔔</span>

                <div class="w-10 h-10 rounded-full bg-red-100 text-red-700 flex items-center justify-center font-black">
                    DA
                </div>

            </div>

        </div>

        <!-- TOP SECTION -->
        <div class="grid grid-cols-12 gap-6">

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
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <span>Aktual</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-orange-400 rounded-full"></div>
                            <span>Target</span>
                        </div>

                    </div>

                </div>

                <div class="h-[285px] mt-6">
                    <canvas id="grafikDeta"></canvas>
                </div>

            </section>

            <!-- STATUS -->
            <section class="col-span-4 space-y-6">

                <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[260px]">

                    <p class="text-sm text-slate-400 font-bold">
                        Rata-rata Defisit Kalori
                    </p>

                    <h3 class="text-[86px] leading-none font-black text-red-500 mt-5">
                        -340
                    </h3>

                    <p class="text-slate-500 mt-3 text-base">
                        kkal / hari
                    </p>

                    <div class="mt-6 bg-red-50 text-red-600 font-bold rounded-xl px-5 py-4">
                        Membutuhkan pemantauan intensif
                    </div>

                </div>

                <a href="{{ route('nutritionist.meal-plans') }}"
                   class="block w-full bg-emerald-800 hover:bg-emerald-900 text-white text-center py-5 rounded-2xl font-black text-lg shadow-sm">
                    Atur Rencana Makan
                </a>

            </section>

        </div>

        <!-- MIDDLE -->
        <div class="grid grid-cols-12 gap-6 mt-6">

            <!-- CATATAN -->
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
                        Deta Amelia masih menunjukkan pola makan yang belum konsisten.
                        Beberapa waktu makan utama masih terlewat dan asupan cairan harian
                        belum mencapai target yang disarankan. Energi harian juga terlihat
                        menurun pada sore hingga malam hari.
                    </p>

                    <div class="border-l-4 border-slate-300 pl-5 italic mt-6 text-slate-600">
                        Fokus berikutnya adalah membangun jadwal makan yang lebih teratur,
                        meningkatkan konsumsi makanan bernutrisi secara bertahap,
                        dan menjaga hidrasi harian agar kondisi tubuh lebih stabil.
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

            <!-- MAKANAN -->
            <section class="col-span-5 bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[420px]">

                <div class="flex items-start justify-between mb-8">

                    <h2 class="text-[34px] leading-tight font-black text-slate-950">
                        Makanan Terbaru
                    </h2>

                    <span class="bg-red-100 text-red-600 text-xs px-4 py-2 rounded-full font-bold">
                        Hari Ini
                    </span>

                </div>

                <div class="space-y-7">

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-xl bg-red-100"></div>

                            <div>
                                <h3 class="font-black text-lg">
                                    Sup Ayam Kaldu
                                </h3>

                                <p class="text-slate-400 text-sm">
                                    Makan Siang • 360g
                                </p>
                            </div>

                        </div>

                        <p class="font-black text-lg">
                            390 kkal
                        </p>

                    </div>

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-xl bg-yellow-100"></div>

                            <div>
                                <h3 class="font-black text-lg">
                                    Oatmeal Pisang
                                </h3>

                                <p class="text-slate-400 text-sm">
                                    Sarapan • 280g
                                </p>
                            </div>

                        </div>

                        <p class="font-black text-lg">
                            310 kkal
                        </p>

                    </div>

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-xl bg-orange-100"></div>

                            <div>
                                <h3 class="font-black text-lg">
                                    Ikan Kukus Protein Tinggi
                                </h3>

                                <p class="text-slate-400 text-sm">
                                    Makan Malam • 300g
                                </p>
                            </div>

                        </div>

                        <p class="font-black text-lg">
                            450 kkal
                        </p>

                    </div>

                </div>

                <button class="w-full mt-8 border border-slate-200 rounded-xl py-3 text-sm font-bold text-slate-600">
                    Lihat Riwayat Makanan
                </button>

            </section>

            <!-- MAKRO -->
            <section class="col-span-4 bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[220px]">

                <h3 class="text-xl font-black text-slate-950 mb-5">
                    Distribusi Makronutrien
                </h3>

                <div class="space-y-4 text-sm">

                    <div>
                        <div class="flex justify-between mb-1">
                            <span>Protein</span>
                            <span class="font-bold">70g / 95g</span>
                        </div>
                        <div class="h-2 bg-slate-100 rounded-full">
                            <div class="h-2 bg-red-500 rounded-full w-[73%]"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-1">
                            <span>Karbohidrat</span>
                            <span class="font-bold">130g / 180g</span>
                        </div>
                        <div class="h-2 bg-slate-100 rounded-full">
                            <div class="h-2 bg-orange-400 rounded-full w-[72%]"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-1">
                            <span>Lemak</span>
                            <span class="font-bold">38g / 60g</span>
                        </div>
                        <div class="h-2 bg-slate-100 rounded-full">
                            <div class="h-2 bg-yellow-400 rounded-full w-[63%]"></div>
                        </div>
                    </div>

                </div>

            </section>

            <!-- AIR -->
            <section class="col-span-4 bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[220px]">

                <h3 class="text-xl font-black text-slate-950 mb-5">
                    Asupan Cairan Harian
                </h3>

                <p class="text-[56px] leading-none font-black text-blue-600">
                    2,1L
                </p>

                <p class="text-slate-500 mt-3">
                    Target harian 3L
                </p>

                <div class="mt-5 h-2 bg-slate-100 rounded-full">
                    <div class="h-2 bg-blue-500 rounded-full w-[70%]"></div>
                </div>

            </section>

            <!-- TARGET -->
            <section class="col-span-4 bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[220px]">

                <h3 class="text-xl font-black text-slate-950 mb-5">
                    Pencapaian Mingguan
                </h3>

                <p class="text-[56px] leading-none font-black text-red-500">
                    45%
                </p>

                <p class="text-slate-500 mt-3">
                    Kepatuhan program nutrisi minggu ini.
                </p>

                <div class="mt-5 h-2 bg-slate-100 rounded-full">
                    <div class="h-2 bg-red-500 rounded-full w-[45%]"></div>
                </div>

            </section>

        </div>

    </main>

</div>

<script>
    const grafikDeta = document.getElementById('grafikDeta');

    new Chart(grafikDeta, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [
                {
                    label: 'Aktual',
                    data: [55, 58, 60, 63, 67, 70, 74],
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.10)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#ef4444'
                },
                {
                    label: 'Target',
                    data: [75, 75, 75, 75, 75, 75, 75],
                    borderColor: '#fb923c',
                    borderDash: [6, 6],
                    fill: false,
                    tension: 0.4,
                    pointRadius: 3,
                    pointBackgroundColor: '#fb923c'
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
                    min: 40,
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
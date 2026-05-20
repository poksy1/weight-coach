<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Klien - {{ $client->name }}</title>

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
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    ▦ Dashboard
                </a>

                <a href="{{ route('nutritionist.clients.meal-plans', $client->slug) }}"
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

        <button onclick="alert('Fitur catat entri baru akan dikembangkan pada tahap berikutnya')"
                class="w-full bg-emerald-800 text-white py-3 rounded-lg font-bold text-sm">
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
                    <h1 class="text-[42px] leading-tight font-black text-emerald-900">
                        Profil Klien: {{ $client->name }}
                    </h1>

                    <p class="text-slate-500 mt-2 text-base">
                        Program {{ $client->program }}
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <span class="bg-white border border-slate-200 px-5 py-3 rounded-2xl text-sm font-bold text-slate-600 shadow-sm">
                    Update: {{ $client->updated_at->diffForHumans() }}
                </span>

                <a href="{{ route('nutritionist.meal-plans') }}"
                   class="bg-emerald-800 text-white px-5 py-3 rounded-2xl font-bold shadow-sm">
                    Buat Rencana Makan
                </a>
            </div>

        </div>

        <!-- BAGIAN ATAS -->
        <div class="grid grid-cols-12 gap-6">

            <!-- GRAFIK -->
            <div class="col-span-8 bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[430px]">

                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="text-[30px] leading-tight font-black text-slate-950">
                            Kepatuhan Nutrisi
                        </h2>

                        <p class="text-slate-500 text-sm mt-2">
                            Pemantauan kepatuhan nutrisi {{ $client->name }} selama 7 hari terakhir.
                        </p>
                    </div>

                    <div class="flex gap-5 text-sm">
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

                <div class="h-[280px] mt-6">
                    <canvas id="grafikKlien"></canvas>
                </div>

            </div>

            <!-- STATUS KANAN -->
            <div class="col-span-4 space-y-6">

                <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[260px]">

                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wide">
                        Kepatuhan Program
                    </p>

                    <h3 class="text-[88px] leading-none font-black mt-5
                        @if($client->risk_level === 'high') text-red-600
                        @elseif($client->risk_level === 'moderate') text-yellow-600
                        @else text-emerald-700
                        @endif">
                        {{ $client->adherence }}%
                    </h3>

                    <p class="text-slate-500 mt-3 text-base">
                        target program tercapai
                    </p>

                    <div class="mt-6 rounded-xl px-5 py-4 font-bold
                        @if($client->risk_level === 'high') bg-red-50 text-red-700
                        @elseif($client->risk_level === 'moderate') bg-yellow-50 text-yellow-700
                        @else bg-emerald-50 text-emerald-700
                        @endif">
                        @if($client->risk_level === 'high')
                            Membutuhkan perhatian khusus
                        @elseif($client->risk_level === 'moderate')
                            Progress stabil dan perlu dipantau
                        @else
                            Progress sangat baik
                        @endif
                    </div>

                </div>

                <a href="{{ route('nutritionist.clients.meal-plans', $client->slug) }}"
                   class="block w-full bg-emerald-800 hover:bg-emerald-900 text-white text-center py-5 rounded-2xl font-black text-lg">
                    Tetapkan Rencana Makan Baru
                </a>

            </div>

        </div>

        <!-- BAGIAN BAWAH -->
        <div class="grid grid-cols-12 gap-6 mt-6">

            <!-- CATATAN PROFESIONAL -->
            <div class="col-span-7 bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[420px]">

                <div class="flex items-start justify-between mb-6">
                    <h2 class="text-[34px] leading-tight font-black text-slate-950">
                        Catatan Profesional
                    </h2>

                    <button onclick="alert('Fitur edit catatan akan dikembangkan pada tahap berikutnya')"
                            class="text-emerald-700 font-bold text-sm">
                        Edit Riwayat
                    </button>
                </div>

                <div class="bg-slate-50 rounded-2xl p-6 text-base leading-8 text-slate-700">

                    @if($client->program === 'Manajemen Berat Badan')
                        <p>
                            {{ $client->name }} menunjukkan kepatuhan yang baik terhadap program manajemen berat badan.
                            Fokus utama saat ini adalah menjaga defisit kalori sehat, meningkatkan asupan protein,
                            dan mengurangi konsumsi gula harian.
                        </p>

                        <div class="border-l-4 border-slate-300 pl-5 italic mt-6 text-slate-600">
                            Fokus berikutnya adalah menjaga konsistensi makan malam sehat,
                            meningkatkan hidrasi, dan mempertahankan kepatuhan di atas 90%.
                        </div>
                    @elseif($client->program === 'Nutrisi Olahraga')
                        <p>
                            {{ $client->name }} menunjukkan perkembangan performa olahraga yang stabil.
                            Asupan protein dan karbohidrat kompleks sudah mulai mendukung kebutuhan latihan intensif.
                        </p>

                        <div class="border-l-4 border-slate-300 pl-5 italic mt-6 text-slate-600">
                            Fokus berikutnya adalah menjaga hidrasi sebelum latihan,
                            menambah sumber protein setelah olahraga, dan memastikan energi cukup untuk pemulihan otot.
                        </div>
                    @else
                        <p>
                            {{ $client->name }} masih membutuhkan pemantauan konsistensi pola makan.
                            Beberapa target nutrisi sudah mulai membaik, tetapi kepatuhan harian masih perlu ditingkatkan.
                        </p>

                        <div class="border-l-4 border-slate-300 pl-5 italic mt-6 text-slate-600">
                            Fokus berikutnya adalah membangun jadwal makan rutin,
                            meningkatkan hidrasi, dan menaikkan asupan nutrisi secara bertahap.
                        </div>
                    @endif

                </div>

                <div class="mt-6">
                    <p class="text-sm font-bold text-slate-600 mb-2">
                        Pembaruan Cepat
                    </p>

                    <input type="text"
                           class="w-full rounded-xl border-0 bg-slate-100 px-5 py-4 text-sm"
                           placeholder="Tulis observasi singkat...">
                </div>

            </div>

            <!-- MAKANAN TERBARU -->
            <div class="col-span-5 bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[420px]">

                <div class="flex items-start justify-between mb-8">
                    <h2 class="text-[34px] leading-tight font-black text-slate-950">
                        Makanan Terbaru
                    </h2>

                    <span class="bg-emerald-100 text-emerald-700 text-xs px-4 py-2 rounded-full font-bold">
                        Hari Ini
                    </span>
                </div>

                <div class="space-y-7">

                    @if($client->program === 'Manajemen Berat Badan')
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-emerald-100"></div>
                                <div>
                                    <h3 class="font-black text-lg">Salad Ayam Panggang</h3>
                                    <p class="text-slate-400 text-sm">Makan Siang • 420g</p>
                                </div>
                            </div>
                            <p class="font-black text-lg">420 kkal</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-orange-100"></div>
                                <div>
                                    <h3 class="font-black text-lg">Overnight Oats</h3>
                                    <p class="text-slate-400 text-sm">Sarapan • 310g</p>
                                </div>
                            </div>
                            <p class="font-black text-lg">310 kkal</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-yellow-100"></div>
                                <div>
                                    <h3 class="font-black text-lg">Almond Panggang</h3>
                                    <p class="text-slate-400 text-sm">Camilan • 30g</p>
                                </div>
                            </div>
                            <p class="font-black text-lg">170 kkal</p>
                        </div>
                    @elseif($client->program === 'Nutrisi Olahraga')
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-blue-100"></div>
                                <div>
                                    <h3 class="font-black text-lg">Chicken Wrap Protein</h3>
                                    <p class="text-slate-400 text-sm">Makan Siang • 430g</p>
                                </div>
                            </div>
                            <p class="font-black text-lg">560 kkal</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-purple-100"></div>
                                <div>
                                    <h3 class="font-black text-lg">Smoothie Pisang Protein</h3>
                                    <p class="text-slate-400 text-sm">Setelah Latihan • 350g</p>
                                </div>
                            </div>
                            <p class="font-black text-lg">410 kkal</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-orange-100"></div>
                                <div>
                                    <h3 class="font-black text-lg">Steak Dada Ayam</h3>
                                    <p class="text-slate-400 text-sm">Makan Malam • 300g</p>
                                </div>
                            </div>
                            <p class="font-black text-lg">520 kkal</p>
                        </div>
                    @else
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-red-100"></div>
                                <div>
                                    <h3 class="font-black text-lg">Sup Ayam Kaldu</h3>
                                    <p class="text-slate-400 text-sm">Makan Siang • 350g</p>
                                </div>
                            </div>
                            <p class="font-black text-lg">380 kkal</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-yellow-100"></div>
                                <div>
                                    <h3 class="font-black text-lg">Oatmeal Pisang</h3>
                                    <p class="text-slate-400 text-sm">Sarapan • 280g</p>
                                </div>
                            </div>
                            <p class="font-black text-lg">290 kkal</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-blue-100"></div>
                                <div>
                                    <h3 class="font-black text-lg">Ikan Kukus Protein Tinggi</h3>
                                    <p class="text-slate-400 text-sm">Makan Malam • 300g</p>
                                </div>
                            </div>
                            <p class="font-black text-lg">410 kkal</p>
                        </div>
                    @endif

                </div>

                <button onclick="alert('Fitur buku harian makanan akan dikembangkan pada tahap berikutnya')"
                        class="w-full mt-8 border border-slate-200 rounded-xl py-3 text-sm font-bold text-slate-600">
                    Lihat Buku Harian Makanan
                </button>

            </div>

            <!-- MAKRO -->
            <div class="col-span-4 bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[220px]">

                <h3 class="text-xl font-black text-slate-950 mb-5">
                    Distribusi Makro Aktual
                </h3>

                <div class="space-y-4 text-sm">

                    <div>
                        <div class="flex justify-between mb-1">
                            <span>Protein</span>
                            <span class="font-bold">{{ $client->protein_target }}g target</span>
                        </div>
                        <div class="h-2 bg-slate-100 rounded-full">
                            <div class="h-2 bg-emerald-700 rounded-full w-[85%]"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-1">
                            <span>Karbohidrat</span>
                            <span class="font-bold">{{ $client->carb_target }}g target</span>
                        </div>
                        <div class="h-2 bg-slate-100 rounded-full">
                            <div class="h-2 bg-blue-500 rounded-full w-[78%]"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-1">
                            <span>Lemak</span>
                            <span class="font-bold">{{ $client->fat_target }}g target</span>
                        </div>
                        <div class="h-2 bg-slate-100 rounded-full">
                            <div class="h-2 bg-yellow-500 rounded-full w-[70%]"></div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- HIDRASI -->
            <div class="col-span-4 bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[220px]">

                <h3 class="text-xl font-black text-slate-950 mb-5">
                    Catatan Hidrasi Harian
                </h3>

                <p class="text-[56px] leading-none font-black text-blue-600">
                    {{ number_format($client->water_today / 1000, 1, ',', '.') }}L
                </p>

                <p class="text-slate-500 mt-3">
                    Target harian {{ number_format($client->water_target / 1000, 1, ',', '.') }}L
                </p>

                <div class="mt-5 h-2 bg-slate-100 rounded-full">
                    <div class="h-2 bg-blue-500 rounded-full"
                         style="width: {{ min(($client->water_today / $client->water_target) * 100, 100) }}%">
                    </div>
                </div>

            </div>

            <!-- TARGET MINGGUAN -->
            <div class="col-span-4 bg-white rounded-3xl p-7 shadow-sm border border-slate-100 min-h-[220px]">

                <h3 class="text-xl font-black text-slate-950 mb-5">
                    Target Mingguan
                </h3>

                <p class="text-[56px] leading-none font-black text-emerald-700">
                    {{ $client->adherence }}%
                </p>

                <p class="text-slate-500 mt-3">
                    Target nutrisi tercapai minggu ini.
                </p>

                <div class="mt-5 h-2 bg-slate-100 rounded-full">
                    <div class="h-2 bg-emerald-700 rounded-full"
                         style="width: {{ $client->adherence }}%">
                    </div>
                </div>

            </div>

        </div>

    </main>

</div>

<script>
    const grafikKlien = document.getElementById('grafikKlien');

    new Chart(grafikKlien, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [
                {
                    label: 'Aktual',
                    data: [
                        {{ max($client->adherence - 14, 0) }},
                        {{ max($client->adherence - 10, 0) }},
                        {{ max($client->adherence - 7, 0) }},
                        {{ max($client->adherence - 4, 0) }},
                        {{ max($client->adherence - 2, 0) }},
                        {{ max($client->adherence - 1, 0) }},
                        {{ $client->adherence }}
                    ],
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
                    min: 0,
                    max: 100,
                    ticks: {
                        stepSize: 20
                    }
                }
            }
        }
    });
</script>

</body>
</html>
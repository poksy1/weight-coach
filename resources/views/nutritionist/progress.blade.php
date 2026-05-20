<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Klien - WeightCoach</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-[#f4f7f6] text-slate-900">

@php
$clients = [
    [
        'id' => 1,
        'name' => 'Putri Amanda',
        'initial' => 'PA',
        'slug' => 'putri-amanda',
        'program' => 'Manajemen Berat Badan',
        'type' => 'weight',
        'meal_compliance' => 92,
        'water_compliance' => 93,
        'exercise_compliance' => 85,
        'updated' => '20 menit lalu',
        'color' => 'emerald',
        'bar_color' => 'bg-emerald-600',
        'notes' => 'Progress sangat baik. Konsistensi makan sehat meningkat dan hidrasi sudah stabil setiap hari.',
        'recommendation' => 'Pertahankan pola makan tinggi protein dan tambah latihan kardio ringan 3x seminggu.',
        'weight_start' => 78,
        'weight_now' => 72,
        'weight_target' => 70,
    ],
    [
        'id' => 2,
        'name' => 'Nanda Nabila',
        'initial' => 'NN',
        'slug' => 'nanda-nabila',
        'program' => 'Nutrisi Olahraga',
        'type' => 'sport',
        'meal_compliance' => 78,
        'water_compliance' => 91,
        'exercise_compliance' => 90,
        'updated' => '1 jam lalu',
        'color' => 'blue',
        'bar_color' => 'bg-blue-600',
        'notes' => 'Massa otot meningkat dengan baik namun asupan protein harian masih belum konsisten setiap hari latihan.',
        'recommendation' => 'Tambahkan protein shake setelah latihan dan pastikan tidur 7-8 jam untuk pemulihan optimal.',
        'kalori_harian' => 2400,
        'target_protein' => 140,
        'sesi_latihan' => 4,
        'target_sesi' => 5,
    ],
    [
        'id' => 3,
        'name' => 'Deta Amelia',
        'initial' => 'DA',
        'slug' => 'deta-amelia',
        'program' => 'Pemulihan Pola Makan',
        'type' => 'recovery',
        'meal_compliance' => 58,
        'water_compliance' => 84,
        'exercise_compliance' => 55,
        'updated' => '3 jam lalu',
        'color' => 'yellow',
        'bar_color' => 'bg-yellow-500',
        'notes' => 'Masih membutuhkan pendampingan terkait pola makan emosional dan membangun jadwal makan yang teratur.',
        'recommendation' => 'Fokus pada 3 jadwal makan tetap per hari, hindari melewatkan sarapan, dan perbanyak air putih.',
        'jadwal_terpenuhi' => 9,
        'target_jadwal' => 21,
        'hidrasi_harian' => 2100,
        'target_hidrasi' => 2500,
        'konsistensi_minggu' => 45,
        'mood_makan' => 'Cukup Stabil',
    ],
];

foreach ($clients as &$client) {
    $client['overall_score'] = round(
        ($client['meal_compliance'] + $client['water_compliance'] + $client['exercise_compliance']) / 3
    );

    if ($client['type'] === 'weight') {
        $targetDistance = abs($client['weight_start'] - $client['weight_target']);
        $currentDistance = abs($client['weight_now'] - $client['weight_target']);

        $client['progress_percent'] = $targetDistance > 0
            ? round((($targetDistance - $currentDistance) / $targetDistance) * 100)
            : 0;

        $client['progress_label'] = 'Progress Penurunan Berat';
        $client['progress_detail'] = $client['weight_now'] . 'kg dari target ' . $client['weight_target'] . 'kg';
    } elseif ($client['type'] === 'sport') {
        $client['progress_percent'] = $client['target_sesi'] > 0
            ? round(($client['sesi_latihan'] / $client['target_sesi']) * 100)
            : 0;

        $client['progress_label'] = 'Progress Sesi Latihan Minggu Ini';
        $client['progress_detail'] = $client['sesi_latihan'] . ' dari ' . $client['target_sesi'] . ' sesi latihan minggu ini';
    } else {
        $client['progress_percent'] = $client['target_jadwal'] > 0
            ? round(($client['jadwal_terpenuhi'] / $client['target_jadwal']) * 100)
            : 0;

        $client['progress_label'] = 'Progress Jadwal Makan Minggu Ini';
        $client['progress_detail'] = $client['jadwal_terpenuhi'] . ' dari ' . $client['target_jadwal'] . ' sesi makan minggu ini';
    }

    $client['progress_percent'] = max(0, min(100, $client['progress_percent']));

    if ($client['overall_score'] >= 85) {
        $client['status'] = 'Sangat Baik';
        $client['status_color'] = 'emerald';
    } elseif ($client['overall_score'] >= 70) {
        $client['status'] = 'Stabil';
        $client['status_color'] = 'blue';
    } elseif ($client['overall_score'] >= 55) {
        $client['status'] = 'Dipantau';
        $client['status_color'] = 'yellow';
    } else {
        $client['status'] = 'Perlu Perhatian';
        $client['status_color'] = 'red';
    }
}
unset($client);

$totalClients = count($clients);
$averageCompliance = round(collect($clients)->avg('overall_score'));
$bestClient = collect($clients)->sortByDesc('overall_score')->first();
$attentionClients = collect($clients)->where('overall_score', '<', 70)->count();
@endphp

<div class="min-h-screen flex">

    <aside class="fixed left-0 top-0 bottom-0 w-[245px] bg-white border-r border-slate-200 px-5 py-6 flex flex-col justify-between">
        <div>
            <h1 class="text-2xl font-black text-emerald-800">WeightCoach</h1>
            <p class="text-xs text-slate-500 mt-1">Kesehatan Harian</p>

            <nav class="mt-10 space-y-2 text-sm">
                <a href="{{ route('nutritionist.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">▦ Dashboard</a>
                <a href="{{ route('nutritionist.meal-plans') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">🍽 Rencana Makan</a>
                <a href="{{ route('nutritionist.water') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">♢ Pantau Air</a>
                <a href="{{ route('nutritionist.progress') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-700 text-white font-bold shadow-sm">⌁ Progress</a>
                <a href="{{ route('nutritionist.settings') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">⚙ Pengaturan</a>
            </nav>
        </div>

        <button onclick="openAddProgressModal()" class="w-full bg-emerald-800 hover:bg-emerald-900 transition text-white py-3 rounded-2xl font-black text-sm shadow-sm">
            + Catat Progress Baru
        </button>
    </aside>

    <main class="ml-[245px] flex-1 px-10 py-8 overflow-y-auto">

        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-[42px] leading-tight font-black text-emerald-900">Progress Klien</h1>
                <p class="text-slate-500 mt-2 text-base">Pantau perkembangan nutrisi, hidrasi, dan kepatuhan program klien.</p>
            </div>

            <div class="flex items-center gap-4">
                <button onclick="exportProgress()" class="bg-white border border-slate-200 px-5 py-3 rounded-2xl font-bold text-slate-600 shadow-sm hover:bg-slate-50 transition">
                    Ekspor Progress
                </button>

                <button onclick="openAddProgressModal()" class="bg-emerald-800 hover:bg-emerald-900 transition text-white px-5 py-3 rounded-2xl font-bold shadow-sm">
                    + Catat Progress
                </button>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-3xl p-7 border border-slate-100 shadow-sm">
                <p class="text-xs font-bold uppercase text-slate-400">Total Klien Aktif</p>
                <h2 class="text-[56px] leading-none font-black text-emerald-700 mt-4">{{ $totalClients }}</h2>
                <p class="text-sm text-slate-500 mt-3">klien dalam pemantauan aktif</p>
            </div>

            <div class="bg-white rounded-3xl p-7 border border-slate-100 shadow-sm">
                <p class="text-xs font-bold uppercase text-slate-400">Rata-rata Kepatuhan</p>
                <h2 class="text-[56px] leading-none font-black text-blue-600 mt-4">{{ $averageCompliance }}%</h2>
                <p class="text-sm text-slate-500 mt-3">seluruh program klien</p>
            </div>

            <div class="bg-white rounded-3xl p-7 border border-slate-100 shadow-sm">
                <p class="text-xs font-bold uppercase text-slate-400">Progress Terbaik</p>
                <h2 class="text-[28px] leading-tight font-black text-emerald-700 mt-4">{{ $bestClient['name'] }}</h2>
                <p class="text-sm text-slate-500 mt-3">{{ $bestClient['overall_score'] }}% kepatuhan</p>
            </div>

            <div class="bg-yellow-50 rounded-3xl p-7 border border-yellow-100 shadow-sm">
                <p class="text-xs font-bold uppercase text-yellow-700">Perlu Dipantau</p>
                <h2 class="text-[56px] leading-none font-black text-yellow-600 mt-4">{{ $attentionClients }}</h2>
                <p class="text-sm text-slate-500 mt-3">klien membutuhkan perhatian</p>
            </div>
        </div>

        <div class="bg-white border border-slate-100 rounded-3xl p-5 shadow-sm mb-8">
            <div class="flex gap-4">
                <input id="searchInput" type="text" placeholder="Cari nama klien..."
                    class="flex-1 bg-slate-100 border-0 rounded-2xl px-5 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">

                <button onclick="searchClient()" class="bg-emerald-700 hover:bg-emerald-800 transition text-white px-8 rounded-2xl font-black">
                    Cari
                </button>
            </div>

            <p id="emptySearch" class="hidden text-red-500 font-bold text-sm mt-4">Klien tidak ditemukan.</p>
        </div>

        <div class="grid grid-cols-12 gap-6 items-start">

            <div class="col-span-8 space-y-6">

                @foreach($clients as $client)
                    <div class="client-card bg-white rounded-3xl border border-slate-100 shadow-sm p-7"
                         data-name="{{ strtolower($client['name']) }}">

                        <div class="flex items-start justify-between mb-7">
                            <div class="flex gap-4 items-center">
                                <div class="w-14 h-14 rounded-2xl bg-{{ $client['color'] }}-100 text-{{ $client['color'] }}-700 flex items-center justify-center font-black text-xl flex-shrink-0">
                                    {{ $client['initial'] }}
                                </div>

                                <div>
                                    <h3 class="text-2xl font-black text-slate-900">{{ $client['name'] }}</h3>
                                    <p class="text-slate-500 text-sm mt-1">{{ $client['program'] }}</p>
                                    <p class="text-xs text-slate-400 mt-1">Update {{ $client['updated'] }}</p>
                                </div>
                            </div>

                            <span class="bg-{{ $client['status_color'] }}-100 text-{{ $client['status_color'] }}-700 px-4 py-2 rounded-full text-xs font-black whitespace-nowrap">
                                {{ $client['status'] }}
                            </span>
                        </div>

                        @if($client['type'] === 'weight')
                            <div class="grid grid-cols-4 gap-4 mb-7">
                                <div class="bg-slate-50 rounded-2xl p-4">
                                    <p class="text-xs uppercase text-slate-400 font-bold">Berat Awal</p>
                                    <p class="text-2xl font-black mt-2">{{ $client['weight_start'] }}kg</p>
                                </div>

                                <div class="bg-slate-50 rounded-2xl p-4">
                                    <p class="text-xs uppercase text-slate-400 font-bold">Berat Saat Ini</p>
                                    <p class="text-2xl font-black mt-2">{{ $client['weight_now'] }}kg</p>
                                </div>

                                <div class="bg-slate-50 rounded-2xl p-4">
                                    <p class="text-xs uppercase text-slate-400 font-bold">Target Berat</p>
                                    <p class="text-2xl font-black mt-2">{{ $client['weight_target'] }}kg</p>
                                </div>

                                <div class="bg-emerald-50 rounded-2xl p-4">
                                    <p class="text-xs uppercase text-emerald-600 font-bold">Penurunan</p>
                                    <p class="text-2xl font-black mt-2 text-emerald-700">{{ $client['weight_start'] - $client['weight_now'] }}kg</p>
                                </div>
                            </div>
                        @elseif($client['type'] === 'sport')
                            <div class="grid grid-cols-4 gap-4 mb-7">
                                <div class="bg-blue-50 rounded-2xl p-4">
                                    <p class="text-xs uppercase text-blue-600 font-bold">Kalori Harian</p>
                                    <p class="text-2xl font-black mt-2 text-blue-800">{{ number_format($client['kalori_harian']) }}</p>
                                    <p class="text-xs text-slate-400 mt-1">kkal / hari</p>
                                </div>

                                <div class="bg-blue-50 rounded-2xl p-4">
                                    <p class="text-xs uppercase text-blue-600 font-bold">Target Protein</p>
                                    <p class="text-2xl font-black mt-2 text-blue-800">{{ $client['target_protein'] }}g</p>
                                    <p class="text-xs text-slate-400 mt-1">per hari</p>
                                </div>

                                <div class="bg-slate-50 rounded-2xl p-4">
                                    <p class="text-xs uppercase text-slate-400 font-bold">Sesi Latihan</p>
                                    <p class="text-2xl font-black mt-2">{{ $client['sesi_latihan'] }}/{{ $client['target_sesi'] }}</p>
                                    <p class="text-xs text-slate-400 mt-1">minggu ini</p>
                                </div>

                                <div class="bg-emerald-50 rounded-2xl p-4">
                                    <p class="text-xs uppercase text-emerald-600 font-bold">Konsistensi</p>
                                    <p class="text-2xl font-black mt-2 text-emerald-700">{{ $client['progress_percent'] }}%</p>
                                    <p class="text-xs text-slate-400 mt-1">latihan terpenuhi</p>
                                </div>
                            </div>
                        @else
                            <div class="grid grid-cols-4 gap-4 mb-7">
                                <div class="bg-yellow-50 rounded-2xl p-4">
                                    <p class="text-xs uppercase text-yellow-600 font-bold">Jadwal Makan</p>
                                    <p class="text-2xl font-black mt-2 text-yellow-800">{{ $client['jadwal_terpenuhi'] }}/{{ $client['target_jadwal'] }}</p>
                                    <p class="text-xs text-slate-400 mt-1">sesi minggu ini</p>
                                </div>

                                <div class="bg-blue-50 rounded-2xl p-4">
                                    <p class="text-xs uppercase text-blue-600 font-bold">Hidrasi Harian</p>
                                    <p class="text-2xl font-black mt-2 text-blue-800">{{ number_format($client['hidrasi_harian'] / 1000, 1, ',', '.') }}L</p>
                                    <p class="text-xs text-slate-400 mt-1">target {{ number_format($client['target_hidrasi'] / 1000, 1, ',', '.') }}L</p>
                                </div>

                                <div class="bg-slate-50 rounded-2xl p-4">
                                    <p class="text-xs uppercase text-slate-400 font-bold">Konsistensi</p>
                                    <p class="text-2xl font-black mt-2">{{ $client['konsistensi_minggu'] }}%</p>
                                    <p class="text-xs text-slate-400 mt-1">minggu ini</p>
                                </div>

                                <div class="bg-emerald-50 rounded-2xl p-4">
                                    <p class="text-xs uppercase text-emerald-600 font-bold">Mood Makan</p>
                                    <p class="text-lg font-black mt-2 text-emerald-700 leading-tight">{{ $client['mood_makan'] }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="space-y-4 mb-7">
                            <div>
                                <div class="flex justify-between text-sm font-bold mb-2">
                                    <span>Kepatuhan Makan</span>
                                    <span class="text-emerald-700">{{ $client['meal_compliance'] }}%</span>
                                </div>
                                <div class="h-3 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-3 bg-emerald-600 rounded-full" style="width: {{ $client['meal_compliance'] }}%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between text-sm font-bold mb-2">
                                    <span>Hidrasi</span>
                                    <span class="text-blue-700">{{ $client['water_compliance'] }}%</span>
                                </div>
                                <div class="h-3 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-3 bg-blue-600 rounded-full" style="width: {{ $client['water_compliance'] }}%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between text-sm font-bold mb-2">
                                    <span>
                                        @if($client['type'] === 'sport')
                                            Konsistensi Latihan
                                        @elseif($client['type'] === 'recovery')
                                            Konsistensi Jadwal Makan
                                        @else
                                            Aktivitas Fisik
                                        @endif
                                    </span>
                                    <span class="text-yellow-600">{{ $client['exercise_compliance'] }}%</span>
                                </div>
                                <div class="h-3 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-3 bg-yellow-500 rounded-full" style="width: {{ $client['exercise_compliance'] }}%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- PROGRESS MENUJU TARGET -->
<div class="bg-slate-50 rounded-2xl p-5 mb-6">

    <div class="flex justify-between text-sm font-bold mb-3">
        <span>{{ $client['progress_label'] }}</span>
        <span class="text-{{ $client['color'] }}-700 font-black">
            {{ $client['progress_percent'] }}%
        </span>
    </div>

    <div class="h-4 bg-slate-200 rounded-full overflow-hidden">
        <div
            class="h-4 rounded-full transition-all {{ $client['bar_color'] }}"
            style="width: {{ $client['progress_percent'] }}%">
        </div>
    </div>

    <p class="text-xs text-slate-400 mt-2">
        {{ $client['progress_detail'] }}
    </p>

</div>

<!-- ACTIONS -->
<div class="grid grid-cols-2 gap-3">

    <button
        onclick='openDetailModal(@json($client))'
        class="w-full bg-emerald-700 hover:bg-emerald-800 transition text-white py-4 rounded-2xl font-black">
        Lihat Detail
    </button>

    <button
        onclick="openEvaluasiModal('{{ $client['name'] }}')"
        class="w-full bg-slate-100 hover:bg-slate-200 transition rounded-2xl font-bold text-slate-700">
        Kirim Evaluasi
    </button>

</div>

                    </div>
                @endforeach

            </div>

            <div class="col-span-4 space-y-6">

                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-7">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-[22px] font-black leading-tight text-slate-950">Ringkasan Mingguan</h2>
                        <span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full text-xs font-black">AKTIF</span>
                    </div>

                    <p class="text-xs text-slate-400 mb-5">Kepatuhan keseluruhan per klien</p>

                    <div class="h-[220px]">
                        <canvas id="progressChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-7">
    <h2 class="text-[22px] font-black leading-tight text-slate-950 mb-6">
        Progress per Program
    </h2>

    <div class="space-y-4">

        @foreach($clients as $client)

            <div class="bg-slate-50 rounded-2xl p-5">

                <div class="flex items-center justify-between mb-2">
                    <span class="font-black text-slate-900">
                        {{ $client['name'] }}
                    </span>

                    <span class="font-black text-{{ $client['color'] }}-700">
                        {{ $client['progress_percent'] }}%
                    </span>
                </div>

                <p class="text-xs text-slate-400 mb-4">
                    {{ $client['progress_label'] }}
                </p>

                <div class="h-3 bg-slate-200 rounded-full overflow-hidden">
                    @if($client['type'] === 'weight')
                        <div class="h-3 rounded-full"
                             style="width: {{ $client['progress_percent'] }}%; background-color: #059669;">
                        </div>
                    @elseif($client['type'] === 'sport')
                        <div class="h-3 rounded-full"
                             style="width: {{ $client['progress_percent'] }}%; background-color: #2563eb;">
                        </div>
                    @else
                        <div class="h-3 rounded-full"
                             style="width: {{ $client['progress_percent'] }}%; background-color: #eab308;">
                        </div>
                    @endif
                </div>

            </div>

        @endforeach

    </div>
</div>

                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-7">
                    <h2 class="text-[22px] font-black leading-tight text-slate-950 mb-6">Evaluasi Ahli Gizi</h2>

                    <div class="space-y-4">
                        @foreach($clients as $client)
                            <div class="rounded-2xl border border-slate-100 p-5">
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="font-black text-slate-900">{{ $client['name'] }}</h3>
                                    <span class="text-xs font-black bg-{{ $client['status_color'] }}-100 text-{{ $client['status_color'] }}-700 px-3 py-1 rounded-full">
                                        {{ $client['overall_score'] }}%
                                    </span>
                                </div>

                                <p class="text-sm text-slate-600 leading-6">{{ $client['notes'] }}</p>
                            </div>
                        @endforeach
                    </div>
                    
                </div>
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-7">
    <h2 class="text-[22px] font-black leading-tight text-slate-950 mb-6">
        Prioritas Tindak Lanjut
    </h2>

    <div class="space-y-4">

        <div class="rounded-2xl bg-emerald-50 border border-emerald-100 p-5">
            <p class="text-sm font-black text-emerald-800">
                Putri Amanda
            </p>
            <p class="text-sm text-slate-600 mt-2">
                Pertahankan pola makan dan aktivitas ringan.
            </p>
        </div>

        <div class="rounded-2xl bg-blue-50 border border-blue-100 p-5">
            <p class="text-sm font-black text-blue-800">
                Nanda Nabila
            </p>
            <p class="text-sm text-slate-600 mt-2">
                Tingkatkan konsistensi protein setelah latihan.
            </p>
        </div>

        <div class="rounded-2xl bg-yellow-50 border border-yellow-100 p-5">
            <p class="text-sm font-black text-yellow-800">
                Deta Amelia
            </p>
            <p class="text-sm text-slate-600 mt-2">
                Fokus pada jadwal makan teratur dan hidrasi.
            </p>
        </div>

    </div>
</div>

            </div>
            
        </div>

    </main>

</div>

<div id="detailModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-3xl w-full max-w-xl shadow-2xl overflow-y-auto max-h-[90vh] p-8">
        <div class="flex items-start justify-between mb-6">
            <div>
                <h2 id="modalClientName" class="text-3xl font-black text-slate-950"></h2>
                <p id="modalProgram" class="text-slate-500 mt-1 text-sm"></p>
            </div>

            <button onclick="closeDetailModal()" class="text-slate-400 hover:text-slate-700 text-3xl font-black leading-none">×</button>
        </div>

        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-emerald-50 rounded-2xl p-4 text-center">
                <p class="text-xs font-bold uppercase text-emerald-700">Kepatuhan Makan</p>
                <p id="modalMeal" class="text-3xl font-black text-emerald-700 mt-2"></p>
            </div>

            <div class="bg-blue-50 rounded-2xl p-4 text-center">
                <p class="text-xs font-bold uppercase text-blue-700">Hidrasi</p>
                <p id="modalWater" class="text-3xl font-black text-blue-700 mt-2"></p>
            </div>

            <div class="bg-yellow-50 rounded-2xl p-4 text-center">
                <p id="modalExerciseLabel" class="text-xs font-bold uppercase text-yellow-700">Aktivitas</p>
                <p id="modalExercise" class="text-3xl font-black text-yellow-600 mt-2"></p>
            </div>
        </div>

        <div class="mb-6">
            <div class="flex justify-between mb-2 font-bold text-sm">
                <span id="modalProgressLabel" class="text-slate-600"></span>
                <span id="modalProgressPercent" class="text-emerald-700"></span>
            </div>

            <div class="h-4 bg-slate-100 rounded-full overflow-hidden">
                <div id="modalProgressBar" class="h-4 bg-emerald-600 rounded-full transition-all"></div>
            </div>
        </div>

        <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-5 mb-4">
            <p class="text-xs font-black text-emerald-700 uppercase mb-3">Evaluasi Progress</p>
            <p id="modalNotes" class="text-slate-700 leading-7 text-sm"></p>
        </div>

        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 mb-6">
            <p class="text-xs font-black text-blue-700 uppercase mb-3">Rekomendasi Berikutnya</p>
            <p id="modalRecommendation" class="text-slate-700 leading-7 text-sm"></p>
        </div>

        <div class="flex justify-end">
            <button onclick="closeDetailModal()" class="px-5 py-3 rounded-xl bg-slate-100 font-bold text-slate-700 hover:bg-slate-200 transition">Tutup</button>
        </div>
    </div>
</div>

<div id="evaluasiModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-black text-slate-950">Kirim Evaluasi</h2>
            <button onclick="closeEvaluasiModal()" class="text-slate-400 hover:text-slate-700 text-3xl font-black leading-none">×</button>
        </div>

        <div class="space-y-4">
            <div>
                <label class="text-sm font-bold text-slate-600">Klien</label>
                <input id="evaluasiNama" type="text" readonly class="w-full mt-2 rounded-2xl border border-slate-200 px-4 py-3 bg-slate-100 font-bold text-slate-700">
            </div>

            <div>
                <label class="text-sm font-bold text-slate-600">Catatan Evaluasi</label>
                <textarea id="evaluasiCatatan" rows="4" placeholder="Tuliskan catatan evaluasi untuk klien..." class="w-full mt-2 rounded-2xl border border-slate-200 px-4 py-3 bg-slate-50 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-emerald-300"></textarea>
            </div>

            <div>
                <label class="text-sm font-bold text-slate-600">Rekomendasi</label>
                <select id="evaluasiRekomendasi" class="w-full mt-2 rounded-2xl border border-slate-200 px-4 py-3 bg-slate-50">
                    <option>Pertahankan pola makan saat ini</option>
                    <option>Tingkatkan asupan protein harian</option>
                    <option>Kurangi kalori dan perbanyak sayur</option>
                    <option>Tambah frekuensi makan kecil</option>
                    <option>Konsultasi lanjutan diperlukan</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-8">
            <button onclick="closeEvaluasiModal()" class="px-5 py-3 rounded-xl bg-slate-100 font-bold text-slate-700 hover:bg-slate-200 transition">Batal</button>
            <button onclick="sendEvaluation()" class="px-5 py-3 rounded-xl bg-emerald-700 text-white font-bold hover:bg-emerald-800 transition">Kirim Evaluasi</button>
        </div>
    </div>
</div>

<div id="addProgressModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-black text-slate-950">Catat Progress Baru</h2>
            <button onclick="closeAddProgressModal()" class="text-slate-400 hover:text-slate-700 text-3xl font-black leading-none">×</button>
        </div>

        <div class="space-y-4">
            <div>
                <label class="text-sm font-bold text-slate-600">Nama Klien</label>
                <select id="progressClient" onchange="toggleProgressFields()" class="w-full mt-2 rounded-2xl border border-slate-200 px-4 py-3 bg-slate-50">
                    <option value="weight">Putri Amanda</option>
                    <option value="sport">Nanda Nabila</option>
                    <option value="recovery">Deta Amelia</option>
                </select>
            </div>

            <div id="fieldWeight">
                <label class="text-sm font-bold text-slate-600">Berat Sekarang (kg)</label>
                <input id="progressWeight" type="number" min="30" max="200" placeholder="Contoh: 70" class="w-full mt-2 rounded-2xl border border-slate-200 px-4 py-3 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-emerald-300">
            </div>

            <div id="fieldSport" class="hidden">
                <label class="text-sm font-bold text-slate-600">Sesi Latihan Minggu Ini</label>
                <input id="progressTraining" type="number" min="0" max="7" placeholder="Contoh: 4" class="w-full mt-2 rounded-2xl border border-slate-200 px-4 py-3 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-emerald-300">
            </div>

            <div id="fieldRecovery" class="hidden">
                <label class="text-sm font-bold text-slate-600">Jadwal Makan Terpenuhi Minggu Ini</label>
                <input id="progressMealSchedule" type="number" min="0" max="21" placeholder="Contoh: 12" class="w-full mt-2 rounded-2xl border border-slate-200 px-4 py-3 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-emerald-300">
            </div>

            <div>
                <label class="text-sm font-bold text-slate-600">Catatan Progress</label>
                <textarea id="progressNote" rows="3" placeholder="Tuliskan perkembangan terbaru klien..." class="w-full mt-2 rounded-2xl border border-slate-200 px-4 py-3 bg-slate-50 resize-none text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300"></textarea>
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-8">
            <button onclick="closeAddProgressModal()" class="px-5 py-3 rounded-xl bg-slate-100 font-bold text-slate-700 hover:bg-slate-200 transition">Batal</button>
            <button onclick="saveProgress()" class="px-5 py-3 rounded-xl bg-emerald-700 text-white font-bold hover:bg-emerald-800 transition">Simpan Progress</button>
        </div>
    </div>
</div>

<script>
const progressData = @json($clients);

const ctx = document.getElementById('progressChart').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: progressData.map(client => client.name),
        datasets: [{
            label: 'Kepatuhan (%)',
            data: progressData.map(client => client.overall_score),
            borderRadius: 12,
            backgroundColor: ['#059669', '#2563eb', '#eab308'],
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 100,
                ticks: { stepSize: 25 },
                grid: { color: '#f1f5f9' }
            },
            x: {
                grid: { display: false },
                ticks: { font: { size: 10 } }
            }
        }
    }
});

function searchClient() {
    const keyword = document.getElementById('searchInput').value.toLowerCase().trim();
    const cards = document.querySelectorAll('.client-card');
    let visible = 0;

    cards.forEach(card => {
        const match = card.dataset.name.includes(keyword);
        card.style.display = match ? '' : 'none';
        if (match) visible++;
    });

    document.getElementById('emptySearch').classList.toggle('hidden', visible > 0);
}

document.getElementById('searchInput').addEventListener('keyup', searchClient);

function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
    document.getElementById(id).classList.add('flex');
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
    document.getElementById(id).classList.remove('flex');
}

function openDetailModal(client) {
    document.getElementById('modalClientName').innerText = client.name;
    document.getElementById('modalProgram').innerText = client.program;
    document.getElementById('modalNotes').innerText = client.notes;
    document.getElementById('modalRecommendation').innerText = client.recommendation;

    document.getElementById('modalMeal').innerText = client.meal_compliance + '%';
    document.getElementById('modalWater').innerText = client.water_compliance + '%';
    document.getElementById('modalExercise').innerText = client.exercise_compliance + '%';

    document.getElementById('modalProgressLabel').innerText = client.progress_label;
    document.getElementById('modalProgressPercent').innerText = client.progress_percent + '%';
    document.getElementById('modalProgressBar').style.width = client.progress_percent + '%';

    if (client.type === 'sport') {
        document.getElementById('modalExerciseLabel').innerText = 'Konsistensi Latihan';
    } else if (client.type === 'recovery') {
        document.getElementById('modalExerciseLabel').innerText = 'Konsistensi Jadwal';
    } else {
        document.getElementById('modalExerciseLabel').innerText = 'Aktivitas Fisik';
    }

    openModal('detailModal');
}

function closeDetailModal() {
    closeModal('detailModal');
}

function openEvaluasiModal(name) {
    document.getElementById('evaluasiNama').value = name;
    document.getElementById('evaluasiCatatan').value = '';
    openModal('evaluasiModal');
}

function closeEvaluasiModal() {
    closeModal('evaluasiModal');
}

function sendEvaluation() {
    const name = document.getElementById('evaluasiNama').value;
    const note = document.getElementById('evaluasiCatatan').value.trim();
    const recommendation = document.getElementById('evaluasiRekomendasi').value;

    if (!note) {
        alert('Catatan evaluasi tidak boleh kosong.');
        return;
    }

    closeEvaluasiModal();

    alert('Evaluasi untuk ' + name + ' berhasil dikirim.\nRekomendasi: ' + recommendation);
}

function toggleProgressFields() {
    const type = document.getElementById('progressClient').value;

    document.getElementById('fieldWeight').classList.toggle('hidden', type !== 'weight');
    document.getElementById('fieldSport').classList.toggle('hidden', type !== 'sport');
    document.getElementById('fieldRecovery').classList.toggle('hidden', type !== 'recovery');
}

function openAddProgressModal() {
    openModal('addProgressModal');
    toggleProgressFields();
}

function closeAddProgressModal() {
    closeModal('addProgressModal');
}

function saveProgress() {
    const type = document.getElementById('progressClient').value;
    const note = document.getElementById('progressNote').value.trim();

    if (type === 'weight' && !document.getElementById('progressWeight').value) {
        alert('Berat badan tidak boleh kosong.');
        return;
    }

    if (type === 'sport' && !document.getElementById('progressTraining').value) {
        alert('Jumlah sesi latihan tidak boleh kosong.');
        return;
    }

    if (type === 'recovery' && !document.getElementById('progressMealSchedule').value) {
        alert('Jumlah jadwal makan tidak boleh kosong.');
        return;
    }

    if (!note) {
        alert('Catatan progress tidak boleh kosong.');
        return;
    }

    closeAddProgressModal();

    document.getElementById('progressWeight').value = '';
    document.getElementById('progressTraining').value = '';
    document.getElementById('progressMealSchedule').value = '';
    document.getElementById('progressNote').value = '';

    alert('Progress baru berhasil disimpan.');
}

function exportProgress() {
    const now = new Date().toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });

    let report = 'LAPORAN PROGRESS KLIEN\n' + now + '\n\n';

    progressData.forEach(client => {
        report += '─────────────────────\n';
        report += client.name + '\n';
        report += 'Program: ' + client.program + '\n';
        report += 'Kepatuhan: ' + client.overall_score + '%\n';
        report += 'Progress: ' + client.progress_detail + '\n';
        report += 'Status: ' + client.status + '\n\n';
    });

    alert(report);
}

['detailModal', 'evaluasiModal', 'addProgressModal'].forEach(id => {
    document.getElementById(id).addEventListener('click', function(event) {
        if (event.target === this) {
            closeModal(id);
        }
    });
});
</script>

</body>
</html>
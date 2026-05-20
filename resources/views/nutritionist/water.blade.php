<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantau Air - Ahli Gizi</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f4f7f6] text-slate-900">

@php
    $clients = [
        [
            'name' => 'Putri Amanda',
            'initial' => 'PA',
            'program' => 'Manajemen Berat Badan',
            'route' => route('nutritionist.meal-plans'),
            'target' => 3000,
            'current' => 2800,
            'updated' => '20 menit lalu',
        ],
        [
            'name' => 'Nanda Nabila',
            'initial' => 'NN',
            'program' => 'Nutrisi Olahraga',
            'route' => route('nutritionist.meal-plans'),
            'target' => 3500,
            'current' => 3200,
            'updated' => '1 jam lalu',
        ],
        [
            'name' => 'Deta Amelia',
            'initial' => 'DA',
            'program' => 'Pemulihan Pola Makan',
            'route' => route('nutritionist.meal-plans'),
            'target' => 2500,
            'current' => 2100,
            'updated' => '3 jam lalu',
        ],
    ];

    $totalTarget = collect($clients)->sum('target');
    $totalCurrent = collect($clients)->sum('current');

    $averagePercent = $totalTarget > 0
        ? round(($totalCurrent / $totalTarget) * 100)
        : 0;

    $averageLiter = count($clients) > 0
        ? round($totalCurrent / count($clients) / 1000, 1)
        : 0;

    $targetReached = collect($clients)
        ->filter(fn($client) => $client['current'] >= $client['target'])
        ->count();

    $needAttention = collect($clients)
        ->filter(fn($client) => ($client['current'] / $client['target']) < 0.9)
        ->count();
@endphp

<div class="min-h-screen flex">

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
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">
                    ▦ Dashboard
                </a>

                <a href="{{ route('nutritionist.meal-plans') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">
                    🍽 Rencana Makan
                </a>

                <a href="{{ route('nutritionist.water') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-700 text-white font-bold">
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
            onclick="openWaterModal()"
            class="w-full bg-emerald-800 text-white py-3 rounded-xl font-black text-sm hover:bg-emerald-900 transition">
            + Catat Air Minum
        </button>

    </aside>

    <main class="ml-[245px] flex-1 px-10 py-8 w-full overflow-y-auto">

        <div class="flex items-center justify-between mb-8">

            <div>
                <h1 class="text-[42px] leading-tight font-black text-emerald-900">
                    Pantau Air
                </h1>

                <p class="text-slate-500 mt-2 text-base">
                    Pantau hidrasi harian klien dan pastikan target air minum tercapai.
                </p>
            </div>

            <div class="flex items-center gap-4">

                <button
                    onclick="resetTodayData()"
                    class="bg-white border border-slate-200 px-5 py-3 rounded-2xl font-bold text-slate-600 shadow-sm hover:bg-slate-50 transition">
                    Reset Hari Ini
                </button>

                <button
                    onclick="exportWaterReport()"
                    class="bg-emerald-800 text-white px-5 py-3 rounded-2xl font-bold shadow-sm hover:bg-emerald-900 transition">
                    Ekspor Laporan
                </button>

            </div>

        </div>

        <div class="grid grid-cols-4 gap-6 mb-8">

            <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">
                <p class="text-xs text-slate-400 font-bold uppercase">
                    Rata-rata Hidrasi
                </p>

                <h2 id="averageLiter" class="text-[54px] leading-none font-black text-blue-600 mt-4">
                    {{ str_replace('.', ',', $averageLiter) }}L
                </h2>

                <p class="text-sm text-slate-500 mt-3">
                    konsumsi rata-rata hari ini
                </p>
            </div>

            <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">
                <p class="text-xs text-slate-400 font-bold uppercase">
                    Klien Mencapai Target
                </p>

                <h2 id="targetReached" class="text-[54px] leading-none font-black text-emerald-700 mt-4">
                    {{ $targetReached }}
                </h2>

                <p class="text-sm text-slate-500 mt-3">
                    dari {{ count($clients) }} klien aktif
                </p>
            </div>

            <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">
                <p class="text-xs text-slate-400 font-bold uppercase">
                    Perlu Dipantau
                </p>

                <h2 id="needAttention" class="text-[54px] leading-none font-black text-yellow-600 mt-4">
                    {{ $needAttention }}
                </h2>

                <p class="text-sm text-slate-500 mt-3">
                    hidrasi belum stabil
                </p>
            </div>

            <div class="bg-blue-50 rounded-3xl p-7 shadow-sm border border-blue-100">
                <p class="text-xs text-blue-600 font-bold uppercase">
                    Rekomendasi Hari Ini
                </p>

                <h2 id="recommendationText" class="text-2xl font-black text-slate-900 mt-4">
                    Tambah 400ml
                </h2>

                <p class="text-sm text-slate-500 mt-3">
                    untuk klien dengan hidrasi terendah
                </p>
            </div>

        </div>

        <div class="grid grid-cols-12 gap-6">

            <div class="col-span-8 bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                <div class="flex items-center justify-between mb-7">

                    <div>
                        <h2 class="text-[32px] leading-tight font-black text-slate-950">
                            Pemantauan Hidrasi Klien
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Data hidrasi harian berdasarkan target masing-masing klien.
                        </p>
                    </div>

                    <input
                        id="clientSearch"
                        type="text"
                        placeholder="Cari klien..."
                        class="rounded-full border-0 bg-slate-100 px-5 py-3 text-sm focus:ring-2 focus:ring-emerald-200">

                </div>

                <table class="w-full text-sm">

                    <thead>
                        <tr class="text-left text-xs text-slate-400 uppercase">
                            <th class="py-4">Klien</th>
                            <th>Program</th>
                            <th>Target</th>
                            <th>Hari Ini</th>
                            <th>Progress</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="clientTable" class="divide-y divide-slate-100">

                        @foreach($clients as $client)

                            @php
                                $percent = round(($client['current'] / $client['target']) * 100);
                                $remaining = max($client['target'] - $client['current'], 0);

                                if ($percent >= 100) {
                                    $statusText = 'Tercapai';
                                    $statusClass = 'bg-emerald-100 text-emerald-700';
                                    $barClass = 'bg-emerald-600';
                                } elseif ($percent >= 90) {
                                    $statusText = 'Baik';
                                    $statusClass = 'bg-blue-100 text-blue-700';
                                    $barClass = 'bg-blue-600';
                                } elseif ($percent >= 75) {
                                    $statusText = 'Dipantau';
                                    $statusClass = 'bg-yellow-100 text-yellow-700';
                                    $barClass = 'bg-yellow-500';
                                } else {
                                    $statusText = 'Rendah';
                                    $statusClass = 'bg-red-100 text-red-700';
                                    $barClass = 'bg-red-500';
                                }
                            @endphp

                            <tr
                                class="client-row"
                                data-name="{{ strtolower($client['name']) }}"
                                data-client="{{ $client['name'] }}"
                                data-target="{{ $client['target'] }}"
                                data-current="{{ $client['current'] }}">

                                <td class="py-5">
                                    <div class="flex items-center gap-3">

                                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-800 font-black">
                                            {{ $client['initial'] }}
                                        </div>

                                        <div>
                                            <a href="{{ $client['route'] }}"
                                               class="font-black hover:text-emerald-700">
                                                {{ $client['name'] }}
                                            </a>

                                            <p class="text-xs text-slate-400 update-text">
                                                Update {{ $client['updated'] }}
                                            </p>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    {{ $client['program'] }}
                                </td>

                                <td>
                                    {{ number_format($client['target'] / 1000, 1, ',', '.') }}L
                                </td>

                                <td>
                                    <span class="current-text font-black text-blue-600">
                                        {{ number_format($client['current'] / 1000, 1, ',', '.') }}L
                                    </span>
                                </td>

                                <td>
                                    <p class="percent-text text-xs text-slate-500 mb-1">
                                        {{ $percent }}%
                                    </p>

                                    <div class="w-28 h-2 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="progress-bar h-2 {{ $barClass }} rounded-full"
                                             style="width: {{ min($percent, 100) }}%">
                                        </div>
                                    </div>

                                    <p class="remaining-text text-xs text-slate-400 mt-1">
                                        Sisa {{ $remaining }}ml
                                    </p>
                                </td>

                                <td>
                                    <span class="status-badge {{ $statusClass }} px-3 py-1 rounded-full text-xs font-bold">
                                        {{ $statusText }}
                                    </span>
                                </td>

                                <td>
                                    <div class="flex gap-2">

                                        <button
                                            onclick="addWaterToClient(this, 250)"
                                            class="px-3 py-2 rounded-xl bg-blue-50 text-blue-700 text-xs font-black hover:bg-blue-100 transition">
                                            +250ml
                                        </button>

                                        <button
                                            onclick="openClientModal(this)"
                                            class="px-3 py-2 rounded-xl bg-emerald-50 text-emerald-700 text-xs font-black hover:bg-emerald-100 transition">
                                            Detail
                                        </button>

                                    </div>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

                <p id="emptySearch" class="hidden text-center text-red-500 font-bold mt-8">
                    Klien tidak ditemukan.
                </p>

            </div>

            <div class="col-span-4 space-y-6">

                <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                    <h2 class="text-[28px] leading-tight font-black text-slate-950 mb-6">
                        Ringkasan Hidrasi
                    </h2>

                    <div class="relative w-52 h-52 mx-auto rounded-full border-[18px] border-blue-600 flex items-center justify-center">

                        <div class="text-center">
                            <p id="averagePercent" class="text-[48px] leading-none font-black text-blue-600">
                                {{ $averagePercent }}%
                            </p>

                            <p class="text-xs font-bold text-slate-400 mt-2">
                                RATA-RATA TARGET
                            </p>
                        </div>

                    </div>

                    <div id="summaryList" class="mt-7 space-y-4 text-sm">

                        @foreach($clients as $client)

                            @php
                                $percent = round(($client['current'] / $client['target']) * 100);
                                $barClass = $percent >= 90 ? 'bg-blue-600' : 'bg-yellow-500';
                            @endphp

                            <div class="summary-item" data-client="{{ $client['name'] }}">
                                <div class="flex justify-between mb-1">
                                    <span>{{ $client['name'] }}</span>
                                    <b class="summary-percent">{{ $percent }}%</b>
                                </div>

                                <div class="h-2 bg-slate-100 rounded-full">
                                    <div class="summary-bar h-2 {{ $barClass }} rounded-full"
                                         style="width: {{ min($percent, 100) }}%">
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>

                </div>

                <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                    <h2 class="text-[28px] leading-tight font-black text-slate-950 mb-5">
                        Tambah Cepat
                    </h2>

                    <label class="text-sm font-bold text-slate-600">
                        Pilih Klien
                    </label>

                    <select id="quickClient"
                            class="w-full mt-2 rounded-2xl border border-slate-200 px-4 py-3 bg-slate-50">

                        @foreach($clients as $client)
                            <option value="{{ $client['name'] }}">
                                {{ $client['name'] }}
                            </option>
                        @endforeach

                    </select>

                    <div class="grid grid-cols-3 gap-3 mt-5">

                        <button onclick="quickAddWater(250)"
                                class="py-3 rounded-2xl bg-blue-50 text-blue-700 font-black hover:bg-blue-100 transition">
                            +250ml
                        </button>

                        <button onclick="quickAddWater(500)"
                                class="py-3 rounded-2xl bg-blue-50 text-blue-700 font-black hover:bg-blue-100 transition">
                            +500ml
                        </button>

                        <button onclick="quickAddWater(1000)"
                                class="py-3 rounded-2xl bg-blue-50 text-blue-700 font-black hover:bg-blue-100 transition">
                            +1L
                        </button>

                    </div>

                    <button onclick="openWaterModal()"
                            class="w-full mt-5 bg-emerald-700 text-white py-3 rounded-2xl font-black hover:bg-emerald-800 transition">
                        Catat Manual
                    </button>

                </div>

                <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                    <h2 class="text-[28px] leading-tight font-black text-slate-950 mb-5">
                        Catatan Ahli Gizi
                    </h2>

                    <div id="nutritionNote"
                         class="bg-blue-50 border border-blue-100 rounded-2xl p-5 text-sm leading-7 text-slate-700">
                        Klien dengan hidrasi rendah perlu diberi pengingat minum air secara berkala.
                    </div>

                    <button onclick="sendReminder()"
                            class="w-full mt-5 bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition">
                        Kirim Pengingat Hidrasi
                    </button>

                </div>

            </div>

        </div>

    </main>

</div>

<div id="waterModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-3xl p-8 w-full max-w-md">

        <h2 class="text-2xl font-black text-emerald-900">
            Catat Air Minum
        </h2>

        <p class="text-sm text-slate-500 mt-1">
            Tambahkan jumlah air minum untuk klien.
        </p>

        <div class="mt-6 space-y-4">

            <div>
                <label class="text-sm font-bold text-slate-600">
                    Klien
                </label>

                <select id="modalClient"
                        class="w-full mt-2 rounded-2xl border border-slate-200 px-4 py-3 bg-slate-50">

                    @foreach($clients as $client)
                        <option value="{{ $client['name'] }}">
                            {{ $client['name'] }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div>
                <label class="text-sm font-bold text-slate-600">
                    Jumlah Air
                </label>

                <input id="modalAmount"
                       type="number"
                       min="1"
                       value="250"
                       class="w-full mt-2 rounded-2xl border border-slate-200 px-4 py-3 bg-slate-50"
                       placeholder="Contoh: 250">
            </div>

        </div>

        <div class="flex justify-end gap-3 mt-8">

            <button onclick="closeWaterModal()"
                    class="px-5 py-3 rounded-xl bg-slate-100 font-bold">
                Batal
            </button>

            <button onclick="saveManualWater()"
                    class="px-5 py-3 rounded-xl bg-emerald-700 text-white font-bold">
                Simpan
            </button>

        </div>

    </div>

</div>

<div id="clientDetailModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-3xl p-8 w-full max-w-lg">

        <h2 id="detailName" class="text-2xl font-black text-emerald-900">
            Detail Klien
        </h2>

        <p id="detailProgram" class="text-sm text-slate-500 mt-1"></p>

        <div class="grid grid-cols-2 gap-4 mt-6">

            <div class="bg-blue-50 rounded-2xl p-5">
                <p class="text-xs font-bold text-blue-700 uppercase">
                    Minum Hari Ini
                </p>

                <h3 id="detailCurrent" class="text-3xl font-black text-blue-700 mt-2">
                    0L
                </h3>
            </div>

            <div class="bg-emerald-50 rounded-2xl p-5">
                <p class="text-xs font-bold text-emerald-700 uppercase">
                    Target
                </p>

                <h3 id="detailTarget" class="text-3xl font-black text-emerald-700 mt-2">
                    0L
                </h3>
            </div>

        </div>

        <div class="mt-6">
            <div class="flex justify-between font-bold">
                <span>Progress</span>
                <span id="detailPercent">0%</span>
            </div>

            <div class="h-3 bg-slate-100 rounded-full mt-2">
                <div id="detailBar" class="h-3 bg-blue-600 rounded-full" style="width: 0%"></div>
            </div>
        </div>

        <div class="mt-6 bg-slate-50 border border-slate-100 rounded-2xl p-5">
            <p id="detailAdvice" class="text-sm text-slate-600 leading-7"></p>
        </div>

        <div class="flex justify-end mt-8">

            <button onclick="closeClientModal()"
                    class="px-5 py-3 rounded-xl bg-emerald-700 text-white font-bold">
                Tutup
            </button>

        </div>

    </div>

</div>

<script>
function formatLiter(ml) {
    return (ml / 1000).toFixed(1).replace('.', ',') + 'L';
}

function getRows() {
    return document.querySelectorAll('.client-row');
}

function getStatus(percent) {
    if (percent >= 100) {
        return {
            text: 'Tercapai',
            badge: 'bg-emerald-100 text-emerald-700',
            bar: 'bg-emerald-600',
        };
    }

    if (percent >= 90) {
        return {
            text: 'Baik',
            badge: 'bg-blue-100 text-blue-700',
            bar: 'bg-blue-600',
        };
    }

    if (percent >= 75) {
        return {
            text: 'Dipantau',
            badge: 'bg-yellow-100 text-yellow-700',
            bar: 'bg-yellow-500',
        };
    }

    return {
        text: 'Rendah',
        badge: 'bg-red-100 text-red-700',
        bar: 'bg-red-500',
    };
}

function refreshRow(row) {
    const target = Number(row.dataset.target);
    const current = Number(row.dataset.current);
    const percent = Math.round((current / target) * 100);
    const remaining = Math.max(target - current, 0);
    const status = getStatus(percent);

    row.querySelector('.current-text').innerText = formatLiter(current);
    row.querySelector('.percent-text').innerText = percent + '%';
    row.querySelector('.remaining-text').innerText = 'Sisa ' + remaining + 'ml';

    const progressBar = row.querySelector('.progress-bar');
    progressBar.style.width = Math.min(percent, 100) + '%';
    progressBar.className = 'progress-bar h-2 rounded-full ' + status.bar;

    const badge = row.querySelector('.status-badge');
    badge.innerText = status.text;
    badge.className = 'status-badge px-3 py-1 rounded-full text-xs font-bold ' + status.badge;

    row.querySelector('.update-text').innerText = 'Update baru saja';
}

function refreshSummary() {
    const rows = getRows();

    let totalTarget = 0;
    let totalCurrent = 0;
    let reached = 0;
    let attention = 0;
    let lowestClient = null;
    let lowestRemaining = 0;

    rows.forEach(row => {
        const target = Number(row.dataset.target);
        const current = Number(row.dataset.current);
        const percent = Math.round((current / target) * 100);
        const remaining = Math.max(target - current, 0);

        totalTarget += target;
        totalCurrent += current;

        if (current >= target) reached++;
        if (percent < 90) attention++;

        if (remaining > lowestRemaining) {
            lowestRemaining = remaining;
            lowestClient = row.dataset.client;
        }

        const summary = document.querySelector(`.summary-item[data-client="${row.dataset.client}"]`);

        if (summary) {
            summary.querySelector('.summary-percent').innerText = percent + '%';

            const bar = summary.querySelector('.summary-bar');
            bar.style.width = Math.min(percent, 100) + '%';
            bar.className = 'summary-bar h-2 rounded-full ' + (percent >= 90 ? 'bg-blue-600' : 'bg-yellow-500');
        }
    });

    const averagePercent = totalTarget > 0 ? Math.round((totalCurrent / totalTarget) * 100) : 0;
    const averageLiter = rows.length > 0 ? totalCurrent / rows.length / 1000 : 0;

    document.getElementById('averagePercent').innerText = averagePercent + '%';
    document.getElementById('averageLiter').innerText = averageLiter.toFixed(1).replace('.', ',') + 'L';
    document.getElementById('targetReached').innerText = reached;
    document.getElementById('needAttention').innerText = attention;

    if (lowestClient) {
        document.getElementById('recommendationText').innerText = 'Tambah ' + lowestRemaining + 'ml';
        document.getElementById('nutritionNote').innerText =
            lowestClient + ' masih membutuhkan tambahan ' + lowestRemaining + 'ml air untuk mencapai target harian.';
    } else {
        document.getElementById('recommendationText').innerText = 'Semua tercapai';
        document.getElementById('nutritionNote').innerText =
            'Semua klien sudah mencapai target hidrasi harian.';
    }
}

function addWater(clientName, amount) {
    getRows().forEach(row => {
        if (row.dataset.client === clientName) {
            row.dataset.current = Number(row.dataset.current) + Number(amount);
            refreshRow(row);
        }
    });

    refreshSummary();
}

function addWaterToClient(button, amount) {
    const row = button.closest('.client-row');
    addWater(row.dataset.client, amount);
}

function quickAddWater(amount) {
    const clientName = document.getElementById('quickClient').value;
    addWater(clientName, amount);
}

function openWaterModal() {
    document.getElementById('waterModal').classList.remove('hidden');
    document.getElementById('waterModal').classList.add('flex');
}

function closeWaterModal() {
    document.getElementById('waterModal').classList.add('hidden');
    document.getElementById('waterModal').classList.remove('flex');
}

function saveManualWater() {
    const clientName = document.getElementById('modalClient').value;
    const amount = Number(document.getElementById('modalAmount').value);

    if (!amount || amount <= 0) {
        alert('Jumlah air harus lebih dari 0ml.');
        return;
    }

    addWater(clientName, amount);
    closeWaterModal();
}

function openClientModal(button) {
    const row = button.closest('.client-row');

    const clientName = row.dataset.client;
    const program = row.children[1].innerText;
    const target = Number(row.dataset.target);
    const current = Number(row.dataset.current);
    const percent = Math.round((current / target) * 100);
    const remaining = Math.max(target - current, 0);

    document.getElementById('detailName').innerText = clientName;
    document.getElementById('detailProgram').innerText = program;
    document.getElementById('detailCurrent').innerText = formatLiter(current);
    document.getElementById('detailTarget').innerText = formatLiter(target);
    document.getElementById('detailPercent').innerText = percent + '%';
    document.getElementById('detailBar').style.width = Math.min(percent, 100) + '%';

    if (remaining > 0) {
        document.getElementById('detailAdvice').innerText =
            clientName + ' masih perlu minum sekitar ' + remaining + 'ml air lagi untuk mencapai target harian.';
    } else {
        document.getElementById('detailAdvice').innerText =
            clientName + ' sudah mencapai target hidrasi harian.';
    }

    document.getElementById('clientDetailModal').classList.remove('hidden');
    document.getElementById('clientDetailModal').classList.add('flex');
}

function closeClientModal() {
    document.getElementById('clientDetailModal').classList.add('hidden');
    document.getElementById('clientDetailModal').classList.remove('flex');
}

function resetTodayData() {
    if (!confirm('Reset data air hari ini ke data awal?')) return;

    const initialData = {
        'Putri Amanda': 2800,
        'Nanda Nabila': 3200,
        'Deta Amelia': 2100,
    };

    getRows().forEach(row => {
        row.dataset.current = initialData[row.dataset.client];
        refreshRow(row);
    });

    refreshSummary();
}

function sendReminder() {
    const rows = Array.from(getRows());

    const lowest = rows.sort((a, b) => {
        const percentA = Number(a.dataset.current) / Number(a.dataset.target);
        const percentB = Number(b.dataset.current) / Number(b.dataset.target);
        return percentA - percentB;
    })[0];

    alert('Pengingat hidrasi berhasil dikirim ke ' + lowest.dataset.client + '.');
}

function exportWaterReport() {
    let report = 'LAPORAN HIDRASI HARI INI\n\n';

    getRows().forEach(row => {
        const target = Number(row.dataset.target);
        const current = Number(row.dataset.current);
        const percent = Math.round((current / target) * 100);

        report += row.dataset.client + '\n';
        report += 'Target: ' + formatLiter(target) + '\n';
        report += 'Hari ini: ' + formatLiter(current) + '\n';
        report += 'Progress: ' + percent + '%\n\n';
    });

    alert(report);
}

document.getElementById('clientSearch').addEventListener('keyup', function() {
    const keyword = this.value.toLowerCase();
    let visibleCount = 0;

    document.querySelectorAll('.client-row').forEach(row => {
        const name = row.dataset.name;

        if (name.includes(keyword)) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    document.getElementById('emptySearch').classList.toggle('hidden', visibleCount > 0);
});
</script>

</body>
</html>
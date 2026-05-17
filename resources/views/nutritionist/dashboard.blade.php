<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Ahli Gizi</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f7faf9] text-slate-900">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="fixed left-0 top-0 bottom-0 w-[245px] bg-white border-r border-slate-200 px-5 py-6 flex flex-col justify-between">

        <div>

            <!-- LOGO -->
            <div>
                <h1 class="text-2xl font-black text-emerald-800">
                    WeightCoach
                </h1>

                <p class="text-xs text-slate-500 mt-1">
                    Kesehatan Harian
                </p>
            </div>

            <!-- MENU -->
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

        <!-- BAWAH -->
        <div class="space-y-3 text-sm">

            <a href="#" class="block text-slate-500">
                ♙ Profil
            </a>

            <a href="#" class="block text-slate-500">
                ⓘ Bantuan
            </a>

            <button class="w-full py-2 border border-emerald-800 rounded-full text-emerald-800 font-bold">
                Ganti Role
            </button>

        </div>

    </aside>

    <!-- CONTENT -->
    <main class="ml-[245px] flex-1 px-16 py-10">

        <!-- HEADER -->
        <div class="flex justify-between items-start">

            <div>

                <h2 class="text-4xl font-black text-emerald-950">
                    Selamat Pagi, Dr. Hayes
                </h2>

                <p class="text-sm text-slate-500 mt-2">
                    Berikut ringkasan profesional Anda hari ini.
                </p>

            </div>

            <div class="flex gap-5 text-xl text-slate-600">

                <span>🔔</span>

                <span>📅</span>

            </div>

        </div>

        <!-- CARD -->
        <div class="grid grid-cols-3 gap-8 mt-10">

            <!-- CARD 1 -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">

                <p class="text-xs text-slate-400 font-bold uppercase">
                    Klien Aktif
                </p>

                <div class="flex justify-between mt-3">

                    <h3 class="text-5xl font-black text-emerald-900">
                       {{ $activeClients }}
                    </h3>

                    <div class="text-5xl text-emerald-100">
                        👥
                    </div>

                </div>

                <p class="text-xs text-emerald-600 mt-3">
                    ↗ +3 minggu ini
                </p>

            </div>

            <!-- CARD 2 -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">

                <p class="text-xs text-slate-400 font-bold uppercase">
                    Pesan Menunggu
                </p>

                <div class="flex justify-between mt-3">

                    <h3 class="text-5xl font-black text-emerald-900">
                       {{ $pendingMessages }}
                    </h3>

                    <div class="text-5xl text-emerald-100">
                        ✉
                    </div>

                </div>

                <p class="text-xs text-slate-400 mt-3">
                    2 perlu balasan segera
                </p>

            </div>

            <!-- CARD 3 -->
            <div class="bg-emerald-50 rounded-3xl p-8 shadow-sm border border-emerald-100">

                <p class="text-xs text-emerald-900 font-bold uppercase">
                    Konsultasi Berikutnya
                </p>

                <h3 class="text-xl font-black text-emerald-950 mt-3">
                    {{ $nextConsultation }}
                </h3>

                <p class="text-sm text-slate-500">
                    10.30 • Konsultasi Daring
                </p>

                <button class="mt-4 bg-emerald-800 text-white px-6 py-2 rounded-full text-sm font-bold shadow">
                    Masuk
                </button>

            </div>

        </div>

        <!-- TABEL -->
        <section class="bg-white rounded-[32px] p-9 shadow-sm border border-slate-100 mt-10">

            <!-- TOP -->
            <div class="flex justify-between items-center mb-8">

                <h3 class="text-3xl font-black text-emerald-950">
                    Ringkasan Klien
                </h3>

                <div class="flex gap-3">

                    <input
                        class="rounded-full border-0 bg-slate-100 px-5 py-2 text-sm"
                        placeholder="Cari klien..."
                    >

                    <button class="w-10 h-10 rounded-full bg-slate-100">
                        ☰
                    </button>

                </div>

            </div>

            <!-- TABLE -->
            <table class="w-full text-sm">

                <thead>

                    <tr class="text-left text-xs text-slate-400 uppercase">

                        <th class="py-4">
                            Klien
                        </th>

                        <th>
                            Program
                        </th>

                        <th>
                            Risiko
                        </th>

                        <th>
                            Kepatuhan
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

    @foreach ($clients as $client)

        <tr>

            <td class="py-5">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-800 font-black">

                        {{ strtoupper(substr($client->name, 0, 1)) }}
                        {{ strtoupper(substr(explode(' ', $client->name)[1] ?? '', 0, 1)) }}

                    </div>

                    <div>

                        <p class="font-bold">
                            {{ $client->name }}
                        </p>

                        <p class="text-xs text-slate-400">
                            Diperbarui {{ $client->updated_at->diffForHumans() }}
                        </p>

                    </div>

                </div>

            </td>

            <td>
                {{ $client->program }}
            </td>

            <td>

                @if ($client->risk_level === 'low')

                    <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold">
                        Rendah
                    </span>

                @elseif ($client->risk_level === 'moderate')

                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">
                        Sedang
                    </span>

                @else

                    <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-bold">
                        Tinggi
                    </span>

                @endif

            </td>

            <td>

                <p class="text-xs text-slate-500 mb-1">
                    {{ $client->adherence }}% target
                </p>

                <div class="w-32 h-2 bg-slate-100 rounded-full">

                    <div
                        class="h-2 rounded-full

                        @if ($client->risk_level === 'high')
                            bg-red-500
                        @elseif ($client->risk_level === 'moderate')
                            bg-yellow-500
                        @else
                            bg-emerald-700
                        @endif"

                        style="width: {{ $client->adherence }}%">
                    </div>

                </div>

            </td>

            <td>

                <a href="{{ route('nutritionist.clients.show', $client->slug) }}"
                   class="bg-emerald-700 text-white px-4 py-2 rounded-lg text-xs font-bold">

                    Lihat Detail

                </a>

            </td>

        </tr>

    @endforeach

</tbody>

            </table>

            <!-- BUTTON -->
            <div class="text-center mt-6">

                <button class="text-emerald-800 font-bold text-sm">
                    Lihat Semua Klien →
                </button>

            </div>

        </section>

    </main>

</div>

</body>
</html>
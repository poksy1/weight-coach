<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Klien - Ahli Gizi</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

                <a href="{{ route('nutritionist.meal-plans') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    🍽 Rencana Makan
                </a>

                <a href="{{ route('nutritionist.water') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    ♢ Pantau Air
                </a>

                <a href="{{ route('nutritionist.progress') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-emerald-700 text-white font-bold">
                    ⌁ Progress
                </a>

                <a href="{{ route('nutritionist.settings') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    ⚙ Pengaturan
                </a>

            </nav>

        </div>

        <button onclick="alert('Fitur laporan progress akan dikembangkan pada tahap berikutnya')"
                class="w-full bg-emerald-800 text-white py-3 rounded-lg font-bold text-sm">
            + Buat Laporan Progress
        </button>

    </aside>

    <!-- CONTENT -->
    <main class="ml-[245px] flex-1 px-10 py-8 overflow-y-auto">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-8">

            <div>
                <h1 class="text-[42px] leading-tight font-black text-emerald-900">
                    Progress Klien
                </h1>

                <p class="text-slate-500 mt-2 text-base">
                    Pantau perkembangan program nutrisi dan kesehatan setiap klien.
                </p>
            </div>

            <div class="flex items-center gap-4">

                <button class="bg-white border border-slate-200 px-5 py-3 rounded-2xl font-bold text-slate-600 shadow-sm">
                    Minggu Ini
                </button>

                <button onclick="alert('Fitur ekspor laporan akan dikembangkan pada tahap berikutnya')"
                        class="bg-emerald-800 text-white px-5 py-3 rounded-2xl font-bold shadow-sm">
                    Ekspor Progress
                </button>

            </div>

        </div>

        <!-- CARD STATISTIK -->
        <div class="grid grid-cols-4 gap-6 mb-8">

            <!-- CARD -->
            <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                <p class="text-xs text-slate-400 font-bold uppercase">
                    Klien Aktif
                </p>

                <h2 class="text-[56px] leading-none font-black text-emerald-700 mt-4">
                    3
                </h2>

                <p class="text-sm text-slate-500 mt-3">
                    klien dalam pemantauan
                </p>

            </div>

            <!-- CARD -->
            <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                <p class="text-xs text-slate-400 font-bold uppercase">
                    Progress Terbaik
                </p>

                <h2 class="text-[56px] leading-none font-black text-blue-600 mt-4">
                    92%
                </h2>

                <p class="text-sm text-slate-500 mt-3">
                    Putri Amanda
                </p>

            </div>

            <!-- CARD -->
            <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                <p class="text-xs text-slate-400 font-bold uppercase">
                    Perlu Perhatian
                </p>

                <h2 class="text-[56px] leading-none font-black text-yellow-600 mt-4">
                    1
                </h2>

                <p class="text-sm text-slate-500 mt-3">
                    progress belum stabil
                </p>

            </div>

            <!-- CARD -->
            <div class="bg-blue-50 rounded-3xl p-7 shadow-sm border border-blue-100">

                <p class="text-xs text-blue-600 font-bold uppercase">
                    Target Mingguan
                </p>

                <h2 class="text-[34px] leading-tight font-black text-slate-900 mt-4">
                    85% Kepatuhan
                </h2>

                <p class="text-sm text-slate-500 mt-3">
                    rata-rata seluruh klien
                </p>

            </div>

        </div>

        <!-- GRID -->
        <div class="grid grid-cols-12 gap-6">

            <!-- TABEL -->
            <div class="col-span-8 bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                <div class="flex items-center justify-between mb-7">

                    <div>
                        <h2 class="text-[32px] leading-tight font-black text-slate-950">
                            Ringkasan Progress
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Evaluasi perkembangan program nutrisi klien.
                        </p>
                    </div>

                    <input
                        type="text"
                        placeholder="Cari klien..."
                        class="rounded-full border-0 bg-slate-100 px-5 py-3 text-sm"
                    >

                </div>

                <table class="w-full text-sm">

                    <thead>
                        <tr class="text-left text-xs text-slate-400 uppercase">
                            <th class="py-4">Klien</th>
                            <th>Program</th>
                            <th>Kepatuhan</th>
                            <th>Progress</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        <!-- PUTRI -->
                        <tr>

                            <td class="py-5">
                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-black">
                                        PA
                                    </div>

                                    <div>
                                        <p class="font-black">
                                            Putri Amanda
                                        </p>

                                        <p class="text-xs text-slate-400">
                                            Update 1 jam lalu
                                        </p>
                                    </div>

                                </div>
                            </td>

                            <td>
                                Manajemen Berat Badan
                            </td>

                            <td>
                                <span class="font-black text-emerald-700">
                                    92%
                                </span>
                            </td>

                            <td>
                                <div class="w-28 h-2 bg-slate-100 rounded-full">
                                    <div class="h-2 bg-emerald-600 rounded-full w-[92%]"></div>
                                </div>
                            </td>

                            <td>
                                <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold">
                                    Sangat Baik
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('nutritionist.putri') }}"
                                   class="text-emerald-700 font-bold hover:underline">
                                    Lihat Detail
                                </a>
                            </td>

                        </tr>

                        <!-- NANDA -->
                        <tr>

                            <td class="py-5">
                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-black">
                                        NN
                                    </div>

                                    <div>
                                        <p class="font-black">
                                            Nanda Nabila
                                        </p>

                                        <p class="text-xs text-slate-400">
                                            Update 2 jam lalu
                                        </p>
                                    </div>

                                </div>
                            </td>

                            <td>
                                Nutrisi Olahraga
                            </td>

                            <td>
                                <span class="font-black text-blue-700">
                                    76%
                                </span>
                            </td>

                            <td>
                                <div class="w-28 h-2 bg-slate-100 rounded-full">
                                    <div class="h-2 bg-blue-600 rounded-full w-[76%]"></div>
                                </div>
                            </td>

                            <td>
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                                    Stabil
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('nutritionist.nanda') }}"
                                   class="text-emerald-700 font-bold hover:underline">
                                    Lihat Detail
                                </a>
                            </td>

                        </tr>

                        <!-- DETA -->
                        <tr>

                            <td class="py-5">
                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-700 font-black">
                                        DA
                                    </div>

                                    <div>
                                        <p class="font-black">
                                            Deta Amelia
                                        </p>

                                        <p class="text-xs text-slate-400">
                                            Update 4 jam lalu
                                        </p>
                                    </div>

                                </div>
                            </td>

                            <td>
                                Pemulihan Pola Makan
                            </td>

                            <td>
                                <span class="font-black text-yellow-600">
                                    45%
                                </span>
                            </td>

                            <td>
                                <div class="w-28 h-2 bg-slate-100 rounded-full">
                                    <div class="h-2 bg-yellow-500 rounded-full w-[45%]"></div>
                                </div>
                            </td>

                            <td>
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">
                                    Dipantau
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('nutritionist.deta') }}"
                                   class="text-emerald-700 font-bold hover:underline">
                                    Lihat Detail
                                </a>
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

            <!-- PANEL KANAN -->
            <div class="col-span-4 space-y-6">

                <!-- GRAFIK -->
                <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                    <h2 class="text-[28px] leading-tight font-black text-slate-950 mb-6">
                        Ringkasan Mingguan
                    </h2>

                    <div class="space-y-6">

                        <div>
                            <div class="flex justify-between text-sm mb-2">
                                <span>Putri Amanda</span>
                                <span class="font-bold">92%</span>
                            </div>

                            <div class="h-3 bg-slate-100 rounded-full">
                                <div class="h-3 bg-emerald-600 rounded-full w-[92%]"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-sm mb-2">
                                <span>Nanda Nabila</span>
                                <span class="font-bold">76%</span>
                            </div>

                            <div class="h-3 bg-slate-100 rounded-full">
                                <div class="h-3 bg-blue-600 rounded-full w-[76%]"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-sm mb-2">
                                <span>Deta Amelia</span>
                                <span class="font-bold">45%</span>
                            </div>

                            <div class="h-3 bg-slate-100 rounded-full">
                                <div class="h-3 bg-yellow-500 rounded-full w-[45%]"></div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- CATATAN -->
                <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                    <h2 class="text-[28px] leading-tight font-black text-slate-950 mb-5">
                        Evaluasi Ahli Gizi
                    </h2>

                    <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-5 text-sm leading-7 text-slate-700">
                        Putri Amanda menunjukkan perkembangan yang sangat baik dalam kepatuhan pola makan.
                        Nanda Nabila membutuhkan peningkatan konsistensi konsumsi protein harian.
                        Deta Amelia masih memerlukan pendampingan lebih lanjut terkait pola makan emosional.
                    </div>

                    <button onclick="alert('Fitur kirim evaluasi akan dikembangkan pada tahap berikutnya')"
                            class="w-full mt-5 bg-emerald-800 text-white py-3 rounded-xl font-bold">
                        Kirim Evaluasi Progress
                    </button>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantau Air - Ahli Gizi</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

                <a href="{{ route('nutritionist.meal-plans') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    🍽 Rencana Makan
                </a>

                <a href="{{ route('nutritionist.water') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-emerald-700 text-white font-bold">
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
            <div>
                <h1 class="text-[42px] leading-tight font-black text-emerald-900">
                    Pantau Air
                </h1>

                <p class="text-slate-500 mt-2 text-base">
                    Pantau hidrasi harian klien dan pastikan target minum air tercapai.
                </p>
            </div>

            <div class="flex items-center gap-4">
                <button class="bg-white border border-slate-200 px-5 py-3 rounded-2xl font-bold text-slate-600 shadow-sm">
                    Hari Ini
                </button>

                <button onclick="alert('Laporan hidrasi akan dikembangkan pada tahap berikutnya')"
                        class="bg-emerald-800 text-white px-5 py-3 rounded-2xl font-bold shadow-sm">
                    Ekspor Laporan
                </button>
            </div>
        </div>

        <!-- CARD STATISTIK -->
        <div class="grid grid-cols-4 gap-6 mb-8">

            <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">
                <p class="text-xs text-slate-400 font-bold uppercase">
                    Rata-rata Hidrasi
                </p>

                <h2 class="text-[54px] leading-none font-black text-blue-600 mt-4">
                    2,7L
                </h2>

                <p class="text-sm text-slate-500 mt-3">
                    dari target rata-rata 3L
                </p>
            </div>

            <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">
                <p class="text-xs text-slate-400 font-bold uppercase">
                    Klien Mencapai Target
                </p>

                <h2 class="text-[54px] leading-none font-black text-emerald-700 mt-4">
                    2
                </h2>

                <p class="text-sm text-slate-500 mt-3">
                    dari 3 klien aktif
                </p>
            </div>

            <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">
                <p class="text-xs text-slate-400 font-bold uppercase">
                    Perlu Dipantau
                </p>

                <h2 class="text-[54px] leading-none font-black text-yellow-600 mt-4">
                    1
                </h2>

                <p class="text-sm text-slate-500 mt-3">
                    hidrasi belum stabil
                </p>
            </div>

            <div class="bg-blue-50 rounded-3xl p-7 shadow-sm border border-blue-100">
                <p class="text-xs text-blue-600 font-bold uppercase">
                    Rekomendasi Hari Ini
                </p>

                <h2 class="text-2xl font-black text-slate-900 mt-4">
                    Tambah 500ml
                </h2>

                <p class="text-sm text-slate-500 mt-3">
                    untuk klien dengan hidrasi rendah
                </p>
            </div>

        </div>

        <!-- GRID UTAMA -->
        <div class="grid grid-cols-12 gap-6">

            <!-- TABEL KLIEN -->
            <div class="col-span-8 bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                <div class="flex items-center justify-between mb-7">
                    <div>
                        <h2 class="text-[32px] leading-tight font-black text-slate-950">
                            Pemantauan Hidrasi Klien
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Data sementara untuk pemantauan hidrasi harian.
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
                            <th>Target</th>
                            <th>Minum Hari Ini</th>
                            <th>Progress</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        <!-- PUTRI -->
                        <tr>
                            <td class="py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-800 font-black">
                                        PA
                                    </div>

                                    <div>
                                        <a href="{{ route('nutritionist.putri') }}"
                                           class="font-black hover:text-emerald-700">
                                            Putri Amanda
                                        </a>

                                        <p class="text-xs text-slate-400">
                                            Update 20 menit lalu
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td>Manajemen Berat Badan</td>

                            <td>
                                3,0L
                            </td>

                            <td>
                                <span class="font-black text-blue-600">
                                    2,8L
                                </span>
                            </td>

                            <td>
                                <p class="text-xs text-slate-500 mb-1">
                                    93%
                                </p>

                                <div class="w-28 h-2 bg-slate-100 rounded-full">
                                    <div class="h-2 bg-blue-600 rounded-full w-[93%]"></div>
                                </div>
                            </td>

                            <td>
                                <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold">
                                    Baik
                                </span>
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
                                        <a href="{{ route('nutritionist.nanda') }}"
                                           class="font-black hover:text-emerald-700">
                                            Nanda Nabila
                                        </a>

                                        <p class="text-xs text-slate-400">
                                            Update 1 jam lalu
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td>Nutrisi Olahraga</td>

                            <td>
                                3,5L
                            </td>

                            <td>
                                <span class="font-black text-blue-600">
                                    3,2L
                                </span>
                            </td>

                            <td>
                                <p class="text-xs text-slate-500 mb-1">
                                    91%
                                </p>

                                <div class="w-28 h-2 bg-slate-100 rounded-full">
                                    <div class="h-2 bg-blue-600 rounded-full w-[91%]"></div>
                                </div>
                            </td>

                            <td>
                                <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold">
                                    Baik
                                </span>
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
                                        <a href="{{ route('nutritionist.deta') }}"
                                           class="font-black hover:text-emerald-700">
                                            Deta Amelia
                                        </a>

                                        <p class="text-xs text-slate-400">
                                            Update 3 jam lalu
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td>Pemulihan Pola Makan</td>

                            <td>
                                2,5L
                            </td>

                            <td>
                                <span class="font-black text-yellow-600">
                                    2,1L
                                </span>
                            </td>

                            <td>
                                <p class="text-xs text-slate-500 mb-1">
                                    84%
                                </p>

                                <div class="w-28 h-2 bg-slate-100 rounded-full">
                                    <div class="h-2 bg-yellow-500 rounded-full w-[84%]"></div>
                                </div>
                            </td>

                            <td>
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">
                                    Dipantau
                                </span>
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>

            <!-- PANEL KANAN -->
            <div class="col-span-4 space-y-6">

                <!-- RINGKASAN -->
                <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                    <h2 class="text-[28px] leading-tight font-black text-slate-950 mb-6">
                        Ringkasan Hidrasi
                    </h2>

                    <div class="w-48 h-48 rounded-full border-[16px] border-blue-600 flex items-center justify-center mx-auto">
                        <div class="text-center">
                            <p class="text-[48px] leading-none font-black text-blue-600">
                                89%
                            </p>

                            <p class="text-xs font-bold text-slate-400 mt-2">
                                RATA-RATA TARGET
                            </p>
                        </div>
                    </div>

                    <div class="mt-7 space-y-4 text-sm">
                        <div>
                            <div class="flex justify-between mb-1">
                                <span>Putri Amanda</span>
                                <b>93%</b>
                            </div>

                            <div class="h-2 bg-slate-100 rounded-full">
                                <div class="h-2 bg-blue-600 rounded-full w-[93%]"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between mb-1">
                                <span>Nanda Nabila</span>
                                <b>91%</b>
                            </div>

                            <div class="h-2 bg-slate-100 rounded-full">
                                <div class="h-2 bg-blue-600 rounded-full w-[91%]"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between mb-1">
                                <span>Deta Amelia</span>
                                <b>84%</b>
                            </div>

                            <div class="h-2 bg-slate-100 rounded-full">
                                <div class="h-2 bg-yellow-500 rounded-full w-[84%]"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- CATATAN -->
                <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                    <h2 class="text-[28px] leading-tight font-black text-slate-950 mb-5">
                        Catatan Ahli Gizi
                    </h2>

                    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 text-sm leading-7 text-slate-700">
                        Deta Amelia membutuhkan pengingat minum air lebih sering.
                        Disarankan menambah 1 gelas air setelah sarapan dan 1 gelas sebelum makan malam.
                    </div>

                    <button onclick="alert('Fitur kirim pengingat hidrasi akan dikembangkan pada tahap berikutnya')"
                            class="w-full mt-5 bg-blue-600 text-white py-3 rounded-xl font-bold">
                        Kirim Pengingat Hidrasi
                    </button>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>
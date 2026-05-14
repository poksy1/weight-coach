<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rencana Makan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f4f7f6] text-slate-900">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="fixed left-0 top-0 bottom-0 w-[245px] bg-white border-r border-slate-200 px-5 py-6 flex flex-col justify-between">

        <div>
            <h1 class="text-2xl font-black text-emerald-800">WeightCoach</h1>
            <p class="text-xs text-slate-500 mt-1">Kesehatan Harian</p>

            <nav class="mt-10 space-y-2 text-sm">
                <a href="{{ route('nutritionist.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    ▦ Dashboard
                </a>

                <a href="{{ route('nutritionist.meal-plans') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-emerald-700 text-white font-bold">
                    🍽 Rencana Makan
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    ♢ Pantau Air
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    ⌁ Progress
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    ⚙ Pengaturan
                </a>
            </nav>
        </div>

        <button class="w-full bg-emerald-800 text-white py-3 rounded-lg font-bold text-sm">
            + Catat Entri Baru
        </button>

    </aside>

    <!-- CONTENT -->
    <main class="ml-[245px] flex-1">

        <!-- HEADER -->
        <header class="h-[58px] bg-white border-b border-slate-200 flex items-center justify-between px-6">
            <h2 class="text-xl font-black text-emerald-900">WeightCoach</h2>

            <div class="flex items-center gap-5 text-slate-500">
                <span>📅</span>
                <span>🔔</span>
                <div class="w-9 h-9 rounded-full bg-slate-100"></div>
            </div>
        </header>

        <!-- SUB HEADER -->
        <div class="h-[42px] bg-blue-50 border-b border-blue-100 flex items-center px-6 gap-6 text-xs font-bold text-slate-600">
            <span class="text-emerald-800">▣ Penyusun Rencana Makan</span>
            <span>Draf: Klien_Putri_Amanda_Q3</span>
        </div>

        <!-- MAIN GRID -->
        <section class="p-6 grid grid-cols-12 gap-5">

            <!-- KIRI -->
            <div class="col-span-3 space-y-5">

                <!-- TARGET MAKRO -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 h-[210px]">
                    <div class="flex justify-between items-center">
                        <h3 class="font-black text-emerald-900">Target Makro</h3>
                        <span class="text-slate-500">☷</span>
                    </div>

                    <p class="text-sm text-slate-500 mt-6">Kalori Harian</p>

                    <div class="flex items-end gap-2 mt-2">
                        <span class="text-4xl font-black text-emerald-800">2400</span>
                        <span class="text-sm text-slate-500 mb-1">kkal</span>
                    </div>

                    <div class="grid grid-cols-3 gap-2 mt-5 text-center text-xs">

    <div>
        <p class="text-slate-500 mb-1">
            Protein
        </p>

        <p class="bg-emerald-50 text-emerald-700 py-2 rounded-lg font-bold">
            30%
        </p>
    </div>

    <div>
        <p class="text-slate-500 mb-1">
            Karbo
        </p>

        <p class="bg-blue-50 text-blue-700 py-2 rounded-lg font-bold">
            45%
        </p>
    </div>

    <div>
        <p class="text-slate-500 mb-1">
            Lemak
        </p>

        <p class="bg-yellow-50 text-yellow-700 py-2 rounded-lg font-bold">
            25%
        </p>
    </div>

</div>
                </div>

                <!-- DAFTAR RESEP -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 h-[455px]">
                    <h3 class="font-black text-emerald-900 mb-4">Daftar Resep</h3>

                    <input
                        type="text"
                        placeholder="Cari makanan sehat..."
                        class="w-full rounded-full border-0 bg-slate-100 text-sm px-4 py-2"
                    >

                    <div class="flex gap-2 mt-4 text-xs">
                        <span class="bg-emerald-700 text-white px-3 py-1 rounded-full">Protein Tinggi</span>
                        <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full">Vegan</span>
                    </div>

                    <div class="space-y-5 mt-6">
                        <div class="flex gap-3 items-center">
                            <div class="w-14 h-14 rounded-xl bg-emerald-100 flex-shrink-0"></div>

                            <div class="flex-1">
                                <p class="font-black text-sm">Quinoa Bowl</p>
                                <p class="text-xs text-slate-500">420 kkal</p>
                                <p class="text-xs text-slate-500">28g Protein</p>
                            </div>

                            <span class="text-slate-500">☷</span>
                        </div>

                        <div class="flex gap-3 items-center">
                            <div class="w-14 h-14 rounded-xl bg-orange-100 flex-shrink-0"></div>

                            <div class="flex-1">
                                <p class="font-black text-sm">Salmon Panggang</p>
                                <p class="text-xs text-slate-500">380 kkal</p>
                                <p class="text-xs text-slate-500">35g Protein</p>
                            </div>

                            <span class="text-slate-500">☷</span>
                        </div>

                        <div class="flex gap-3 items-center">
                            <div class="w-14 h-14 rounded-xl bg-blue-100 flex-shrink-0"></div>

                            <div class="flex-1">
                                <p class="font-black text-sm">Oat Pisang</p>
                                <p class="text-xs text-slate-500">310 kkal</p>
                                <p class="text-xs text-slate-500">12g Protein</p>
                            </div>

                            <span class="text-slate-500">☷</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- TENGAH -->
            <div class="col-span-6 bg-white rounded-xl border border-slate-200 shadow-sm h-[680px]">
                <div class="h-[80px] border-b border-slate-200 flex justify-between items-center px-6">
                    <h3 class="font-black text-emerald-900">Rencana Makan 7 Hari</h3>

                    <div class="flex gap-6 text-xl text-slate-700">
                        <span>‹</span>
                        <span>›</span>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-5 p-5">

                    <!-- SENIN -->
                    <div>
                        <div class="text-center border-b-2 border-emerald-700 pb-3 mb-4">
                            <p class="font-black text-emerald-900">SEN</p>
                            <p class="text-xs text-slate-500">14 Okt</p>
                        </div>

                        <div class="border border-dashed border-slate-300 rounded-lg p-3 mb-3 bg-slate-50 min-h-[90px]">
                            <p class="text-[10px] text-slate-400 uppercase">Sarapan</p>
                            <p class="font-black text-sm mt-1">Oat Pisang</p>
                            <p class="text-xs text-slate-500">310 kkal</p>
                        </div>

                        <div class="border border-dashed border-slate-300 rounded-lg p-3 mb-3 bg-slate-50 min-h-[90px]">
                            <p class="text-[10px] text-slate-400 uppercase">Makan Siang</p>
                            <p class="font-black text-sm mt-1">Quinoa Bowl</p>
                            <p class="text-xs text-slate-500">420 kkal</p>
                        </div>

                        <div class="border border-dashed border-slate-300 rounded-lg h-[110px] flex flex-col items-center justify-center text-slate-400 text-center">
                            <span class="text-xl">⊕</span>
                            <span>Tambahkan makan malam</span>
                        </div>
                    </div>

                    <!-- SELASA -->
                    <div>
                        <div class="text-center pb-3 mb-4">
                            <p class="font-black text-slate-500">SEL</p>
                            <p class="text-xs text-slate-500">15 Okt</p>
                        </div>

                        <div class="border border-dashed border-slate-300 rounded-lg h-[90px] flex items-center justify-center text-2xl text-slate-300 mb-3">+</div>
                        <div class="border border-dashed border-slate-300 rounded-lg h-[90px] flex items-center justify-center text-2xl text-slate-300 mb-3">+</div>
                        <div class="border border-dashed border-slate-300 rounded-lg h-[110px] flex items-center justify-center text-2xl text-slate-300">+</div>
                    </div>

                    <!-- RABU -->
                    <div>
                        <div class="text-center pb-3 mb-4">
                            <p class="font-black text-slate-500">RAB</p>
                            <p class="text-xs text-slate-500">16 Okt</p>
                        </div>

                        <div class="border border-dashed border-slate-300 rounded-lg h-[90px] flex items-center justify-center text-2xl text-slate-300 mb-3">+</div>
                        <div class="border border-dashed border-slate-300 rounded-lg h-[90px] flex items-center justify-center text-2xl text-slate-300 mb-3">+</div>
                        <div class="border border-dashed border-slate-300 rounded-lg h-[110px] flex items-center justify-center text-2xl text-slate-300">+</div>
                    </div>

                </div>
            </div>

         <!-- KANAN -->
<!-- KANAN -->
<div class="col-span-3 space-y-5">

    <!-- MAKRO REAL-TIME -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">

        <div class="flex items-center justify-between mb-6">
            <h3 class="font-black text-emerald-900">
                Makro Real-time
            </h3>

            <span class="text-[10px] bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full font-bold">
                LIVE
            </span>
        </div>

        <div class="relative w-44 h-44 mx-auto rounded-full bg conic-gradient">
            <div class="absolute inset-0 rounded-full"
                 style="background: conic-gradient(#047857 0deg 110deg, #2563eb 110deg 230deg, #f59e0b 230deg 295deg, #e5e7eb 295deg 360deg);">
            </div>

            <div class="absolute inset-[16px] bg-white rounded-full flex items-center justify-center">
                <div class="text-center">
                    <p class="text-4xl font-black text-emerald-900">
                        730
                    </p>
                    <p class="text-[10px] font-bold text-slate-500 tracking-widest">
                        KKAL TOTAL
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-7 space-y-5 text-sm">

            <div>
                <div class="flex justify-between mb-2">
                    <span class="font-semibold text-slate-700">
                        Protein
                    </span>
                    <span class="font-bold">
                        40g / 180g
                    </span>
                </div>

                <div class="h-2 bg-slate-100 rounded-full">
                    <div class="h-2 bg-emerald-700 rounded-full w-[22%]"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between mb-2">
                    <span class="font-semibold text-slate-700">
                        Karbo
                    </span>
                    <span class="font-bold">
                        65g / 270g
                    </span>
                </div>

                <div class="h-2 bg-slate-100 rounded-full">
                    <div class="h-2 bg-blue-600 rounded-full w-[24%]"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between mb-2">
                    <span class="font-semibold text-slate-700">
                        Lemak
                    </span>
                    <span class="font-bold">
                        18g / 65g
                    </span>
                </div>

                <div class="h-2 bg-slate-100 rounded-full">
                    <div class="h-2 bg-yellow-500 rounded-full w-[28%]"></div>
                </div>
            </div>

        </div>

    </div>

    <!-- KESESUAIAN TARGET -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 space-y-4">

        <p class="text-xs tracking-widest text-slate-500 uppercase">
            Kesesuaian Target Klien
        </p>

        <div class="bg-emerald-50 text-emerald-800 rounded-xl p-4 text-sm font-semibold">
            ✅ Target protein tinggi mulai terpenuhi
        </div>

        <div class="bg-yellow-50 text-yellow-700 rounded-xl p-4 text-sm font-semibold">
            ⓘ Tambahkan 15g lemak sehat untuk mencapai target
        </div>

        <hr>

        <button class="w-full text-left text-sm text-slate-700">
            ▣ Duplikat Rencana Senin
        </button>

        <button class="w-full text-left text-sm text-slate-700">
            ⇩ Ekspor PDF untuk Klien
        </button>

        <a href="{{ route('nutritionist.putri') }}"
           class="block w-full bg-emerald-800 text-white rounded-lg py-3 font-black text-center">
            ▷ Selesaikan & Bagikan
        </a>

    </div>

</div>

        </section>

    </main>

</div>

</body>
</html>
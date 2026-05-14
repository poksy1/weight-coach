<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Klien</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f4f7f6] text-slate-900">

<div class="min-h-screen flex">
    <aside class="fixed left-0 top-0 bottom-0 w-[245px] bg-white border-r border-slate-200 px-5 py-6 flex flex-col justify-between">
        <div>
            <h1 class="text-2xl font-black text-emerald-800">WeightCoach</h1>
            <p class="text-xs text-slate-500 mt-1">Kesehatan Harian</p>

            <nav class="mt-10 space-y-2 text-sm">
                <a href="{{ route('nutritionist.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-emerald-700 text-white font-bold">
                    ▦ Dashboard
                </a>
                <a href="{{ route('nutritionist.meal-plans') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    🍽 Makanan
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
            Catat Entri Baru
        </button>
    </aside>

    <main class="ml-[245px] flex-1">
        <header class="h-[58px] bg-white border-b border-slate-200 flex items-center justify-between px-6">
            <div class="flex items-center gap-3">
                <a href="{{ route('nutritionist.dashboard') }}" class="text-emerald-800 text-xl">←</a>
                <h2 class="font-black text-emerald-900">Profil Klien: Putri Amanda</h2>
            </div>

            <div class="flex items-center gap-5 text-slate-500">
                <span>📅</span>
                <span>🔔</span>
                <div class="w-9 h-9 rounded-full bg-emerald-100 flex items-center justify-center font-black text-emerald-800">P</div>
            </div>
        </header>

        <div class="h-[42px] bg-blue-50 border-b border-blue-100 flex items-center px-6 gap-8 text-xs font-bold text-slate-600">
            <span class="text-emerald-800">▣ Ringkasan Harian</span>
            <span>Metrik</span>
            <span>Riwayat Makan</span>
            <span>Catatan Klinis</span>
        </div>

        <section class="p-6 grid grid-cols-12 gap-5">
            <div class="col-span-8 bg-white rounded-xl shadow-sm border border-slate-100 p-6 h-[300px]">
                <div class="flex justify-between">
                    <h3 class="text-2xl font-bold">Kepatuhan Nutrisi (7 Hari Terakhir)</h3>
                    <div class="flex gap-5 text-xs font-semibold">
                        <span><span class="inline-block w-2 h-2 bg-emerald-800 rounded-full"></span> Aktual</span>
                        <span><span class="inline-block w-2 h-2 bg-blue-500 rounded-full"></span> Target</span>
                    </div>
                </div>

                <div class="h-[210px] relative mt-4">
                    <div class="absolute bottom-4 left-8 right-8 flex justify-between text-[10px] text-slate-600">
                        <span>SEN</span>
                        <span>SEL</span>
                        <span>RAB</span>
                        <span>KAM</span>
                        <span>JUM</span>
                        <span>SAB</span>
                        <span>MIN</span>
                    </div>
                </div>
            </div>

            <div class="col-span-4 space-y-5">
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 h-[140px]">
                    <p class="text-xs text-slate-500 uppercase tracking-wide">Rata-rata Selisih Kalori</p>
                    <h3 class="text-4xl font-black text-emerald-900 mt-4">
                        -124 <span class="text-sm font-normal">kkal / hari</span>
                    </h3>
                    <div class="mt-4 bg-emerald-50 text-emerald-800 text-xs font-bold rounded-lg px-3 py-2">
                        ⊙ Sesuai target penurunan berat badan
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 h-[140px] flex items-center">
                    <a href="{{ route('nutritionist.meal-plans') }}" class="bg-emerald-800 text-white py-4 rounded-xl font-black w-full text-center">
                        ▣ Tetapkan Rencana Makan Baru
                    </a>
                </div>
            </div>

            <div class="col-span-7 bg-white rounded-xl shadow-sm border border-slate-100 p-6 h-[300px]">
                <div class="flex justify-between">
                    <h3 class="text-2xl font-black text-slate-900">Catatan Profesional</h3>
                    <button class="text-sm text-emerald-800">Ubah Riwayat</button>
                </div>

                <div class="bg-slate-50 rounded-lg p-4 mt-4 text-sm text-slate-700 leading-relaxed">
                    <p>
                        <b>20 Des 2023:</b> Putri Amanda menunjukkan kepatuhan yang konsisten terhadap target protein
                        dengan rata-rata 140g. Namun, asupan natrium masih sedikit meningkat pada akhir pekan.
                        Ahli gizi menyarankan camilan tinggi protein untuk menjaga energi pada sore hari.
                    </p>

                    <div class="border-l-4 border-slate-300 pl-4 italic mt-4 text-slate-600">
                        Target berikutnya: tingkatkan hidrasi menjadi 3,5L per hari dan evaluasi respons tubuh
                        terhadap peningkatan karbohidrat berserat saat makan siang.
                    </div>
                </div>

                <p class="text-xs font-bold mt-4 mb-2">Pembaruan Cepat</p>
                <input type="text" class="w-full rounded-lg border-0 bg-slate-200 text-sm" placeholder="Tulis observasi singkat...">
            </div>

            <div class="col-span-5 bg-white rounded-xl shadow-sm border border-slate-100 p-6 h-[300px]">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-black">Makanan Terbaru</h3>
                    <span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold">Hari Ini</span>
                </div>

                <div class="space-y-5 mt-6">
                    <div class="flex justify-between items-center">
                        <div class="flex gap-3">
                            <div class="w-12 h-12 rounded-xl bg-emerald-100"></div>
                            <div>
                                <p class="font-black text-sm">Mangkuk Alpukat & Telur</p>
                                <p class="text-xs text-slate-500">Sarapan • 450g</p>
                            </div>
                        </div>
                        <p class="text-sm font-bold">540 kkal</p>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex gap-3">
                            <div class="w-12 h-12 rounded-xl bg-orange-100"></div>
                            <div>
                                <p class="font-black text-sm">Salmon & Quinoa</p>
                                <p class="text-xs text-slate-500">Makan Siang • 380g</p>
                            </div>
                        </div>
                        <p class="text-sm font-bold">620 kkal</p>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex gap-3">
                            <div class="w-12 h-12 rounded-xl bg-yellow-100"></div>
                            <div>
                                <p class="font-black text-sm">Kacang Almond</p>
                                <p class="text-xs text-slate-500">Camilan • 30g</p>
                            </div>
                        </div>
                        <p class="text-sm font-bold">170 kkal</p>
                    </div>
                </div>

                <button class="w-full border border-slate-200 rounded-lg py-2 text-xs mt-6">
                    Lihat Buku Harian Makanan
                </button>
            </div>

            <div class="col-span-4 bg-white rounded-xl shadow-sm border border-slate-100 p-6 h-[160px]">
                <h3 class="font-black">Distribusi Makro Aktual</h3>
            </div>

            <div class="col-span-4 bg-white rounded-xl shadow-sm border border-slate-100 p-6 h-[160px]">
                <h3 class="font-black">Catatan Hidrasi Harian</h3>
                <p class="text-4xl font-black text-blue-600 mt-5">2,8L</p>
            </div>

            <div class="col-span-4 bg-white rounded-xl shadow-sm border border-slate-100 p-6 h-[160px]">
                <h3 class="font-black">Target Mingguan</h3>
                <p class="text-sm text-slate-500 mt-5">80% target tercapai</p>
            </div>

            <div class="fixed right-6 bottom-6 w-14 h-14 bg-emerald-800 text-white rounded-full flex items-center justify-center text-3xl shadow-lg">
                +
            </div>
        </section>
    </main>
</div>

</body>
</html>
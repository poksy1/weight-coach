<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - Ahli Gizi</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f4f7f6] text-slate-900">

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
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50">
                    ⌁ Progress
                </a>

                <a href="{{ route('nutritionist.settings') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-emerald-700 text-white font-bold">
                    ⚙ Pengaturan
                </a>

            </nav>

        </div>

        <!-- BUTTON -->
        <button onclick="alert('Perubahan pengaturan akan disimpan ke database pada tahap berikutnya')"
                class="w-full bg-emerald-800 text-white py-3 rounded-lg font-bold text-sm">
            Simpan Semua Perubahan
        </button>

    </aside>

    <!-- CONTENT -->
    <main class="ml-[245px] flex-1 px-10 py-8 overflow-y-auto">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-8">

            <div>
                <h1 class="text-[42px] leading-tight font-black text-emerald-900">
                    Pengaturan
                </h1>

                <p class="text-slate-500 mt-2 text-base">
                    Kelola informasi akun, preferensi sistem, dan pengaturan ahli gizi.
                </p>
            </div>

            <div class="flex items-center gap-4">

                <button onclick="alert('Fitur backup data akan dikembangkan pada tahap berikutnya')"
                        class="bg-white border border-slate-200 px-5 py-3 rounded-2xl font-bold text-slate-600 shadow-sm">
                    Backup Data
                </button>

                <button onclick="alert('Pengaturan berhasil diperbarui')"
                        class="bg-emerald-800 text-white px-5 py-3 rounded-2xl font-bold shadow-sm">
                    Simpan Pengaturan
                </button>

            </div>

        </div>

        <!-- GRID -->
        <div class="grid grid-cols-12 gap-6">

            <!-- KIRI -->
            <div class="col-span-8 space-y-6">

                <!-- PROFIL -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">

                    <div class="flex items-center gap-5 mb-8">

                        <div class="w-24 h-24 rounded-full bg-emerald-100 flex items-center justify-center text-3xl font-black text-emerald-700">
                            AG
                        </div>

                        <div>
                            <h2 class="text-[32px] leading-tight font-black text-slate-950">
                                Profil Ahli Gizi
                            </h2>

                            <p class="text-slate-500 mt-1">
                                Kelola data profesional dan informasi akun.
                            </p>
                        </div>

                    </div>

                    <!-- FORM -->
                    <div class="grid grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                value="Dr. Hayes"
                                class="w-full rounded-2xl border border-slate-200 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">
                                Email
                            </label>

                            <input
                                type="email"
                                value="hayes@weightcoach.com"
                                class="w-full rounded-2xl border border-slate-200 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">
                                Nomor Telepon
                            </label>

                            <input
                                type="text"
                                value="+62 812 3456 7890"
                                class="w-full rounded-2xl border border-slate-200 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">
                                Spesialisasi
                            </label>

                            <input
                                type="text"
                                value="Manajemen Nutrisi dan Diet"
                                class="w-full rounded-2xl border border-slate-200 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            >
                        </div>

                    </div>

                    <!-- BIO -->
                    <div class="mt-6">

                        <label class="block text-sm font-bold text-slate-600 mb-2">
                            Deskripsi Profesional
                        </label>

                        <textarea
                            rows="5"
                            class="w-full rounded-2xl border border-slate-200 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        >Ahli gizi dengan fokus pada manajemen berat badan, nutrisi olahraga, dan pemulihan pola makan sehat untuk gaya hidup berkelanjutan.</textarea>

                    </div>

                </div>

                <!-- PREFERENSI -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">

                    <h2 class="text-[30px] leading-tight font-black text-slate-950 mb-7">
                        Preferensi Sistem
                    </h2>

                    <div class="space-y-6">

                        <!-- ITEM -->
                        <div class="flex items-center justify-between">

                            <div>
                                <p class="font-bold text-slate-900">
                                    Notifikasi Email
                                </p>

                                <p class="text-sm text-slate-500 mt-1">
                                    Kirim pemberitahuan aktivitas klien melalui email.
                                </p>
                            </div>

                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">

                                <div class="w-14 h-8 bg-slate-200 rounded-full peer peer-checked:bg-emerald-600 transition"></div>

                                <div class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full transition peer-checked:translate-x-6"></div>
                            </label>

                        </div>

                        <!-- ITEM -->
                        <div class="flex items-center justify-between">

                            <div>
                                <p class="font-bold text-slate-900">
                                    Pengingat Hidrasi
                                </p>

                                <p class="text-sm text-slate-500 mt-1">
                                    Aktifkan pengingat konsumsi air untuk klien.
                                </p>
                            </div>

                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">

                                <div class="w-14 h-8 bg-slate-200 rounded-full peer peer-checked:bg-emerald-600 transition"></div>

                                <div class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full transition peer-checked:translate-x-6"></div>
                            </label>

                        </div>

                        <!-- ITEM -->
                        <div class="flex items-center justify-between">

                            <div>
                                <p class="font-bold text-slate-900">
                                    Laporan Mingguan Otomatis
                                </p>

                                <p class="text-sm text-slate-500 mt-1">
                                    Generate laporan progress klien setiap minggu.
                                </p>
                            </div>

                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">

                                <div class="w-14 h-8 bg-slate-200 rounded-full peer peer-checked:bg-emerald-600 transition"></div>

                                <div class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full transition peer-checked:translate-x-6"></div>
                            </label>

                        </div>

                    </div>

                </div>

            </div>

            <!-- KANAN -->
            <div class="col-span-4 space-y-6">

                <!-- STATUS AKUN -->
                <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                    <h2 class="text-[28px] leading-tight font-black text-slate-950 mb-6">
                        Status Akun
                    </h2>

                    <div class="space-y-5">

                        <div class="flex justify-between items-center">

                            <div>
                                <p class="text-sm text-slate-400">
                                    Role
                                </p>

                                <p class="font-black text-emerald-700 mt-1">
                                    Nutritionist
                                </p>
                            </div>

                            <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold">
                                Aktif
                            </span>

                        </div>

                        <hr>

                        <div>
                            <p class="text-sm text-slate-400">
                                Terakhir Login
                            </p>

                            <p class="font-bold mt-1">
                                Hari ini, 08:45
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-400">
                                Total Klien Aktif
                            </p>

                            <p class="font-bold mt-1">
                                3 Klien
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-400">
                                Status Verifikasi
                            </p>

                            <p class="font-bold text-blue-600 mt-1">
                                Terverifikasi
                            </p>
                        </div>

                    </div>

                </div>

                <!-- KEAMANAN -->
                <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                    <h2 class="text-[28px] leading-tight font-black text-slate-950 mb-6">
                        Keamanan
                    </h2>

                    <div class="space-y-4">

                        <button onclick="alert('Fitur ubah password akan dikembangkan pada tahap berikutnya')"
                                class="w-full bg-slate-100 hover:bg-slate-200 transition rounded-2xl py-4 font-bold text-slate-700">
                            Ubah Password
                        </button>

                        <button onclick="alert('Fitur autentikasi dua langkah akan dikembangkan pada tahap berikutnya')"
                                class="w-full bg-slate-100 hover:bg-slate-200 transition rounded-2xl py-4 font-bold text-slate-700">
                            Aktifkan 2FA
                        </button>

                        <button onclick="alert('Riwayat login akan dikembangkan pada tahap berikutnya')"
                                class="w-full bg-slate-100 hover:bg-slate-200 transition rounded-2xl py-4 font-bold text-slate-700">
                            Riwayat Login
                        </button>

                    </div>

                </div>

                <!-- INFORMASI SISTEM -->
                <div class="bg-blue-50 rounded-3xl p-7 border border-blue-100">

                    <h2 class="text-[26px] leading-tight font-black text-slate-950 mb-5">
                        Informasi Sistem
                    </h2>

                    <div class="space-y-4 text-sm">

                        <div class="flex justify-between">
                            <span class="text-slate-500">
                                Versi Sistem
                            </span>

                            <span class="font-bold">
                                v2.1.0
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-slate-500">
                                Status Server
                            </span>

                            <span class="font-bold text-emerald-700">
                                Online
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-slate-500">
                                Sinkronisasi
                            </span>

                            <span class="font-bold">
                                5 menit lalu
                            </span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>
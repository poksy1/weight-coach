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
            <h1 class="text-2xl font-black text-emerald-800">WeightCoach</h1>
            <p class="text-xs text-slate-500 mt-1">Kesehatan Harian</p>
            <nav class="mt-10 space-y-2 text-sm">
                <a href="{{ route('nutritionist.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">▦ Dashboard</a>
                <a href="{{ route('nutritionist.meal-plans') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">🍽 Rencana Makan</a>
                <a href="{{ route('nutritionist.water') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">♢ Pantau Air</a>
                <a href="{{ route('nutritionist.progress') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">⌁ Progress</a>
                <a href="{{ route('nutritionist.settings') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-700 text-white font-bold shadow-sm">⚙ Pengaturan</a>
            </nav>
        </div>
        <button onclick="simpanSemuaPerubahan()" class="w-full bg-emerald-800 hover:bg-emerald-900 transition text-white py-3 rounded-2xl font-black text-sm shadow-sm">
            Simpan Semua Perubahan
        </button>
    </aside>

    <!-- CONTENT -->
    <main class="ml-[245px] flex-1 px-10 py-8 overflow-y-auto">

        <!-- NOTIFIKASI -->
        <div id="toastSuccess" class="hidden fixed top-6 right-6 z-50 bg-emerald-700 text-white px-6 py-4 rounded-2xl shadow-xl font-bold text-sm transition">
            ✓ <span id="toastMessage">Perubahan berhasil disimpan.</span>
        </div>
        <div id="toastError" class="hidden fixed top-6 right-6 z-50 bg-red-600 text-white px-6 py-4 rounded-2xl shadow-xl font-bold text-sm">
            ✕ <span id="toastErrorMessage">Terjadi kesalahan.</span>
        </div>

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-[42px] leading-tight font-black text-emerald-900">Pengaturan</h1>
                <p class="text-slate-500 mt-2 text-base">Kelola informasi akun, preferensi sistem, dan pengaturan ahli gizi.</p>
            </div>
            <div class="flex items-center gap-4">
                <button onclick="backupData()" class="bg-white border border-slate-200 px-5 py-3 rounded-2xl font-bold text-slate-600 shadow-sm hover:bg-slate-50 transition">
                    Backup Data
                </button>
                <button onclick="simpanPengaturan()" class="bg-emerald-800 hover:bg-emerald-900 transition text-white px-5 py-3 rounded-2xl font-bold shadow-sm">
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
                        <div class="relative">
                            <div id="avatarDisplay" class="w-24 h-24 rounded-full bg-emerald-100 flex items-center justify-center text-3xl font-black text-emerald-700">
                                AG
                            </div>
                            <button onclick="gantiFoto()" class="absolute bottom-0 right-0 w-8 h-8 bg-emerald-700 rounded-full text-white text-xs flex items-center justify-center hover:bg-emerald-800 transition">
                                ✎
                            </button>
                        </div>
                        <div>
                            <h2 class="text-[32px] leading-tight font-black text-slate-950">Profil Ahli Gizi</h2>
                            <p class="text-slate-500 mt-1">Kelola data profesional dan informasi akun.</p>
                        </div>
                    </div>

                    <!-- FORM -->
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Nama Lengkap</label>
                            <input id="inputNama" type="text" value="Dr. Hayes"
                                class="w-full rounded-2xl border border-slate-200 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-emerald-400 bg-slate-50">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Email</label>
                            <input id="inputEmail" type="email" value="hayes@weightcoach.com"
                                class="w-full rounded-2xl border border-slate-200 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-emerald-400 bg-slate-50">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Nomor Telepon</label>
                            <input id="inputTelepon" type="text" value="+62 812 3456 7890"
                                class="w-full rounded-2xl border border-slate-200 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-emerald-400 bg-slate-50">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Spesialisasi</label>
                            <input id="inputSpesialisasi" type="text" value="Manajemen Nutrisi dan Diet"
                                class="w-full rounded-2xl border border-slate-200 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-emerald-400 bg-slate-50">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-bold text-slate-600 mb-2">Deskripsi Profesional</label>
                        <textarea id="inputBio" rows="4"
                            class="w-full rounded-2xl border border-slate-200 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-emerald-400 bg-slate-50 resize-none">Ahli gizi dengan fokus pada manajemen berat badan, nutrisi olahraga, dan pemulihan pola makan sehat untuk gaya hidup berkelanjutan.</textarea>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button onclick="simpanProfil()" class="bg-emerald-700 hover:bg-emerald-800 transition text-white px-6 py-3 rounded-2xl font-bold">
                            Simpan Profil
                        </button>
                    </div>

                </div>

                <!-- PREFERENSI -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">

                    <h2 class="text-[30px] leading-tight font-black text-slate-950 mb-7">Preferensi Sistem</h2>

                    <div class="space-y-6">

                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-bold text-slate-900">Notifikasi Email</p>
                                <p class="text-sm text-slate-500 mt-1">Kirim pemberitahuan aktivitas klien melalui email.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input id="toggleEmail" type="checkbox" checked class="sr-only peer" onchange="togglePreferensi('Notifikasi Email', this.checked)">
                                <div class="w-14 h-8 bg-slate-200 rounded-full peer peer-checked:bg-emerald-600 transition"></div>
                                <div class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full transition peer-checked:translate-x-6 shadow"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-bold text-slate-900">Pengingat Hidrasi</p>
                                <p class="text-sm text-slate-500 mt-1">Aktifkan pengingat konsumsi air untuk klien.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input id="toggleHidrasi" type="checkbox" checked class="sr-only peer" onchange="togglePreferensi('Pengingat Hidrasi', this.checked)">
                                <div class="w-14 h-8 bg-slate-200 rounded-full peer peer-checked:bg-emerald-600 transition"></div>
                                <div class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full transition peer-checked:translate-x-6 shadow"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-bold text-slate-900">Laporan Mingguan Otomatis</p>
                                <p class="text-sm text-slate-500 mt-1">Generate laporan progress klien setiap minggu.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input id="toggleLaporan" type="checkbox" class="sr-only peer" onchange="togglePreferensi('Laporan Mingguan', this.checked)">
                                <div class="w-14 h-8 bg-slate-200 rounded-full peer peer-checked:bg-emerald-600 transition"></div>
                                <div class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full transition peer-checked:translate-x-6 shadow"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-bold text-slate-900">Notifikasi Progress Klien</p>
                                <p class="text-sm text-slate-500 mt-1">Terima notifikasi saat klien mencapai target.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input id="toggleProgress" type="checkbox" checked class="sr-only peer" onchange="togglePreferensi('Notifikasi Progress', this.checked)">
                                <div class="w-14 h-8 bg-slate-200 rounded-full peer peer-checked:bg-emerald-600 transition"></div>
                                <div class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full transition peer-checked:translate-x-6 shadow"></div>
                            </label>
                        </div>

                    </div>

                </div>

                <!-- TARGET DEFAULT -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">

                    <h2 class="text-[30px] leading-tight font-black text-slate-950 mb-2">Target Default Klien</h2>
                    <p class="text-sm text-slate-500 mb-7">Nilai awal yang digunakan saat menambahkan klien baru.</p>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Target Kalori Default (kkal)</label>
                            <input id="defaultKalori" type="number" value="1800"
                                class="w-full rounded-2xl border border-slate-200 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-emerald-400 bg-slate-50">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Target Air Default (ml)</label>
                            <input id="defaultAir" type="number" value="2500"
                                class="w-full rounded-2xl border border-slate-200 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-emerald-400 bg-slate-50">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Target Protein Default (g)</label>
                            <input id="defaultProtein" type="number" value="120"
                                class="w-full rounded-2xl border border-slate-200 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-emerald-400 bg-slate-50">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Frekuensi Laporan</label>
                            <select id="defaultFrekuensi"
                                class="w-full rounded-2xl border border-slate-200 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-emerald-400 bg-slate-50">
                                <option value="mingguan" selected>Mingguan</option>
                                <option value="dua_minggu">Dua Minggu Sekali</option>
                                <option value="bulanan">Bulanan</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button onclick="simpanTargetDefault()" class="bg-emerald-700 hover:bg-emerald-800 transition text-white px-6 py-3 rounded-2xl font-bold">
                            Simpan Target Default
                        </button>
                    </div>

                </div>

            </div>

            <!-- KANAN -->
            <div class="col-span-4 space-y-6">

                <!-- STATUS AKUN -->
                <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                    <h2 class="text-[26px] leading-tight font-black text-slate-950 mb-6">Status Akun</h2>

                    <div class="space-y-5">

                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-slate-400">Role</p>
                                <p id="displayRole" class="font-black text-emerald-700 mt-1">Nutritionist</p>
                            </div>
                            <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold">Aktif</span>
                        </div>

                        <hr class="border-slate-100">

                        <div>
                            <p class="text-sm text-slate-400">Nama</p>
                            <p id="displayNama" class="font-bold mt-1">Dr. Hayes</p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-400">Email</p>
                            <p id="displayEmail" class="font-bold mt-1">hayes@weightcoach.com</p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-400">Terakhir Login</p>
                            <p class="font-bold mt-1">Hari ini, 08:45</p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-400">Total Klien Aktif</p>
                            <p class="font-bold mt-1">3 Klien</p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-400">Status Verifikasi</p>
                            <p class="font-bold text-blue-600 mt-1">Terverifikasi ✓</p>
                        </div>

                    </div>

                </div>

                <!-- KEAMANAN -->
                <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-100">

                    <h2 class="text-[26px] leading-tight font-black text-slate-950 mb-6">Keamanan</h2>

                    <div class="space-y-3">

                        <button onclick="openUbahPassword()"
                                class="w-full bg-slate-100 hover:bg-slate-200 transition rounded-2xl py-4 font-bold text-slate-700 text-left px-5">
                            🔑 Ubah Password
                        </button>

                        <button onclick="toggle2FA()"
                                class="w-full bg-slate-100 hover:bg-slate-200 transition rounded-2xl py-4 font-bold text-slate-700 text-left px-5">
                            🛡 Aktifkan 2FA
                        </button>

                        <button onclick="lihatRiwayatLogin()"
                                class="w-full bg-slate-100 hover:bg-slate-200 transition rounded-2xl py-4 font-bold text-slate-700 text-left px-5">
                            📋 Riwayat Login
                        </button>

                        <button onclick="konfirmasiLogout()"
                                class="w-full bg-red-50 hover:bg-red-100 transition rounded-2xl py-4 font-bold text-red-600 text-left px-5">
                            ↩ Keluar dari Akun
                        </button>

                    </div>

                </div>

                <!-- INFORMASI SISTEM -->
                <div class="bg-blue-50 rounded-3xl p-7 border border-blue-100">

                    <h2 class="text-[24px] leading-tight font-black text-slate-950 mb-5">Informasi Sistem</h2>

                    <div class="space-y-4 text-sm">

                        <div class="flex justify-between">
                            <span class="text-slate-500">Versi Sistem</span>
                            <span class="font-bold">v2.1.0</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-slate-500">Status Server</span>
                            <span class="font-bold text-emerald-700">● Online</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-slate-500">Sinkronisasi</span>
                            <span id="syncTime" class="font-bold">5 menit lalu</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-slate-500">Database</span>
                            <span class="font-bold text-emerald-700">Terhubung</span>
                        </div>

                    </div>

                    <button onclick="sinkronisasiSekarang()" class="w-full mt-5 bg-blue-600 hover:bg-blue-700 transition text-white py-3 rounded-xl font-bold text-sm">
                        Sinkronisasi Sekarang
                    </button>

                </div>

            </div>

        </div>

    </main>

</div>

<!-- =================== MODAL UBAH PASSWORD =================== -->
<div id="passwordModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-black text-slate-950">Ubah Password</h2>
            <button onclick="closeModal('passwordModal')" class="text-slate-400 hover:text-slate-700 text-3xl font-black leading-none">×</button>
        </div>
        <div class="space-y-4">
            <div>
                <label class="text-sm font-bold text-slate-600">Password Saat Ini</label>
                <input id="passwordLama" type="password" placeholder="Masukkan password saat ini"
                    class="w-full mt-2 rounded-2xl border border-slate-200 px-4 py-3 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-emerald-300">
            </div>
            <div>
                <label class="text-sm font-bold text-slate-600">Password Baru</label>
                <input id="passwordBaru" type="password" placeholder="Minimal 8 karakter"
                    class="w-full mt-2 rounded-2xl border border-slate-200 px-4 py-3 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-emerald-300">
            </div>
            <div>
                <label class="text-sm font-bold text-slate-600">Konfirmasi Password Baru</label>
                <input id="passwordKonfirmasi" type="password" placeholder="Ulangi password baru"
                    class="w-full mt-2 rounded-2xl border border-slate-200 px-4 py-3 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-emerald-300">
            </div>
            <p id="passwordError" class="hidden text-red-500 text-sm font-bold"></p>
        </div>
        <div class="flex justify-end gap-3 mt-8">
            <button onclick="closeModal('passwordModal')" class="px-5 py-3 rounded-xl bg-slate-100 font-bold text-slate-700 hover:bg-slate-200 transition">Batal</button>
            <button onclick="simpanPassword()" class="px-5 py-3 rounded-xl bg-emerald-700 text-white font-bold hover:bg-emerald-800 transition">Simpan Password</button>
        </div>
    </div>
</div>

<!-- =================== MODAL 2FA =================== -->
<div id="twoFAModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-black text-slate-950">Autentikasi Dua Langkah</h2>
            <button onclick="closeModal('twoFAModal')" class="text-slate-400 hover:text-slate-700 text-3xl font-black leading-none">×</button>
        </div>
        <div class="bg-emerald-50 rounded-2xl p-5 mb-6">
            <p class="text-sm text-slate-700 leading-7">
                Aktifkan 2FA untuk keamanan akun yang lebih baik. Setiap login akan membutuhkan kode verifikasi dari aplikasi authenticator.
            </p>
        </div>
        <div class="space-y-3">
            <button onclick="aktifkan2FA('google')" class="w-full bg-slate-100 hover:bg-slate-200 transition rounded-2xl py-4 font-bold text-slate-700">
                Gunakan Google Authenticator
            </button>
            <button onclick="aktifkan2FA('sms')" class="w-full bg-slate-100 hover:bg-slate-200 transition rounded-2xl py-4 font-bold text-slate-700">
                Gunakan SMS OTP
            </button>
        </div>
        <div class="flex justify-end mt-8">
            <button onclick="closeModal('twoFAModal')" class="px-5 py-3 rounded-xl bg-slate-100 font-bold text-slate-700 hover:bg-slate-200 transition">Tutup</button>
        </div>
    </div>
</div>

<!-- =================== MODAL RIWAYAT LOGIN =================== -->
<div id="loginHistoryModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-black text-slate-950">Riwayat Login</h2>
            <button onclick="closeModal('loginHistoryModal')" class="text-slate-400 hover:text-slate-700 text-3xl font-black leading-none">×</button>
        </div>
        <div class="space-y-3">
            <div class="bg-emerald-50 rounded-2xl p-4 flex justify-between items-center">
                <div>
                    <p class="font-bold text-slate-900">Hari ini, 08:45</p>
                    <p class="text-xs text-slate-400 mt-1">Chrome • Windows • IP 192.168.1.1</p>
                </div>
                <span class="bg-emerald-100 text-emerald-700 text-xs px-3 py-1 rounded-full font-bold">Aktif</span>
            </div>
            <div class="bg-slate-50 rounded-2xl p-4 flex justify-between items-center">
                <div>
                    <p class="font-bold text-slate-900">Kemarin, 14:22</p>
                    <p class="text-xs text-slate-400 mt-1">Chrome • Windows • IP 192.168.1.1</p>
                </div>
                <span class="text-xs text-slate-400 font-bold">Selesai</span>
            </div>
            <div class="bg-slate-50 rounded-2xl p-4 flex justify-between items-center">
                <div>
                    <p class="font-bold text-slate-900">2 hari lalu, 09:10</p>
                    <p class="text-xs text-slate-400 mt-1">Firefox • Windows • IP 192.168.1.2</p>
                </div>
                <span class="text-xs text-slate-400 font-bold">Selesai</span>
            </div>
            <div class="bg-slate-50 rounded-2xl p-4 flex justify-between items-center">
                <div>
                    <p class="font-bold text-slate-900">5 hari lalu, 11:33</p>
                    <p class="text-xs text-slate-400 mt-1">Chrome • Android • IP 192.168.2.5</p>
                </div>
                <span class="text-xs text-slate-400 font-bold">Selesai</span>
            </div>
        </div>
        <div class="flex justify-end mt-8">
            <button onclick="closeModal('loginHistoryModal')" class="px-5 py-3 rounded-xl bg-slate-100 font-bold text-slate-700 hover:bg-slate-200 transition">Tutup</button>
        </div>
    </div>
</div>

<!-- =================== MODAL KONFIRMASI LOGOUT =================== -->
<div id="logoutModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-3xl w-full max-w-sm shadow-2xl p-8 text-center">
        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-5 text-3xl">↩</div>
        <h2 class="text-2xl font-black text-slate-950 mb-3">Keluar dari Akun?</h2>
        <p class="text-slate-500 text-sm mb-8">Kamu akan keluar dari sesi ini. Pastikan semua perubahan sudah disimpan.</p>
        <div class="flex gap-3">
            <button onclick="closeModal('logoutModal')" class="flex-1 px-5 py-3 rounded-xl bg-slate-100 font-bold text-slate-700 hover:bg-slate-200 transition">Batal</button>
            <button onclick="prosesLogout()" class="flex-1 px-5 py-3 rounded-xl bg-red-600 text-white font-bold hover:bg-red-700 transition">Ya, Keluar</button>
        </div>
    </div>
</div>

<!-- =================== MODAL BACKUP =================== -->
<div id="backupModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-black text-slate-950">Backup Data</h2>
            <button onclick="closeModal('backupModal')" class="text-slate-400 hover:text-slate-700 text-3xl font-black leading-none">×</button>
        </div>
        <div class="space-y-3 mb-6">
            <label class="flex items-center gap-3 p-4 rounded-2xl border border-slate-200 cursor-pointer hover:bg-slate-50 transition">
                <input type="checkbox" id="backupKlien" checked class="w-4 h-4 accent-emerald-600">
                <span class="font-bold text-slate-700">Data Klien</span>
            </label>
            <label class="flex items-center gap-3 p-4 rounded-2xl border border-slate-200 cursor-pointer hover:bg-slate-50 transition">
                <input type="checkbox" id="backupMeal" checked class="w-4 h-4 accent-emerald-600">
                <span class="font-bold text-slate-700">Rencana Makan</span>
            </label>
            <label class="flex items-center gap-3 p-4 rounded-2xl border border-slate-200 cursor-pointer hover:bg-slate-50 transition">
                <input type="checkbox" id="backupProgress" checked class="w-4 h-4 accent-emerald-600">
                <span class="font-bold text-slate-700">Data Progress</span>
            </label>
            <label class="flex items-center gap-3 p-4 rounded-2xl border border-slate-200 cursor-pointer hover:bg-slate-50 transition">
                <input type="checkbox" id="backupWater" class="w-4 h-4 accent-emerald-600">
                <span class="font-bold text-slate-700">Data Hidrasi</span>
            </label>
        </div>
        <div class="flex justify-end gap-3">
            <button onclick="closeModal('backupModal')" class="px-5 py-3 rounded-xl bg-slate-100 font-bold text-slate-700 hover:bg-slate-200 transition">Batal</button>
            <button onclick="prosesBackup()" class="px-5 py-3 rounded-xl bg-emerald-700 text-white font-bold hover:bg-emerald-800 transition">Mulai Backup</button>
        </div>
    </div>
</div>

<script>

// =================== TOAST ===================
function showToast(message, isError = false) {
    const toast = document.getElementById(isError ? 'toastError' : 'toastSuccess');
    const msg = document.getElementById(isError ? 'toastErrorMessage' : 'toastMessage');
    msg.innerText = message;
    toast.classList.remove('hidden');
    toast.classList.add('flex');
    setTimeout(() => {
        toast.classList.add('hidden');
        toast.classList.remove('flex');
    }, 3000);
}

// =================== MODAL HELPERS ===================
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
    document.getElementById(id).classList.add('flex');
}
function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
    document.getElementById(id).classList.remove('flex');
}
['passwordModal', 'twoFAModal', 'loginHistoryModal', 'logoutModal', 'backupModal'].forEach(id => {
    document.getElementById(id).addEventListener('click', function(e) {
        if (e.target === this) closeModal(id);
    });
});

// =================== SIMPAN PROFIL ===================
function simpanProfil() {
    const nama = document.getElementById('inputNama').value.trim();
    const email = document.getElementById('inputEmail').value.trim();

    if (!nama) { showToast('Nama lengkap tidak boleh kosong.', true); return; }
    if (!email || !email.includes('@')) { showToast('Email tidak valid.', true); return; }

    document.getElementById('displayNama').innerText = nama;
    document.getElementById('displayEmail').innerText = email;

    showToast('Profil berhasil disimpan.');
}

function simpanTargetDefault() {
    const kalori = document.getElementById('defaultKalori').value;
    const air = document.getElementById('defaultAir').value;
    if (!kalori || !air) { showToast('Target kalori dan air tidak boleh kosong.', true); return; }
    showToast('Target default berhasil disimpan.');
}

function simpanPengaturan() {
    simpanProfil();
}

function simpanSemuaPerubahan() {
    simpanProfil();
    showToast('Semua perubahan berhasil disimpan.');
}

// =================== TOGGLE PREFERENSI ===================
function togglePreferensi(nama, status) {
    showToast(nama + (status ? ' diaktifkan.' : ' dinonaktifkan.'));
}

// =================== GANTI FOTO ===================
function gantiFoto() {
    showToast('Fitur unggah foto profil akan segera tersedia.');
}

// =================== PASSWORD ===================
function openUbahPassword() {
    document.getElementById('passwordLama').value = '';
    document.getElementById('passwordBaru').value = '';
    document.getElementById('passwordKonfirmasi').value = '';
    document.getElementById('passwordError').classList.add('hidden');
    openModal('passwordModal');
}

function simpanPassword() {
    const lama = document.getElementById('passwordLama').value;
    const baru = document.getElementById('passwordBaru').value;
    const konfirmasi = document.getElementById('passwordKonfirmasi').value;
    const errorEl = document.getElementById('passwordError');

    errorEl.classList.add('hidden');

    if (!lama) { errorEl.innerText = 'Password saat ini tidak boleh kosong.'; errorEl.classList.remove('hidden'); return; }
    if (baru.length < 8) { errorEl.innerText = 'Password baru minimal 8 karakter.'; errorEl.classList.remove('hidden'); return; }
    if (baru !== konfirmasi) { errorEl.innerText = 'Konfirmasi password tidak cocok.'; errorEl.classList.remove('hidden'); return; }

    closeModal('passwordModal');
    showToast('Password berhasil diubah.');
}

// =================== 2FA ===================
function toggle2FA() { openModal('twoFAModal'); }

function aktifkan2FA(metode) {
    closeModal('twoFAModal');
    showToast('2FA via ' + (metode === 'google' ? 'Google Authenticator' : 'SMS OTP') + ' berhasil diaktifkan.');
}

// =================== RIWAYAT LOGIN ===================
function lihatRiwayatLogin() { openModal('loginHistoryModal'); }

// =================== LOGOUT ===================
function konfirmasiLogout() { openModal('logoutModal'); }

function prosesLogout() {
    closeModal('logoutModal');
    showToast('Berhasil keluar. Mengalihkan...');
    setTimeout(() => {
        window.location.href = '/login';
    }, 1500);
}

// =================== BACKUP ===================
function backupData() { openModal('backupModal'); }

function prosesBackup() {
    const items = [];
    if (document.getElementById('backupKlien').checked) items.push('Data Klien');
    if (document.getElementById('backupMeal').checked) items.push('Rencana Makan');
    if (document.getElementById('backupProgress').checked) items.push('Data Progress');
    if (document.getElementById('backupWater').checked) items.push('Data Hidrasi');

    if (items.length === 0) { showToast('Pilih minimal satu data untuk di-backup.', true); return; }

    closeModal('backupModal');
    showToast('Backup ' + items.join(', ') + ' berhasil.');
}

// =================== SINKRONISASI ===================
function sinkronisasiSekarang() {
    document.getElementById('syncTime').innerText = 'Sedang sinkronisasi...';
    setTimeout(() => {
        document.getElementById('syncTime').innerText = 'Baru saja';
        showToast('Sinkronisasi berhasil.');
    }, 1500);
}

</script>

</body>
</html>
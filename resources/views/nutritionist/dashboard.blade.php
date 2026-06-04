<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Ahli Gizi - WeightCoach</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f7faf9] text-slate-900">

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="fixed left-0 top-0 bottom-0 w-[245px] bg-white border-r border-slate-200 px-5 py-6 flex flex-col justify-between">
        <div>
            <h1 class="text-2xl font-black text-emerald-800">WeightCoach</h1>
            <p class="text-xs text-slate-500 mt-1">Kesehatan Harian</p>

            <nav class="mt-10 space-y-2 text-sm">
                <a href="{{ route('nutritionist.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-700 text-white font-bold shadow-sm">
                    ▦ Dashboard
                </a>
                <a href="{{ route('nutritionist.meal-plans') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">
                    🍽 Rencana Makan
                </a>
                <a href="{{ route('nutritionist.water') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">
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

        <!-- BAWAH SIDEBAR -->
        <div class="space-y-3 text-sm">
            <a href="{{ route('nutritionist.settings') }}" class="flex items-center gap-2 text-slate-500 hover:text-emerald-700 transition px-2 py-1">
                ♙ Profil
            </a>
            <button onclick="openBantuanModal()" class="flex items-center gap-2 text-slate-500 hover:text-emerald-700 transition px-2 py-1 w-full text-left mb-4">
                ⓘ Bantuan
            </button>
            
            <!-- FORM LOGOUT MURNI (MENGGANTIKAN GANTI ROLE) -->
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full py-2.5 border-2 border-red-500 rounded-full text-red-500 font-bold hover:bg-red-500 hover:text-white transition-all shadow-sm flex items-center justify-center gap-2">
                    Keluar Aplikasi
                </button>
            </form>
        </div>
    </aside>

    <!-- CONTENT -->
    <main class="ml-[245px] flex-1 px-16 py-10">

        <!-- TOAST -->
        <div id="toast" class="hidden fixed top-6 right-6 z-50 bg-emerald-700 text-white px-6 py-4 rounded-2xl shadow-xl font-bold text-sm">
            <span id="toastMsg"></span>
        </div>

        <!-- HEADER -->
        <div class="flex justify-between items-start mb-10">
            <div>
                <h2 class="text-4xl font-black text-emerald-950">
                    Selamat Pagi, Dr. Hayes
                </h2>
                <p class="text-sm text-slate-500 mt-2">
                    Berikut ringkasan profesional Anda hari ini.
                </p>
            </div>
            <div class="flex items-center gap-4">
                <button onclick="openNotifikasiModal()" class="relative text-2xl text-slate-500 hover:text-emerald-700 transition">
                    🔔
                    <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full text-white text-[10px] flex items-center justify-center font-black">3</span>
                </button>
                <button onclick="openKalenderModal()" class="text-2xl text-slate-500 hover:text-emerald-700 transition">
                    📅
                </button>
            </div>
        </div>

        <!-- CARD STATISTIK -->
        <div class="grid grid-cols-3 gap-8 mb-10">

            <!-- KLIEN AKTIF -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 hover:shadow-md transition cursor-pointer"
                 onclick="openKlienAktifModal()">
                <p class="text-xs text-slate-400 font-bold uppercase">Klien Aktif</p>
                <div class="flex justify-between mt-3">
                    <h3 class="text-5xl font-black text-emerald-900">{{ $activeClients ?? 0 }}</h3>
                    <div class="text-5xl text-emerald-100">👥</div>
                </div>
                <p class="text-xs text-emerald-600 mt-3">↗ +3 minggu ini</p>
            </div>

            <!-- PESAN MENUNGGU -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 hover:shadow-md transition cursor-pointer"
                 onclick="openPesanModal()">
                <p class="text-xs text-slate-400 font-bold uppercase">Pesan Menunggu</p>
                <div class="flex justify-between mt-3">
                    <h3 class="text-5xl font-black text-emerald-900">{{ $pendingMessages ?? 12 }}</h3>
                    <div class="text-5xl text-emerald-100">✉</div>
                </div>
                <p class="text-xs text-slate-400 mt-3">2 perlu balasan segera</p>
            </div>

            <!-- KONSULTASI -->
            <div class="bg-emerald-50 rounded-3xl p-8 shadow-sm border border-emerald-100">
                <p class="text-xs text-emerald-900 font-bold uppercase">Konsultasi Berikutnya</p>
                <h3 class="text-xl font-black text-emerald-950 mt-3">{{ $nextConsultation ?? 'Putri Amanda' }}</h3>
                <p class="text-sm text-slate-500">10.30 • Konsultasi Daring</p>
                <button onclick="masukKonsultasi()" class="mt-4 bg-emerald-800 hover:bg-emerald-900 transition text-white px-6 py-2 rounded-full text-sm font-bold shadow">
                    Masuk
                </button>
            </div>

        </div>

        <!-- TABEL KLIEN -->
        <section class="bg-white rounded-[32px] p-9 shadow-sm border border-slate-100">

            <div class="flex justify-between items-center mb-8">
                <h3 class="text-3xl font-black text-emerald-950">Ringkasan Klien</h3>
                <div class="flex gap-3">
                    <input
                        id="searchKlien"
                        type="text"
                        placeholder="Cari klien..."
                        class="rounded-full border-0 bg-slate-100 px-5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                    <button onclick="filterTabel()" class="w-10 h-10 rounded-full bg-slate-100 hover:bg-slate-200 transition text-slate-600">
                        ☰
                    </button>
                </div>
            </div>

            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs text-slate-400 uppercase">
                        <th class="py-4">Klien</th>
                        <th>Program</th>
                        <th>Risiko</th>
                        <th>Kepatuhan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabelKlien" class="divide-y divide-slate-100">

                    @if(isset($clients) && count($clients) > 0)
                        @foreach ($clients as $client)
                        <tr class="client-row hover:bg-slate-50 transition" data-name="{{ strtolower($client->name) }}">

                            <td class="py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-800 font-black text-sm">
                                        {{ strtoupper(substr($client->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $client->name)[1] ?? '', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold">{{ $client->name }}</p>
                                        <p class="text-xs text-slate-400">Diperbarui {{ $client->updated_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="text-slate-600">{{ $client->program ?? 'Weight Loss' }}</td>

                            <td>
                                @if (($client->risk_level ?? 'low') === 'low')
                                    <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold">Rendah</span>
                                @elseif (($client->risk_level ?? 'low') === 'moderate')
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Sedang</span>
                                @else
                                    <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-bold">Tinggi</span>
                                @endif
                            </td>

                            <td>
                                <p class="text-xs text-slate-500 mb-1">{{ $client->adherence ?? 80 }}% target</p>
                                <div class="w-32 h-2 bg-slate-100 rounded-full">
                                    <div class="h-2 rounded-full
                                        @if (($client->risk_level ?? 'low') === 'high') bg-red-500
                                        @elseif (($client->risk_level ?? 'low') === 'moderate') bg-yellow-500
                                        @else bg-emerald-700 @endif"
                                        style="width: {{ $client->adherence ?? 80 }}%">
                                    </div>
                                </div>
                            </td>

                            <td>
                                <a href="{{ route('nutritionist.clients.show', $client->slug ?? 1) }}"
                                    class="bg-emerald-700 hover:bg-emerald-800 transition text-white px-4 py-2 rounded-xl text-xs font-bold inline-block">
                                     Lihat Detail
                                </a>
                            </td>

                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center text-slate-400 font-bold py-8">Belum ada klien saat ini.</td>
                        </tr>
                    @endif

                </tbody>
            </table>

            <p id="emptySearch" class="hidden text-center text-red-500 font-bold mt-6 py-4">Klien tidak ditemukan.</p>

            <div class="text-center mt-6">
            <span class="text-slate-400 font-bold text-sm cursor-default hover:text-emerald-700 transition">
                Lihat Semua Klien →
            </span>
            </div>

        </section>

    </main>

</div>

<!-- =================== MODAL NOTIFIKASI =================== -->
<div id="notifikasiModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-black text-slate-950">Notifikasi</h2>
            <button onclick="closeModal('notifikasiModal')" class="text-slate-400 hover:text-slate-700 text-3xl font-black leading-none">×</button>
        </div>
        <div class="space-y-3">
            <div class="bg-emerald-50 rounded-2xl p-4 border-l-4 border-emerald-600">
                <p class="font-bold text-slate-900 text-sm">Putri Amanda mencapai target kalori hari ini</p>
                <p class="text-xs text-slate-400 mt-1">20 menit lalu</p>
            </div>
            <div class="bg-blue-50 rounded-2xl p-4 border-l-4 border-blue-500">
                <p class="font-bold text-slate-900 text-sm">Nanda Nabila mengirim pesan baru</p>
                <p class="text-xs text-slate-400 mt-1">1 jam lalu</p>
            </div>
            <div class="bg-yellow-50 rounded-2xl p-4 border-l-4 border-yellow-500">
                <p class="font-bold text-slate-900 text-sm">Deta Amelia belum mencapai 50% target hidrasi</p>
                <p class="text-xs text-slate-400 mt-1">3 jam lalu</p>
            </div>
        </div>
        <button onclick="tandaiDibaca()" class="w-full mt-6 bg-slate-100 hover:bg-slate-200 transition rounded-2xl py-3 font-bold text-slate-700">
            Tandai Semua Sudah Dibaca
        </button>
    </div>
</div>

<!-- =================== MODAL KALENDER =================== -->
<div id="kalenderModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-black text-slate-950">Jadwal Hari Ini</h2>
            <button onclick="closeModal('kalenderModal')" class="text-slate-400 hover:text-slate-700 text-3xl font-black leading-none">×</button>
        </div>
        <div class="space-y-4">
            <div class="flex gap-4 items-start">
                <div class="bg-emerald-100 text-emerald-800 rounded-xl px-3 py-2 text-sm font-black whitespace-nowrap">08.00</div>
                <div>
                    <p class="font-bold text-slate-900">Review Progress Putri Amanda</p>
                    <p class="text-xs text-slate-400 mt-1">Evaluasi mingguan • 30 menit</p>
                </div>
            </div>
            <div class="flex gap-4 items-start">
                <div class="bg-blue-100 text-blue-800 rounded-xl px-3 py-2 text-sm font-black whitespace-nowrap">10.30</div>
                <div>
                    <p class="font-bold text-slate-900">Konsultasi Daring - {{ $nextConsultation ?? 'Putri Amanda' }}</p>
                    <p class="text-xs text-slate-400 mt-1">Konsultasi rutin • 45 menit</p>
                </div>
            </div>
            <div class="flex gap-4 items-start">
                <div class="bg-yellow-100 text-yellow-800 rounded-xl px-3 py-2 text-sm font-black whitespace-nowrap">14.00</div>
                <div>
                    <p class="font-bold text-slate-900">Update Rencana Makan Deta Amelia</p>
                    <p class="text-xs text-slate-400 mt-1">Revisi program • 20 menit</p>
                </div>
            </div>
        </div>
        <div class="flex justify-end mt-8">
            <button onclick="closeModal('kalenderModal')" class="px-5 py-3 rounded-xl bg-slate-100 font-bold text-slate-700 hover:bg-slate-200 transition">Tutup</button>
        </div>
    </div>
</div>

<!-- =================== MODAL KLIEN AKTIF =================== -->
<div id="klienAktifModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-black text-slate-950">Klien Aktif</h2>
            <button onclick="closeModal('klienAktifModal')" class="text-slate-400 hover:text-slate-700 text-3xl font-black leading-none">×</button>
        </div>
        <div class="space-y-3">
            @if(isset($clients) && count($clients) > 0)
                @foreach($clients as $client)
                <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 hover:bg-slate-100 transition">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-800 font-black text-sm">
                            {{ strtoupper(substr($client->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $client->name)[1] ?? '', 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-bold text-slate-900">{{ $client->name }}</p>
                            <p class="text-xs text-slate-400">{{ $client->program ?? 'Weight Loss' }}</p>
                        </div>
                    </div>
                    <a href="{{ route('nutritionist.clients.show', $client->slug ?? 1) }}"
                       class="text-emerald-700 font-bold text-xs hover:underline">
                        Detail →
                    </a>
                </div>
                @endforeach
            @else
                <p class="text-center text-sm font-bold text-slate-400">Belum ada data klien.</p>
            @endif
        </div>
        <div class="flex justify-end mt-6">
            <button onclick="closeModal('klienAktifModal')" class="px-5 py-3 rounded-xl bg-slate-100 font-bold text-slate-700 hover:bg-slate-200 transition">Tutup</button>
        </div>
    </div>
</div>

<!-- =================== MODAL PESAN =================== -->
<div id="pesanModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-black text-slate-950">Pesan Menunggu</h2>
            <button onclick="closeModal('pesanModal')" class="text-slate-400 hover:text-slate-700 text-3xl font-black leading-none">×</button>
        </div>
        <div class="space-y-3">
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                <div class="flex justify-between items-start mb-2">
                    <p class="font-black text-slate-900">Nanda Nabila</p>
                    <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full font-bold">Segera</span>
                </div>
                <p class="text-sm text-slate-600">"Kak, kalori hari ini sudah 2100 tapi masih lapar, boleh tambah makan?"</p>
                <p class="text-xs text-slate-400 mt-2">1 jam lalu</p>
            </div>
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                <div class="flex justify-between items-start mb-2">
                    <p class="font-black text-slate-900">Deta Amelia</p>
                    <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full font-bold">Segera</span>
                </div>
                <p class="text-sm text-slate-600">"Saya mau minta jadwal konsultasi minggu depan bisa?"</p>
                <p class="text-xs text-slate-400 mt-2">2 jam lalu</p>
            </div>
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                <div class="flex justify-between items-start mb-2">
                    <p class="font-black text-slate-900">Putri Amanda</p>
                    <span class="text-xs text-slate-400 font-bold">Biasa</span>
                </div>
                <p class="text-sm text-slate-600">"Terima kasih kak, progress minggu ini bagus sekali!"</p>
                <p class="text-xs text-slate-400 mt-2">5 jam lalu</p>
            </div>
        </div>
        <button onclick="balasSemuaPesan()" class="w-full mt-6 bg-emerald-700 hover:bg-emerald-800 transition text-white rounded-2xl py-3 font-bold">
            Balas Semua Pesan
        </button>
    </div>
</div>

<!-- =================== MODAL BANTUAN =================== -->
<div id="bantuanModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-black text-slate-950">Bantuan</h2>
            <button onclick="closeModal('bantuanModal')" class="text-slate-400 hover:text-slate-700 text-3xl font-black leading-none">×</button>
        </div>
        <div class="space-y-3">
            <button onclick="showToast('Membuka panduan penggunaan...')" class="w-full bg-slate-50 hover:bg-slate-100 transition rounded-2xl p-4 text-left">
                <p class="font-bold text-slate-900">📖 Panduan Penggunaan</p>
                <p class="text-xs text-slate-400 mt-1">Pelajari cara menggunakan WeightCoach</p>
            </button>
            <button onclick="showToast('Menghubungi tim support...')" class="w-full bg-slate-50 hover:bg-slate-100 transition rounded-2xl p-4 text-left">
                <p class="font-bold text-slate-900">💬 Hubungi Support</p>
                <p class="text-xs text-slate-400 mt-1">Kirim pertanyaan ke tim kami</p>
            </button>
            <button onclick="showToast('Membuka FAQ...')" class="w-full bg-slate-50 hover:bg-slate-100 transition rounded-2xl p-4 text-left">
                <p class="font-bold text-slate-900">❓ FAQ</p>
                <p class="text-xs text-slate-400 mt-1">Pertanyaan yang sering ditanyakan</p>
            </button>
        </div>
        <div class="flex justify-end mt-6">
            <button onclick="closeModal('bantuanModal')" class="px-5 py-3 rounded-xl bg-slate-100 font-bold text-slate-700 hover:bg-slate-200 transition">Tutup</button>
        </div>
    </div>
</div>

<script>

// =================== TOAST ===================
function showToast(message) {
    const toast = document.getElementById('toast');
    document.getElementById('toastMsg').innerText = message;
    toast.classList.remove('hidden');
    toast.classList.add('flex');
    setTimeout(() => {
        toast.classList.add('hidden');
        toast.classList.remove('flex');
    }, 3000);
}

// =================== MODAL ===================
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
    document.getElementById(id).classList.add('flex');
}
function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
    document.getElementById(id).classList.remove('flex');
}

// Event listener (GantiRole dihapus karena sudah diganti form asli)
['notifikasiModal','kalenderModal','klienAktifModal','pesanModal','bantuanModal'].forEach(id => {
    document.getElementById(id).addEventListener('click', function(e) {
        if (e.target === this) closeModal(id);
    });
});

// =================== AKSI HEADER ===================
function openNotifikasiModal() { openModal('notifikasiModal'); }
function openKalenderModal() { openModal('kalenderModal'); }
function openKlienAktifModal() { openModal('klienAktifModal'); }
function openPesanModal() { openModal('pesanModal'); }
function openBantuanModal() { openModal('bantuanModal'); }

function tandaiDibaca() {
    closeModal('notifikasiModal');
    const badge = document.querySelector('.absolute.bg-red-500');
    if (badge) badge.innerText = '0';
    showToast('Semua notifikasi ditandai sudah dibaca.');
}

function masukKonsultasi() {
    showToast('Membuka ruang konsultasi daring...');
}

function balasSemuaPesan() {
    closeModal('pesanModal');
    showToast('Fitur balas pesan akan segera tersedia.');
}

// =================== SEARCH & FILTER ===================
document.getElementById('searchKlien').addEventListener('keyup', function() {
    const keyword = this.value.toLowerCase().trim();
    const rows = document.querySelectorAll('.client-row');
    let visible = 0;
    rows.forEach(row => {
        const match = row.dataset.name.includes(keyword);
        row.style.display = match ? '' : 'none';
        if (match) visible++;
    });
    document.getElementById('emptySearch').classList.toggle('hidden', visible > 0);
});

function filterTabel() {
    document.getElementById('searchKlien').value = '';
    document.querySelectorAll('.client-row').forEach(row => row.style.display = '');
    document.getElementById('emptySearch').classList.add('hidden');
    showToast('Filter direset.');
}

</script>

</body>
</html>
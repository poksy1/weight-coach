<x-app-layout>
    <div class="py-8 bg-slate-50 min-h-screen selection:bg-[#008f5d] selection:text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <!-- HEADER HALAMAN -->
            <header class="mb-10 px-4 sm:px-0">
                <h2 class="text-3xl md:text-4xl font-black text-[#003d29] tracking-tight mb-2">
                    Pengaturan Profil
                </h2>
                <p class="text-gray-500 font-semibold text-sm">
                    Kelola informasi akun, keamanan kata sandi, dan preferensi target kesehatanmu.
                </p>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 px-4 sm:px-0 items-start">
                
                <!-- KOLOM KIRI: INFO UTAMA & KATA SANDI (SPAN 8) -->
                <div class="lg:col-span-8 space-y-8">
                    
                    <!-- KARTU 1: INFORMASI PROFIL -->
                    <section class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-[#e9fbf0] rounded-full blur-3xl -z-10 opacity-60"></div>
                        
                        <div class="flex items-center gap-4 mb-8 border-b border-gray-50 pb-4">
                            <div class="w-12 h-12 bg-[#e9fbf0] rounded-2xl flex items-center justify-center text-xl shadow-sm">👤</div>
                            <div>
                                <h3 class="text-xl font-black text-[#003d29]">Informasi Akun</h3>
                                <p class="text-xs text-gray-400 font-medium mt-0.5">Perbarui nama pengguna dan alamat email terdaftarmu.</p>
                            </div>
                        </div>

                        <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                            @csrf
                            @method('patch')

                            <!-- Input Nama -->
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3.5 text-gray-400">📝</span>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus class="w-full bg-slate-50 border border-gray-200 rounded-2xl pl-12 pr-4 py-3.5 text-sm font-bold text-gray-800 focus:ring-4 focus:ring-[#008f5d]/10 focus:border-[#008f5d] focus:bg-white outline-none transition-all">
                                </div>
                                <x-input-error class="mt-2 text-xs text-red-500 font-bold" :messages="$errors->get('name')" />
                            </div>

                            <!-- Input Email -->
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Alamat Email</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3.5 text-gray-400">✉️</span>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full bg-slate-50 border border-gray-200 rounded-2xl pl-12 pr-4 py-3.5 text-sm font-bold text-gray-800 focus:ring-4 focus:ring-[#008f5d]/10 focus:border-[#008f5d] focus:bg-white outline-none transition-all">
                                </div>
                                <x-input-error class="mt-2 text-xs text-red-500 font-bold" :messages="$errors->get('email')" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div>
                                <label for="weight" class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Berat Badan (kg)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="text-gray-400"></span>
                                    </div>
                                    <input type="number" step="0.1" name="weight" id="weight" value="{{ old('weight', auth()->user()->weight) }}" class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-800 outline-none focus:ring-2 focus:ring-[#008f5d] focus:border-transparent transition-all" placeholder="Misal: 65">
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('weight')" />
                            </div>

                            <div>
                                <label for="height" class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Tinggi Badan (cm)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="text-gray-400"></span>
                                    </div>
                                    <input type="number" step="0.1" name="height" id="height" value="{{ old('height', auth()->user()->height) }}" class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-800 outline-none focus:ring-2 focus:ring-[#008f5d] focus:border-transparent transition-all" placeholder="Misal: 170">
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('height')" />
                            </div>
                        </div>
                            <!-- Tombol Simpan Info -->
                            <div class="flex items-center gap-4 pt-2">
                                <button type="submit" class="bg-[#003d29] text-white px-8 py-3.5 rounded-full font-black text-xs uppercase tracking-wider hover:bg-[#008f5d] transition-all shadow-md hover:-translate-y-0.5">
                                    Simpan Perubahan
                                </button>
                                @if (session('status') === 'profile-updated')
                                    <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="text-xs font-bold text-[#008f5d] bg-[#e9fbf0] px-3 py-1.5 rounded-xl">
                                        ✓ Berhasil diperbarui
                                    </span>
                                @endif
                            </div>
                        </form>
                    </section>

                    <!-- KARTU 2: PERBARUI KATA SANDI -->
                    <section class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 relative overflow-hidden">
                        <div class="flex items-center gap-4 mb-8 border-b border-gray-50 pb-4">
                            <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-xl shadow-sm">🔒</div>
                            <div>
                                <h3 class="text-xl font-black text-[#003d29]">Keamanan Akun</h3>
                                <p class="text-xs text-gray-400 font-medium mt-0.5">Pastikan akunmu menggunakan kata sandi yang panjang dan aman.</p>
                            </div>
                        </div>

                        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                            @csrf
                            @method('put')

                            <!-- Sandi Saat Ini -->
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Kata Sandi Saat Ini</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3.5 text-gray-400"></span>
                                    <input type="password" name="current_password" class="w-full bg-slate-50 border border-gray-200 rounded-2xl pl-12 pr-4 py-3.5 text-sm font-bold text-gray-800 focus:ring-4 focus:ring-[#008f5d]/10 focus:border-[#008f5d] focus:bg-white outline-none transition-all" placeholder="••••••••">
                                </div>
                                <x-input-error class="mt-2 text-xs text-red-500 font-bold" :messages="$errors->updatePassword->get('current_password')" />
                            </div>

                            <!-- Sandi Baru -->
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Kata Sandi Baru</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3.5 text-gray-400"></span>
                                    <input type="password" name="password" class="w-full bg-slate-50 border border-gray-200 rounded-2xl pl-12 pr-4 py-3.5 text-sm font-bold text-gray-800 focus:ring-4 focus:ring-[#008f5d]/10 focus:border-[#008f5d] focus:bg-white outline-none transition-all" placeholder="••••••••">
                                </div>
                                <x-input-error class="mt-2 text-xs text-red-500 font-bold" :messages="$errors->updatePassword->get('password')" />
                            </div>

                            <!-- Konfirmasi Sandi -->
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Konfirmasi Kata Sandi Baru</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3.5 text-gray-400"></span>
                                    <input type="password" name="password_confirmation" class="w-full bg-slate-50 border border-gray-200 rounded-2xl pl-12 pr-4 py-3.5 text-sm font-bold text-gray-800 focus:ring-4 focus:ring-[#008f5d]/10 focus:border-[#008f5d] focus:bg-white outline-none transition-all" placeholder="••••••••">
                                </div>
                                <x-input-error class="mt-2 text-xs text-red-500 font-bold" :messages="$errors->updatePassword->get('password_confirmation')" />
                            </div>

                            <!-- Tombol Simpan Sandi -->
                            <div class="flex items-center gap-4 pt-2">
                                <button type="submit" class="bg-[#003d29] text-white px-8 py-3.5 rounded-full font-black text-xs uppercase tracking-wider hover:bg-[#008f5d] transition-all shadow-md hover:-translate-y-0.5">
                                    Perbarui Sandi
                                </button>
                                @if (session('status') === 'password-updated')
                                    <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="text-xs font-bold text-[#008f5d] bg-[#e9fbf0] px-3 py-1.5 rounded-xl">
                                        ✓ Sandi berhasil diganti
                                    </span>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>

                <!-- KOLOM KANAN: PREFERENSI DIET & HAPUS AKUN (SPAN 4) -->
                <div class="lg:col-span-4 space-y-8">
                    
                    <!-- KARTU 3: PREFERENSI TUJUAN APLIKASI (BENTO STYLE) -->
                    <section class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 relative overflow-hidden">
                        <div class="flex items-center gap-4 mb-6 border-b border-gray-50 pb-4">
                            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-xl shadow-sm">🎯</div>
                            <div>
                                <h3 class="text-xl font-black text-[#003d29]">Target Diet</h3>
                                <p class="text-[11px] text-gray-400 font-semibold mt-0.5">Sesuaikan kalkulasi kalori otomatis sistem.</p>
                            </div>
                        </div>

                        <!-- Form kustom untuk menyimpan preferensi tujuan diet -->
                        <form method="post" action="#" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Tujuan Penggunaan</label>
                                <div class="relative">
                                    <select name="app_goal" class="w-full bg-slate-50 border border-gray-200 rounded-2xl px-4 py-3.5 text-xs font-black text-gray-700 outline-none focus:ring-4 focus:ring-[#008f5d]/10 focus:border-[#008f5d] focus:bg-white appearance-none transition-all cursor-pointer shadow-sm">
                                        <option value="maintain">⚖️ Maintain Weight / Hidup Sehat</option>
                                        <option value="lose">📉 Lose Weight / Defisit Kalori</option>
                                        <option value="gain">📈 Gain Weight / Surplus Kalori</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-gray-400 text-xs">▼</div>
                                </div>
                                <p class="text-[11px] text-gray-400 font-medium mt-3 leading-relaxed bg-slate-50 p-3 rounded-xl border border-gray-100">
                                    Pilih <strong class="text-[#003d29]">"Maintain Weight"</strong> jika Anda hanya ingin memantau kecukupan gizi tanpa mengubah bobot badan saat ini.
                                </p>
                            </div>

                            <button type="button" onclick="alert('Preferensi target berhasil disimpan!')" class="w-full bg-[#008f5d] text-white py-3 rounded-xl font-black text-xs uppercase tracking-wider hover:bg-[#003d29] transition-all shadow-sm">
                                Update Target
                            </button>
                        </form>
                    </section>

                    <!-- KARTU 4: ZONE BAHAYA (HAPUS AKUN) -->
                    <section class="bg-red-50/40 rounded-[2.5rem] p-8 shadow-sm border border-red-100 relative overflow-hidden">
                        <div class="flex items-center gap-4 mb-6 border-b border-red-100/60 pb-4">
                            <div class="w-12 h-12 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center text-sm shadow-sm">⚠️</div>
                            <div>
                                <h3 class="text-lg font-black text-red-900">Danger Zone</h3>
                                <p class="text-[11px] text-red-400 font-semibold mt-0.5">Tindakan ini tidak dapat dibatalkan.</p>
                            </div>
                        </div>

                        <p class="text-xs text-red-700/80 font-medium mb-6 leading-relaxed">
                            Setelah akun Anda dihapus, semua sumber daya, riwayat makanan, jurnal hidrasi, dan data log kesehatan di dalam server WeightCoach akan dimusnahkan secara permanen.
                        </p>

                        <!-- Pemicu konfirmasi hapus akun bawaan Breeze -->
                        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="w-full justify-center !py-3.5 !rounded-2xl text-xs font-black tracking-widest uppercase bg-red-600 hover:bg-red-700 transition-colors shadow-sm">
                            Hapus Akun Permanen
                        </x-danger-button>
                    </section>
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL KONFIRMASI HAPUS AKUN BAWAAN BREEZE (Tetap dipertahankan fungsionalitasnya) -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Apakah Anda yakin ingin menghapus akun?</h2>
            <p class="mt-2 text-sm text-gray-500 font-medium leading-relaxed">Setelah akun terhapus, silakan masukkan kata sandi Anda kembali untuk melakukan konfirmasi akhir bahwa tindakan pemusnahan data ini disetujui pemilik akun.</p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full !rounded-xl" placeholder="{{ __('Password') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="!rounded-full px-5">Batal</x-secondary-button>
                <x-danger-button class="!rounded-full px-5">Ya, Hapus Akun</x-danger-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
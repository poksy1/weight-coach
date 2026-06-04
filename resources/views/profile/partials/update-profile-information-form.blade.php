<section class="w-full">
    <form method="post" action="{{ route('profile.update') }}" class="w-full">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 rounded-2xl bg-[#e9fbf0] text-[#008f5d] flex items-center justify-center text-2xl shadow-inner">👤</div>
                        <div>
                            <h3 class="text-2xl font-black text-[#003d29]">Informasi Akun</h3>
                            <p class="text-xs text-gray-400 font-medium mt-1">Perbarui nama pengguna dan alamat email terdaftarmu.</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full bg-slate-50 border border-gray-200 rounded-xl px-4 py-3.5 text-sm font-bold text-gray-800 outline-none focus:ring-2 focus:ring-[#008f5d] focus:bg-white transition-all shadow-sm">
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <label class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-2">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full bg-slate-50 border border-gray-200 rounded-xl px-4 py-3.5 text-sm font-bold text-gray-800 outline-none focus:ring-2 focus:ring-[#008f5d] focus:bg-white transition-all shadow-sm">
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center text-2xl shadow-inner">⚖️</div>
                        <div>
                            <h3 class="text-2xl font-black text-[#003d29]">Data Fisik</h3>
                            <p class="text-xs text-gray-400 font-medium mt-1">Digunakan untuk menghitung BMI & Kebutuhan Kalorimu.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-2">Berat Badan (kg)</label>
                            <input type="number" step="0.1" name="weight" value="{{ old('weight', $user->weight) }}" required class="w-full bg-slate-50 border border-gray-200 rounded-xl px-4 py-3.5 text-sm font-bold text-gray-800 outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all shadow-sm" placeholder="Misal: 65">
                            <x-input-error class="mt-2" :messages="$errors->get('weight')" />
                        </div>
                        <div>
                            <label class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-2">Tinggi Badan (cm)</label>
                            <input type="number" step="0.1" name="height" value="{{ old('height', $user->height) }}" required class="w-full bg-slate-50 border border-gray-200 rounded-xl px-4 py-3.5 text-sm font-bold text-gray-800 outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all shadow-sm" placeholder="Misal: 170">
                            <x-input-error class="mt-2" :messages="$errors->get('height')" />
                        </div>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 sticky top-8">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center text-2xl shadow-inner">🎯</div>
                        <div>
                            <h3 class="text-xl font-black text-[#003d29]">Target Diet</h3>
                            <p class="text-xs text-gray-400 font-medium mt-1">Kalkulasi kalori otomatis.</p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-2">Tujuan Penggunaan</label>
                        <select name="goal" required class="w-full bg-slate-50 border border-gray-200 rounded-xl px-4 py-3.5 text-sm font-bold text-gray-800 outline-none focus:ring-2 focus:ring-rose-500 focus:bg-white transition-all shadow-sm appearance-none cursor-pointer">
                            <option value="lose" {{ old('goal', $user->goal) == 'lose' ? 'selected' : '' }}>📉 Menurunkan Berat (Defisit)</option>
                            <option value="maintain" {{ old('goal', $user->goal) == 'maintain' ? 'selected' : '' }}>⚖️ Maintain Weight (Seimbang)</option>
                            <option value="gain" {{ old('goal', $user->goal) == 'gain' ? 'selected' : '' }}>📈 Menaikkan Berat (Surplus)</option>
                        </select>
                        <div class="bg-slate-50 border border-gray-100 p-4 rounded-xl mt-3">
                            <p class="text-[10px] text-gray-500 font-medium leading-relaxed">Pilih <strong>"Maintain Weight"</strong> jika Anda hanya ingin memantau kecukupan gizi tanpa mengubah bobot badan saat ini.</p>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#008f5d] text-white py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-[#003d29] hover:shadow-lg hover:-translate-y-1 transition-all duration-300 shadow-md flex justify-center items-center gap-2">
                        <span>SIMPAN PERUBAHAN</span>
                    </button>
                    
                    @if (session('status') === 'profile-updated')
                        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)" class="mt-4 bg-[#e9fbf0] border border-[#c1ecd4] rounded-xl p-3 text-center">
                            <p class="text-xs text-[#008f5d] font-bold">✨ Data berhasil diperbarui!</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </form>
</section>
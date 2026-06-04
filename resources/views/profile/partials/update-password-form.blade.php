<section>
    <header class="mb-8">
        <div class="flex items-center gap-4 mb-2">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center text-xl shadow-inner">🔒</div>
            <div>
                <h2 class="text-2xl font-black text-[#003d29]">Keamanan Akun</h2>
                <p class="mt-1 text-xs text-gray-400 font-medium">Pastikan akunmu menggunakan kata sandi yang panjang dan aman.</p>
            </div>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-2">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full bg-slate-50 border border-gray-200 rounded-xl px-4 py-3.5 text-sm font-bold text-gray-800 outline-none focus:ring-2 focus:ring-[#008f5d] focus:bg-white transition-all shadow-sm" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-2">Kata Sandi Baru</label>
            <input id="update_password_password" name="password" type="password" class="w-full bg-slate-50 border border-gray-200 rounded-xl px-4 py-3.5 text-sm font-bold text-gray-800 outline-none focus:ring-2 focus:ring-[#008f5d] focus:bg-white transition-all shadow-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-2">Konfirmasi Kata Sandi Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full bg-slate-50 border border-gray-200 rounded-xl px-4 py-3.5 text-sm font-bold text-gray-800 outline-none focus:ring-2 focus:ring-[#008f5d] focus:bg-white transition-all shadow-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 mt-8">
            <button type="submit" class="bg-[#008f5d] text-white py-3.5 px-6 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-[#003d29] hover:-translate-y-1 transition-all duration-300 shadow-md">
                SIMPAN KATA SANDI
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-xs text-[#008f5d] font-bold">✨ Tersimpan!</p>
            @endif
        </div>
    </form>
</section>
<section class="space-y-6">
    <header class="mb-8">
        <div class="flex items-center gap-4 mb-2">
            <div class="w-12 h-12 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center text-xl shadow-inner">⚠️</div>
            <div>
                <h2 class="text-2xl font-black text-red-600">Danger Zone</h2>
                <p class="mt-1 text-xs text-gray-500 font-medium">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
        </div>
        <p class="mt-4 text-xs text-gray-500 font-medium leading-relaxed">
            Setelah akun dihapus, semua sumber daya, riwayat makanan, jurnal hidrasi, dan data log kesehatan di dalam server WeightCoach akan dimusnahkan secara permanen.
        </p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="bg-red-50 text-red-600 border border-red-200 py-3.5 px-6 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-red-600 hover:text-white hover:border-red-600 transition-all duration-300 shadow-sm">
        HAPUS AKUN PERMANEN
    </button>

    <!-- Modal Konfirmasi Hapus Akun -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-white">
            @csrf
            @method('delete')

            <h2 class="text-xl font-black text-gray-900 mb-2">
                Apakah kamu yakin ingin menghapus akun?
            </h2>

            <p class="text-xs text-gray-500 font-medium leading-relaxed">
                Tolong masukkan kata sandi kamu untuk mengonfirmasi bahwa kamu benar-benar ingin menghapus akun ini beserta seluruh isinya secara permanen.
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password" class="w-full bg-slate-50 border border-gray-200 rounded-xl px-4 py-3.5 text-sm font-bold text-gray-800 outline-none focus:ring-2 focus:ring-red-500 focus:bg-white transition-all shadow-sm" placeholder="Masukkan kata sandi untuk konfirmasi..." />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-3.5 rounded-xl border border-gray-200 text-gray-600 font-bold text-xs uppercase tracking-wider hover:bg-gray-50 transition-all">
                    Batal
                </button>

                <button type="submit" class="bg-red-600 text-white py-3.5 px-6 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-red-700 transition-all duration-300 shadow-md">
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
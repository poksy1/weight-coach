<x-app-layout>
    <!-- Background utama yang bersih -->
    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- 1. BAGIAN FORM UTAMA (BENTO GRID KITA) -->
            <!-- Kita lepaskan dari max-w-xl agar bisa selebar layar -->
            @include('profile.partials.update-profile-information-form')

            <!-- 2. BAGIAN UBAH PASSWORD -->
            <!-- Kita bungkus dengan style Premium agar senada -->
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- 3. BAGIAN HAPUS AKUN (DANGER ZONE) -->
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-red-100">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
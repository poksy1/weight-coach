<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - WeightCoach</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-white selection:bg-[#008f5d] selection:text-white">
    
    <div class="min-h-screen flex">
        
        <!-- SISI KIRI: Visual Branding (Sembunyi di layar kecil) -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-[#003d29] items-center justify-center overflow-hidden">
            <!-- Gambar Latar Belakang Healthy Food -->
            <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=1200" alt="Healthy Lifestyle" class="absolute inset-0 w-full h-full object-cover opacity-40 mix-blend-overlay hover:scale-105 transition-transform duration-[10s]">
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#002d1d] via-transparent to-transparent"></div>

            <div class="relative z-10 px-16 text-white max-w-2xl">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-3xl mb-8 shadow-lg border border-white/30">
                    🥑
                </div>
                <h1 class="text-5xl font-black mb-6 leading-tight drop-shadow-lg">
                    Perjalanan Sehatmu<br>Dimulai dari Sini.
                </h1>
                <p class="text-lg text-[#c1ecd4] font-medium leading-relaxed">
                    Masuk ke ekosistem WeightCoach untuk memantau nutrisi harian, mendapatkan rekomendasi resep cerdas, dan mencapai target tubuh idealmu.
                </p>
            </div>
        </div>

        <!-- SISI KANAN: Formulir Login -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-24 bg-slate-50 relative">
            
            <!-- Ornamen Dekoratif Blur -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#e9fbf0] rounded-full blur-3xl -z-10 opacity-70"></div>

            <div class="w-full max-w-md relative z-10">
                <!-- Header Formulir -->
                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#003d29] tracking-tight">Selamat Datang!</h2>
                    <p class="text-slate-500 font-medium mt-3">Silakan masukkan kredensial akunmu untuk melanjutkan.</p>
                </div>

                <!-- Status Session Laravel -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Input Email -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Alamat Email</label>
                        <div class="relative">
                            <span class="absolute left-4 top-4 text-slate-400">✉️</span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@email.com" 
                                   class="w-full pl-12 pr-5 py-4 rounded-2xl bg-white border border-slate-200 text-sm font-bold text-slate-800 placeholder-slate-400 focus:ring-4 focus:ring-[#008f5d]/20 focus:border-[#008f5d] transition-all outline-none shadow-sm">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500 font-bold" />
                    </div>

                    <!-- Input Password -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Kata Sandi</label>
                            @if (Route::has('password.request'))
                        </div>
                        <div class="relative">
                            <span class="absolute left-4 top-4 text-slate-400">🔒</span>
                            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" 
                                   class="w-full pl-12 pr-5 py-4 rounded-2xl bg-white border border-slate-200 text-sm font-bold text-slate-800 placeholder-slate-400 focus:ring-4 focus:ring-[#008f5d]/20 focus:border-[#008f5d] transition-all outline-none shadow-sm">
                        </div>
                        <a href="{{ route('password.request') }}" class="text-xs font-bold text-[#008f5d] hover:text-[#003d29] transition-colors">Lupa sandi?</a>
                            @endif
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500 font-bold" />
                    </div>

                    <!-- Fitur Ingat Saya -->
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="w-5 h-5 rounded border-slate-300 text-[#008f5d] focus:ring-[#008f5d] transition-colors cursor-pointer">
                        <label for="remember_me" class="ml-3 text-sm font-bold text-slate-600 cursor-pointer select-none">
                            Biarkan saya tetap masuk
                        </label>
                    </div>

                    <!-- Tombol Masuk -->
                    <button type="submit" class="w-full bg-[#003d29] text-white font-black text-sm tracking-wider uppercase py-4 rounded-2xl shadow-lg shadow-[#003d29]/30 hover:bg-[#008f5d] hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                        Masuk Sekarang
                    </button>
                </form>

                <!-- Tombol Buat Akun (Pemisah dan Tautan) -->
                <div class="mt-10">
                    <div class="relative flex items-center mb-8">
                        <div class="flex-grow border-t border-slate-200"></div>
                        <span class="flex-shrink-0 mx-4 text-slate-400 text-xs font-bold uppercase tracking-widest">Atau</span>
                        <div class="flex-grow border-t border-slate-200"></div>
                    </div>
                    
                    <div class="text-center">
                        <p class="text-sm font-bold text-slate-600 mb-4">Pengguna baru di WeightCoach?</p>
                        <a href="{{ route('register') }}" class="inline-block w-full text-center bg-white border-2 border-slate-200 text-slate-700 font-black text-sm tracking-wider uppercase py-3.5 rounded-2xl hover:border-[#008f5d] hover:text-[#008f5d] hover:bg-[#e9fbf0] transition-all duration-300">
                            Buat Akun Gratis
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>
</html>
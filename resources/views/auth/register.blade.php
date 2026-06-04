<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun - WeightCoach</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-white selection:bg-[#008f5d] selection:text-white">
    
    <div class="min-h-screen flex">
        
        <div class="hidden lg:flex lg:w-1/2 relative bg-[#003d29] items-center justify-center overflow-hidden">
            <img src="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=1200" alt="Healthy Lifestyle" class="absolute inset-0 w-full h-full object-cover opacity-40 mix-blend-overlay hover:scale-105 transition-transform duration-[10s]">
            
            <div class="absolute inset-0 bg-gradient-to-t from-[#002d1d] via-transparent to-transparent"></div>

            <div class="relative z-10 px-16 text-white max-w-2xl">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-3xl mb-8 shadow-lg border border-white/30">
                    💪
                </div>
                <h1 class="text-5xl font-black mb-6 leading-tight drop-shadow-lg">
                    Investasikan Waktu<br>Untuk Tubuh Idealmu.
                </h1>
                <p class="text-lg text-[#c1ecd4] font-medium leading-relaxed">
                    Satu langkah kecil hari ini menentukan kebugaranmu di masa depan. Bergabunglah bersama komunitas WeightCoach dan nikmati pelacakan kesehatan yang dipersonalisasi.
                </p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-24 bg-slate-50 relative overflow-y-auto max-h-screen custom-scrollbar">
            
            <div class="absolute top-0 left-0 w-64 h-64 bg-[#e9fbf0] rounded-full blur-3xl -z-10 opacity-70"></div>

            <div class="w-full max-w-md relative z-10 py-8">
                <div class="mb-8 text-center lg:text-left">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#003d29] tracking-tight">Mulai Sekarang 🚀</h2>
                    <p class="text-slate-500 font-medium mt-2">Buat akun barumu secara gratis hanya dalam satu menit.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label node-id="name" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <span class="absolute left-4 top-4 text-slate-400">👤</span>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Ezzra Rei Setiawan" 
                                   class="w-full pl-12 pr-5 py-3.5 rounded-2xl bg-white border border-slate-200 text-sm font-bold text-slate-800 placeholder-slate-300 focus:ring-4 focus:ring-[#008f5d]/20 focus:border-[#008f5d] transition-all outline-none shadow-sm">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs text-red-500 font-bold" />
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Alamat Email</label>
                        <div class="relative">
                            <span class="absolute left-4 top-4 text-slate-400">✉️</span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@email.com" 
                                   class="w-full pl-12 pr-5 py-3.5 rounded-2xl bg-white border border-slate-200 text-sm font-bold text-slate-800 placeholder-slate-300 focus:ring-4 focus:ring-[#008f5d]/20 focus:border-[#008f5d] transition-all outline-none shadow-sm">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500 font-bold" />
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Kata Sandi</label>
                        <div class="relative">
                            <span class="absolute left-4 top-4 text-slate-400">🔒</span>
                            <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" 
                                   class="w-full pl-12 pr-5 py-3.5 rounded-2xl bg-white border border-slate-200 text-sm font-bold text-slate-800 placeholder-slate-300 focus:ring-4 focus:ring-[#008f5d]/20 focus:border-[#008f5d] transition-all outline-none shadow-sm">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500 font-bold" />
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Konfirmasi Kata Sandi</label>
                        <div class="relative">
                            <span class="absolute left-4 top-4 text-slate-400">🛡️</span>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" 
                                   class="w-full pl-12 pr-5 py-3.5 rounded-2xl bg-white border border-slate-200 text-sm font-bold text-slate-800 placeholder-slate-300 focus:ring-4 focus:ring-[#008f5d]/20 focus:border-[#008f5d] transition-all outline-none shadow-sm">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-red-500 font-bold" />
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-[#003d29] text-white font-black text-sm tracking-wider uppercase py-4 rounded-2xl shadow-lg shadow-[#003d29]/30 hover:bg-[#008f5d] hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                            Daftarkan Akun
                        </button>
                    </div>
                </form>

                <div class="mt-8 pt-6 border-t border-slate-200/60 text-center">
                    <p class="text-sm font-bold text-slate-500">
                        Sudah punya akun sebelumnya? 
                        <a href="{{ route('login') }}" class="text-[#008f5d] hover:text-[#003d29] underline transition-colors ml-1">
                            Masuk di sini
                        </a>
                    </p>
                </div>

            </div>
        </div>

    </div>
</body>
</html>
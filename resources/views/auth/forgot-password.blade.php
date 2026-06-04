<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pulihkan Kata Sandi - WeightCoach</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-white selection:bg-[#008f5d] selection:text-white">
    
    <div class="min-h-screen flex">
        
        <!-- SISI KIRI: Visual Branding (Sembunyi di layar kecil) -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-[#003d29] items-center justify-center overflow-hidden">
            <!-- Gambar Latar Belakang yang Menenangkan -->
            <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=1200" alt="Mindfulness Healthy" class="absolute inset-0 w-full h-full object-cover opacity-35 mix-blend-overlay hover:scale-105 transition-transform duration-[10s]">
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#002d1d] via-transparent to-transparent"></div>

            <div class="relative z-10 px-16 text-white max-w-2xl">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-3xl mb-8 shadow-lg border border-white/30">
                    🔑
                </div>
                <h1 class="text-5xl font-black mb-6 leading-tight drop-shadow-lg">
                    Jangan Khawatir,<br>Kami Siap Membantu.
                </h1>
                <p class="text-lg text-[#c1ecd4] font-medium leading-relaxed">
                    Keamanan data dan akun kesehatanmu adalah prioritas kami. Cukup masukkan email yang terdaftar, dan kami akan mengirimkan tautan pemulihan dalam sekejap.
                </p>
            </div>
        </div>

        <!-- SISI KANAN: Formulir Lupa Password -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-24 bg-slate-50 relative">
            
            <!-- Ornamen Dekoratif Blur -->
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-[#e9fbf0] rounded-full blur-3xl -z-10 opacity-70"></div>

            <div class="w-full max-w-md relative z-10">
                <!-- Header Formulir -->
                <div class="mb-8 text-center lg:text-left">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#003d29] tracking-tight">Pulihkan Sandi 🔒</h2>
                    <p class="text-slate-500 font-medium mt-3 leading-relaxed">
                        Lupa kata sandi? Tidak masalah. Masukkan alamat emailmu di bawah ini, dan kami akan mengirimkan tautan untuk memilih kata sandi baru.
                    </p>
                </div>

                <!-- Status Session Laravel (Notifikasi sukses kirim email) -->
                @if (session('status'))
                    <div class="mb-6 p-4 rounded-2xl bg-[#e9fbf0] border border-[#c1ecd4] text-sm font-bold text-[#008f5d] flex items-center gap-2 shadow-sm">
                        <span>✨</span> {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Input Email -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Alamat Email Terdaftar</label>
                        <div class="relative">
                            <span class="absolute left-4 top-4 text-slate-400">✉️</span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com" 
                                   class="w-full pl-12 pr-5 py-4 rounded-2xl bg-white border border-slate-200 text-sm font-bold text-slate-800 placeholder-slate-400 focus:ring-4 focus:ring-[#008f5d]/20 focus:border-[#008f5d] transition-all outline-none shadow-sm">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500 font-bold" />
                    </div>

                    <!-- Tombol Kirim Tautan -->
                    <button type="submit" class="w-full bg-[#003d29] text-white font-black text-sm tracking-wider uppercase py-4 rounded-2xl shadow-lg shadow-[#003d29]/30 hover:bg-[#008f5d] hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                        Kirim Link Pemulihan
                    </button>
                </form>

                <!-- Jalur Pintas Balik ke Login -->
                <div class="mt-8 pt-6 border-t border-slate-200/60 text-center">
                    <p class="text-sm font-bold text-slate-500">
                        Ingat kata sandimu kembali? 
                        <a href="{{ route('login') }}" class="text-[#008f5d] hover:text-[#003d29] underline transition-colors ml-1">
                            Kembali ke Login
                        </a>
                    </p>
                </div>

            </div>
        </div>

    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WeightCoach - Premium Wellness & Nutrition Tracker</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        @keyframes float-delayed {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .animate-float { animation: float 5s ease-in-out infinite; }
        .animate-float-delayed { animation: float-delayed 4s ease-in-out 2s infinite; }
        
        .bg-grid-pattern {
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 30px 30px;
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-900 bg-slate-50 selection:bg-[#008f5d] selection:text-white overflow-x-hidden">

    <div class="fixed inset-0 z-0 pointer-events-none bg-grid-pattern opacity-40"></div>
    <div class="fixed top-[-10%] left-[-10%] w-96 h-96 bg-[#e9fbf0] rounded-full blur-[100px] z-0"></div>
    <div class="fixed bottom-[-10%] right-[-5%] w-[30rem] h-[30rem] bg-emerald-50 rounded-full blur-[120px] z-0"></div>

    <nav x-data="{ scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20)"
         :class="{ 'bg-white/80 backdrop-blur-md shadow-sm py-4': scrolled, 'bg-transparent py-6': !scrolled }"
         class="fixed top-0 w-full z-50 transition-all duration-300 px-6 sm:px-12 lg:px-24">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <a href="/" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-gradient-to-br from-[#003d29] to-[#008f5d] rounded-xl flex items-center justify-center text-white font-black text-xl shadow-lg group-hover:scale-105 transition-transform">
                    W
                </div>
                <span class="text-2xl font-black text-[#003d29] tracking-tight">Weight<span class="text-[#008f5d]">Coach</span></span>
            </a>

            <div class="hidden md:flex items-center gap-8">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-gray-600 hover:text-[#008f5d] transition-colors">Go to Dashboard &rarr;</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-[#008f5d] transition-colors">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-[#003d29] text-white px-6 py-2.5 rounded-full font-bold text-sm hover:bg-[#008f5d] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                                Mulai Gratis
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <main class="relative z-10 pt-32 pb-16 lg:pt-48 lg:pb-32 px-6 sm:px-12 lg:px-24 min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)" 
                 class="relative"
                 :class="{ 'opacity-100 translate-y-0': show, 'opacity-0 translate-y-12': !show }"
                 style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);">
                
                <div class="inline-block px-4 py-2 rounded-full bg-[#e9fbf0] border border-[#c1ecd4] text-[#008f5d] font-bold text-xs uppercase tracking-widest mb-6 shadow-sm">
                    ✨ Aplikasi Wellness #1
                </div>
                
                <h1 class="text-5xl lg:text-7xl font-black text-[#003d29] leading-[1.1] tracking-tight mb-6">
                    Pantau Nutrisi,<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#008f5d] to-emerald-400">
                        Capai Berat Ideal.
                    </span>
                </h1>
                
                <p class="text-lg text-gray-500 font-medium leading-relaxed mb-10 max-w-lg">
                    WeightCoach membantumu menghitung kalori harian, memantau asupan protein, dan mengatur rencana diet dengan cara yang lebih cerdas, presisi, dan menyenangkan.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="text-center bg-[#003d29] text-white px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-wider hover:bg-[#008f5d] hover:shadow-xl hover:shadow-[#008f5d]/30 hover:-translate-y-1 transition-all duration-300">
                        Mulai Perjalananmu
                    </a>
                    <a href="#fitur" class="text-center bg-white border-2 border-gray-200 text-gray-700 px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-wider hover:border-[#008f5d] hover:text-[#008f5d] hover:bg-[#e9fbf0] transition-all duration-300">
                        Pelajari Fitur
                    </a>
                </div>
                
                <div class="mt-10 flex items-center gap-4 text-sm font-bold text-gray-400">
                    <div class="flex -space-x-3">
                        <div class="w-10 h-10 rounded-full border-2 border-slate-50 bg-gray-200"><img src="https://i.pravatar.cc/100?img=1" class="rounded-full" alt="User 1"></div>
                        <div class="w-10 h-10 rounded-full border-2 border-slate-50 bg-gray-300"><img src="https://i.pravatar.cc/100?img=2" class="rounded-full" alt="User 2"></div>
                        <div class="w-10 h-10 rounded-full border-2 border-slate-50 bg-gray-400"><img src="https://i.pravatar.cc/100?img=3" class="rounded-full" alt="User 3"></div>
                    </div>
                    <p>Dipercaya oleh <span class="text-[#003d29]">10,000+</span> pengguna.</p>
                </div>
            </div>

            <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 400)"
                 :class="{ 'opacity-100 scale-100': show, 'opacity-0 scale-95': !show }"
                 style="transition: all 1s cubic-bezier(0.4, 0, 0.2, 1);"
                 class="relative lg:h-[600px] flex items-center justify-center">
                 
                <div class="absolute inset-0 bg-gradient-to-tr from-[#e9fbf0] to-emerald-100 rounded-full transform rotate-12 scale-90 animate-float opacity-50 z-0"></div>

                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=1000" alt="Healthy Food" class="relative z-10 w-full max-w-md object-cover rounded-[3rem] shadow-2xl animate-float border-8 border-white">

                <div class="absolute top-10 -left-8 sm:-left-12 bg-white p-4 rounded-3xl shadow-xl border border-gray-100 z-20 animate-float-delayed flex items-center gap-4">
                    <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center text-2xl shadow-inner">🔥</div>
                    <div>
                        <p class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Sisa Kalori</p>
                        <p class="text-xl font-black text-[#003d29]">1,450 <span class="text-sm font-bold text-gray-500">kkal</span></p>
                    </div>
                </div>

                <div class="absolute bottom-16 -right-4 sm:-right-8 bg-white p-4 rounded-3xl shadow-xl border border-gray-100 z-20 animate-float flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center text-2xl shadow-inner">💧</div>
                    <div>
                        <p class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Hidrasi</p>
                        <p class="text-xl font-black text-[#003d29]">2.5 <span class="text-sm font-bold text-gray-500">Liter</span></p>
                    </div>
                </div>
                
                <div class="absolute -bottom-6 left-10 bg-white px-5 py-3 rounded-2xl shadow-lg border border-gray-100 z-20 animate-float-delayed">
                    <p class="text-xs font-black text-[#008f5d] uppercase tracking-wider flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#008f5d] animate-pulse"></span> Target Protein Tercapai!
                    </p>
                </div>
            </div>

        </div>
    </main>

    <!-- ========================================== -->
    <!-- FITUR SECTION (ID: fitur)                  -->
    <!-- ========================================== -->
    <section id="fitur" class="py-24 bg-white relative z-10 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-24">
            
            <div class="text-center mb-20">
                <span class="inline-block px-4 py-2 rounded-full bg-[#e9fbf0] border border-[#c1ecd4] text-[#008f5d] font-bold text-xs uppercase tracking-widest mb-6 shadow-sm">
                    Fitur Unggulan
                </span>
                <h2 class="text-3xl md:text-5xl font-black text-[#003d29] tracking-tight mb-6">
                    Semua yang Kamu Butuhkan <br>Untuk <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#008f5d] to-emerald-400">Hidup Sehat.</span>
                </h2>
                <p class="text-gray-500 font-medium max-w-2xl mx-auto text-lg leading-relaxed">
                    Dirancang khusus dengan antarmuka modern untuk memudahkan perjalanan dietmu tanpa ribet. Lacak, rencanakan, dan capai targetmu dalam satu aplikasi.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                
                <div class="md:col-span-12 lg:col-span-7 bg-slate-50 rounded-[2.5rem] p-10 border border-gray-100 hover:shadow-xl transition-all duration-300 group relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-[#e9fbf0] rounded-full blur-3xl opacity-50 group-hover:scale-110 transition-transform duration-500"></div>
                    
                    <div>
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-3xl shadow-sm mb-8 border border-gray-100 group-hover:-translate-y-2 transition-transform duration-300">
                            🌍
                        </div>
                        <h3 class="text-2xl font-black text-[#003d29] mb-4">Database Nutrisi Global</h3>
                        <p class="text-gray-500 font-medium leading-relaxed max-w-md">
                            Terintegrasi langsung dengan API FatSecret. Temukan jutaan data kalori dan makronutrisi dari makanan lokal hingga internasional hanya dengan satu kali pencarian.
                        </p>
                    </div>
                    
                    <div class="mt-10 bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 w-full max-w-sm">
                        <div class="w-10 h-10 bg-[#e9fbf0] rounded-xl flex items-center justify-center">🔍</div>
                        <div class="flex-1">
                            <div class="h-2 w-24 bg-gray-200 rounded-full mb-2"></div>
                            <div class="h-2 w-16 bg-[#008f5d] rounded-full"></div>
                        </div>
                        <div class="bg-[#003d29] text-white text-[9px] font-bold px-3 py-1.5 rounded-lg">CARI</div>
                    </div>
                </div>

                <div class="md:col-span-12 lg:col-span-5 bg-gradient-to-br from-blue-50 to-blue-100 rounded-[2.5rem] p-10 border border-blue-100 hover:shadow-xl transition-all duration-300 group relative overflow-hidden flex flex-col justify-between">
                    <div>
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-3xl shadow-sm mb-8 border border-blue-50 group-hover:-translate-y-2 transition-transform duration-300">
                            💧
                        </div>
                        <h3 class="text-2xl font-black text-blue-900 mb-4">Jurnal Hidrasi</h3>
                        <p class="text-blue-700/80 font-medium leading-relaxed">
                            Jangan biarkan tubuhmu dehidrasi. Catat asupan air harianmu dengan antarmuka kapsul air interaktif untuk memastikan metabolisme tetap prima.
                        </p>
                    </div>
                </div>

                <div class="md:col-span-12 lg:col-span-5 bg-gradient-to-br from-orange-50 to-amber-50 rounded-[2.5rem] p-10 border border-orange-100 hover:shadow-xl transition-all duration-300 group relative overflow-hidden flex flex-col justify-between">
                    <div>
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-3xl shadow-sm mb-8 border border-orange-50 group-hover:-translate-y-2 transition-transform duration-300">
                            🍱
                        </div>
                        <h3 class="text-2xl font-black text-orange-900 mb-4">Rencana Makan Cerdas</h3>
                        <p class="text-orange-700/80 font-medium leading-relaxed">
                            Buat atau gunakan templat Meal Plan harian. Mencatat makanan kini semudah menekan satu tombol tanpa perlu mencari ulang dari awal.
                        </p>
                    </div>
                </div>

                <div class="md:col-span-12 lg:col-span-7 bg-[#003d29] rounded-[2.5rem] p-10 border border-[#002d1d] hover:shadow-xl transition-all duration-300 group relative overflow-hidden flex flex-col justify-between text-white">
                    <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-[#008f5d] rounded-full blur-3xl opacity-40 group-hover:scale-110 transition-transform duration-500"></div>
                    
                    <div>
                        <div class="w-16 h-16 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center text-3xl shadow-sm mb-8 border border-white/10 group-hover:-translate-y-2 transition-transform duration-300">
                            📈
                        </div>
                        <h3 class="text-2xl font-black mb-4">Analitik & Progres Mingguan</h3>
                        <p class="text-emerald-100 font-medium leading-relaxed max-w-md">
                            Pantau evaluasi dietmu melalui grafik yang mudah dipahami. Pahami pola makanmu, evaluasi asupan gula, dan pastikan kamu berada di jalur yang tepat menuju berat ideal.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-100 py-10">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="flex justify-center items-center gap-2 mb-4">
                <div class="w-6 h-6 bg-[#008f5d] rounded-md flex items-center justify-center text-white font-black text-[10px]">W</div>
                <span class="text-lg font-black text-[#003d29] tracking-tight">WeightCoach</span>
            </div>
            <p class="text-sm font-bold text-gray-400">&copy; {{ date('Y') }} WeightCoach Team. Dirancang untuk kesehatanmu.</p>
        </div>
    </footer>
</body>
</html>
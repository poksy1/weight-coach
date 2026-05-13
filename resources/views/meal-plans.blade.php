<x-app-layout>
    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Page Header -->
            <header class="mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 px-4 sm:px-0">
                <div>
                    <h2 class="text-3xl font-extrabold text-[#003d29] tracking-tight mb-1">Weekly Meal Planner</h2>
                    <p class="text-gray-500 font-medium text-sm">Design your nourishment for the week.</p>
                </div>
                <button class="bg-[#003d29] text-white px-5 py-2.5 rounded-full font-bold text-[11px] tracking-widest hover:scale-[1.02] transition-transform shadow-md flex items-center gap-2">
                    <span class="text-lg leading-none">+</span> NEW RECIPE
                </button>
            </header>

            <!-- Main Grid Layout (Dibuat md:grid-cols-3 agar langsung menyamping) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4 sm:px-0">
                
                <!-- KIRI: Planner & Suggestions (Makan 2 Kolom) -->
                <div class="md:col-span-2 flex flex-col gap-10">
                    
                    <!-- 7-Day Kalender -->
                    <section>
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-[#003d29]">This Week</h3>
                            <button class="text-[#008f5d] font-bold text-[10px] tracking-widest flex items-center gap-1 hover:underline">
                                NEXT WEEK &raquo;
                            </button>
                        </div>
                        
                        <!-- Kontainer ini tidak akan numpuk ke bawah karena pakai flex & overflow-x-auto -->
                        <div class="flex gap-4 overflow-x-auto pb-4 custom-scrollbar">
                            
                            <!-- Day: Active -->
                            <div class="bg-[#003d29] text-white rounded-[2rem] p-4 flex flex-col items-center justify-between h-40 w-20 flex-shrink-0 shadow-lg cursor-pointer hover:scale-105 transition-transform">
                                <span class="text-[10px] font-bold tracking-widest opacity-80 uppercase mt-2">Mon</span>
                                <span class="text-3xl font-extrabold">12</span>
                                <div class="flex gap-1 mb-2">
                                    <div class="w-1.5 h-1.5 rounded-full bg-[#00e676]"></div>
                                    <div class="w-1.5 h-1.5 rounded-full bg-[#00e676]"></div>
                                    <div class="w-1.5 h-1.5 rounded-full bg-white/30"></div>
                                </div>
                            </div>

                            <!-- Day: Inactive -->
                            <div class="bg-white rounded-[2rem] p-4 flex flex-col items-center justify-between h-40 w-20 flex-shrink-0 shadow-sm border border-gray-100 cursor-pointer hover:border-[#008f5d] transition-colors">
                                <span class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mt-2">Tue</span>
                                <span class="text-3xl font-extrabold text-[#003d29]">13</span>
                                <div class="flex gap-1 mb-2">
                                    <div class="w-1.5 h-1.5 rounded-full bg-gray-200"></div>
                                    <div class="w-1.5 h-1.5 rounded-full bg-gray-200"></div>
                                    <div class="w-1.5 h-1.5 rounded-full bg-gray-200"></div>
                                </div>
                            </div>
                            
                            <!-- Day: Inactive -->
                            <div class="bg-white rounded-[2rem] p-4 flex flex-col items-center justify-between h-40 w-20 flex-shrink-0 shadow-sm border border-gray-100 cursor-pointer hover:border-[#008f5d] transition-colors">
                                <span class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mt-2">Wed</span>
                                <span class="text-3xl font-extrabold text-[#003d29]">14</span>
                                <div class="flex gap-1 mb-2">
                                    <div class="w-1.5 h-1.5 rounded-full bg-gray-200"></div>
                                    <div class="w-1.5 h-1.5 rounded-full bg-gray-200"></div>
                                    <div class="w-1.5 h-1.5 rounded-full bg-gray-200"></div>
                                </div>
                            </div>

                            <!-- Day: Inactive -->
                            <div class="bg-white rounded-[2rem] p-4 flex flex-col items-center justify-between h-40 w-20 flex-shrink-0 shadow-sm border border-gray-100 cursor-pointer hover:border-[#008f5d] transition-colors">
                                <span class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mt-2">Thu</span>
                                <span class="text-3xl font-extrabold text-[#003d29]">15</span>
                                <div class="flex gap-1 mb-2">
                                    <div class="w-1.5 h-1.5 rounded-full bg-gray-200"></div>
                                </div>
                            </div>

                            <!-- Day: Inactive -->
                            <div class="bg-white rounded-[2rem] p-4 flex flex-col items-center justify-between h-40 w-20 flex-shrink-0 shadow-sm border border-gray-100 cursor-pointer hover:border-[#008f5d] transition-colors">
                                <span class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mt-2">Fri</span>
                                <span class="text-3xl font-extrabold text-[#003d29]">16</span>
                                <div class="flex gap-1 mb-2">
                                    <div class="w-1.5 h-1.5 rounded-full bg-gray-200"></div>
                                </div>
                            </div>

                            <!-- Day: Inactive -->
                            <div class="bg-white rounded-[2rem] p-4 flex flex-col items-center justify-between h-40 w-20 flex-shrink-0 shadow-sm border border-gray-100 cursor-pointer hover:border-[#008f5d] transition-colors">
                                <span class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mt-2">Sat</span>
                                <span class="text-3xl font-extrabold text-gray-400">17</span>
                            </div>

                            <!-- Day: Inactive -->
                            <div class="bg-white rounded-[2rem] p-4 flex flex-col items-center justify-between h-40 w-20 flex-shrink-0 shadow-sm border border-gray-100 cursor-pointer hover:border-[#008f5d] transition-colors">
                                <span class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mt-2">Sun</span>
                                <span class="text-3xl font-extrabold text-gray-400">18</span>
                            </div>
                        </div>
                    </section>

                    <!-- Smart Suggestions -->
                    <section>
                        <div class="flex items-center gap-2 mb-6">
                            <span class="text-[#008f5d] text-xl">✨</span>
                            <h3 class="text-lg font-bold text-[#003d29]">Smart Suggestions</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            
                            <!-- Recipe Card 1 -->
                            <div class="bg-white rounded-3xl p-4 shadow-sm border border-gray-100 cursor-pointer hover:shadow-md transition-shadow">
                                <div class="relative h-48 w-full rounded-2xl overflow-hidden mb-4">
                                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDfKgijePAxIeHHdaK4rkxPiFB505FVoZt14Ua0vyUWaZlB198pFY-VNivrJJToryPlBJjG-vKjm2A5khD1Bgr_QHvGIkdSbuukqscr1Y2-z29xuPHsSQHWM3FeVc69XCtoNBUPwLrUo-A_RjjbWayqJ9v3hdR5DZCLibv4olfI_u3P0n0GvxW-Wwk0sstWqxUdKSCn0PrGFBP_lBZ_PjyCKgyN4EXwYdu1lD65oXHOQjp2Q4FF5aAsUoqpJh7xdCFUVmatbuJQ62g" alt="Quinoa Power Bowl" class="absolute inset-0 w-full h-full object-cover">
                                    <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full flex items-center shadow-sm">
                                        <span class="text-[9px] font-bold text-[#008f5d] tracking-wider uppercase">🌱 PLANT-BASED</span>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-[17px] font-bold text-[#003d29] mb-1">Quinoa Power Bowl</h4>
                                    <p class="text-[12px] text-gray-500 mb-4 line-clamp-2">A nutrient-dense blend of roasted sweet potatoes, avocado, and...</p>
                                    <div class="flex items-center gap-3">
                                        <span class="bg-gray-50 px-2.5 py-1 rounded-md text-[10px] font-bold text-gray-600">450 kcal</span>
                                        <span class="bg-gray-50 px-2.5 py-1 rounded-md text-[10px] font-bold text-gray-600">18g Protein</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Recipe Card 2 -->
                            <div class="bg-white rounded-3xl p-4 shadow-sm border border-gray-100 cursor-pointer hover:shadow-md transition-shadow">
                                <div class="relative h-48 w-full rounded-2xl overflow-hidden mb-4">
                                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCUXQpIt5i_IBy_YISOis6eBZyQSLH25FPvOjl_-4FlDhZYSW1IXQRli-XLASKHHx0s6hnzbeVwcY_JGixxu2ALL3CDm1l8uH5IP7PKdSmWuZizeZMbH-IgxPpX2s8_xsj31JCLU6BABIi6B0fdq6MSD2d82cITiwOCLBIazuACcPoymkrposEy3K5uI1S_eIelxAHyKWf2GSz3GXOdkZ0saZau-QvfoJJMxXT_1jYatxRgPtWTnkfahId0fR1nXuuujSFzgUY31bQ" alt="Green Goddess Salad" class="absolute inset-0 w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="text-[17px] font-bold text-[#003d29] mb-1">Green Goddess Salad</h4>
                                    <p class="text-[12px] text-gray-500 mb-4 line-clamp-2">Crisp kale, cucumber, and edamame tossed in a creamy...</p>
                                    <div class="flex items-center gap-3">
                                        <span class="bg-gray-50 px-2.5 py-1 rounded-md text-[10px] font-bold text-gray-600">320 kcal</span>
                                        <span class="bg-gray-50 px-2.5 py-1 rounded-md text-[10px] font-bold text-gray-600">12g Protein</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>

                <!-- KANAN: Weekly Alignment (Makan 1 Kolom) -->
                <div class="md:col-span-1">
                    <div class="bg-[#e9fbf0] rounded-[2rem] p-8 h-full relative">
                        <h3 class="text-xl font-bold text-[#003d29] mb-8">Weekly Alignment</h3>
                        
                        <!-- Goal 1: Caloric Balance -->
                        <div class="mb-8">
                            <div class="flex justify-between items-end mb-2">
                                <span class="text-[10px] font-bold tracking-widest text-gray-500 uppercase leading-tight">CALORIC<br>BALANCE</span>
                                <span class="text-[15px] font-bold text-[#003d29]">1,850 <span class="text-xs font-medium text-gray-500">/ 2,000</span></span>
                            </div>
                            <div class="h-[6px] w-full bg-[#c9e8d6] rounded-full overflow-hidden">
                                <div class="h-full bg-[#003d29] w-[85%] rounded-full"></div>
                            </div>
                        </div>
                        
                        <!-- Goal 2: Protein Goal -->
                        <div class="mb-10">
                            <div class="flex justify-between items-end mb-2">
                                <span class="text-[10px] font-bold tracking-widest text-gray-500 uppercase">PROTEIN GOAL</span>
                                <span class="text-[15px] font-bold text-[#003d29]">85g <span class="text-xs font-medium text-gray-500">/ 120g</span></span>
                            </div>
                            <div class="h-[6px] w-full bg-[#c9e8d6] rounded-full overflow-hidden">
                                <div class="h-full bg-[#008f5d] w-[70%] rounded-full"></div>
                            </div>
                        </div>
                        
                        <!-- Habits & Intentions -->
                        <div>
                            <span class="text-[10px] font-bold tracking-widest text-gray-500 uppercase block mb-4">HABITS & INTENTIONS</span>
                            <div class="space-y-4">
                                <!-- Checked -->
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <div class="w-[22px] h-[22px] rounded-full bg-[#008f5d] flex items-center justify-center flex-shrink-0">
                                        <span class="text-white text-[10px]">✓</span>
                                    </div>
                                    <span class="text-[13px] font-medium text-gray-500 line-through">Hydrate: 3L daily</span>
                                </label>
                                
                                <!-- Unchecked -->
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <div class="w-[22px] h-[22px] rounded-full border-2 border-gray-300 flex items-center justify-center flex-shrink-0 group-hover:border-[#008f5d] transition-colors"></div>
                                    <span class="text-[13px] font-bold text-[#003d29]">Eat 3 plant-based meals</span>
                                </label>
                                
                                <!-- Unchecked -->
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <div class="w-[22px] h-[22px] rounded-full border-2 border-gray-300 flex items-center justify-center flex-shrink-0 group-hover:border-[#008f5d] transition-colors"></div>
                                    <span class="text-[13px] font-bold text-[#003d29]">Prep snacks for weekend</span>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        /* CSS untuk menghilangkan scrollbar bawaan browser tapi tetap bisa di-scroll */
        .custom-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .custom-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</x-app-layout>
<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight mb-8 px-4 sm:px-0">
                Analitik Kesehatan
            </h1>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 mb-8 mx-4 sm:mx-0 text-center flex flex-col items-center">
                <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Status Body Mass Index (BMI)</h2>
                
                <div class="flex items-end justify-center gap-2 mb-4">
                    <span class="text-6xl font-extrabold text-gray-800">{{ $bmi }}</span>
                </div>

                <span class="px-6 py-2 text-sm font-bold rounded-full {{ $bmiColor }}">
                    {{ $bmiCategory }}
                </span>
                
                <p class="text-gray-400 text-sm mt-4">
                    Berdasarkan profil: Berat {{ auth()->user()->weight ?? '-' }} kg / Tinggi {{ auth()->user()->height ?? '-' }} cm
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8 mx-4 sm:mx-0">
                <h2 class="text-lg font-bold text-gray-800 mb-6">Rapor Kalori 7 Hari Terakhir</h2>
                
                <div class="relative h-64 w-full">
                    <canvas id="weeklyChart"></canvas>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('weeklyChart').getContext('2d');
            const labels = {!! json_encode($chartLabels) !!};
            const data = {!! json_encode($chartData) !!};
            const targetCalorie = {{ $targetCalorie }};

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Kalori Terkonsumsi',
                            data: data,
                            borderColor: 'rgb(99, 102, 241)',
                            backgroundColor: 'rgba(99, 102, 241, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: 'rgb(99, 102, 241)',
                            pointRadius: 4
                        },
                        {
                            label: 'Target ({{ $targetCalorie }} kcal)',
                            data: Array(7).fill(targetCalorie),
                            borderColor: 'rgb(244, 63, 94)', // Rose color
                            borderDash: [5, 5],
                            borderWidth: 2,
                            fill: false,
                            pointRadius: 0
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        });
    </script>
</x-app-layout>
<div
    x-data="{
        chart: null,
        initChart() {
            const ctx = document.getElementById('healthChart').getContext('2d');
            this.chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @js($labels),
                    datasets: [{
                        label: 'Nilai Catatan Kesehatan',
                        data: @js($values),
                        borderColor: 'rgb(59 130 246)', // Tailwind blue-500
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Grafik Pemantauan Kesehatan'
                        }
                    }
                }
            });
        }
    }"
    x-init="initChart()"
    class="p-6 bg-white rounded-xl shadow mb-6"
>
    <canvas id="healthChart" class="w-full h-64"></canvas>
</div>

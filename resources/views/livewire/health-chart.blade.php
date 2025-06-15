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
                        label: @js($healthTypeUnit),
                        data: @js($values),
                        borderColor: '#2D805A',
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
                            text: @js($healthTypeName),
                        }
                    }
                }
            });
        }
    }"
    x-init="initChart()"
    class="bg-white rounded-xl shadow p-4 mb-6 border border-primary mx-auto"
    
>
    <canvas id="healthChart" class=""></canvas>
</div>

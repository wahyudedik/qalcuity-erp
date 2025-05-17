<!-- Production Chart -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
    <div class="p-5 border-b border-gray-200 dark:border-gray-700">
        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Weekly Production Volume</h4>
    </div>
    <div class="p-5">
        <div class="relative h-80">
            <canvas id="productionChart"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Production Chart
        const productionCtx = document.getElementById('productionChart');
        
        new Chart(productionCtx, {
            type: 'bar',
            data: {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                datasets: [{
                    label: 'Production Volume (m³)',
                    data: [95, 110, 125, 130, 115, 80, 65],
                    backgroundColor: [
                        'rgba(37, 99, 235, 0.8)',
                    ],
                    borderColor: [
                        'rgba(37, 99, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(156, 163, 175, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endpush
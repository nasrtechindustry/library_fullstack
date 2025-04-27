<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
            <h2 class="text-lg font-bold mb-4">Library Management</h2>
            @include('components.left-nav')
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 p-6 custom-flow">

        <p class="mb-3 text-custom">Welcome Again {{auth()->user()->first_name}} {{auth()->user()->last_name}}</p>
        <hr>
            <div class="container mt-4">
                <div class="row">
                    <!-- Total Students Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-lg">
                            <div class="card-header p-3 bg-primary text-white text-center ">
                                <h4 class="card-title mb-0">
                                    <i class="fas fa-users"></i> Total Students
                                </h4>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="display-4">{{ $totalStudents }}</h3>
                                <p class="text-muted">Number of registered students</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Loaned Books Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-lg">
                            <div class="card-header p-3 bg-success text-white text-center">
                                <h4 class="card-title mb-0">
                                    <i class="fas fa-book"></i> Total Loaned Books
                                </h4>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="display-4">{{ $totalLoanedBooks }}</h3>
                                <p class="text-muted">Number of books currently loaned out</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Revenue Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-lg">
                            <div class="card-header p-3 bg-warning text-white text-center">
                                <h4 class="card-title mb-0">
                                    <i class="fas fa-dollar-sign"></i> Total Revenue
                                </h4>
                            </div>
                            <div class="card-body text-center">
                                <!-- Revenue Total Display -->
                                <h3 class="display-4">{{ number_format($totalRevenue) }} Tsh</h3>
                                <p class="text-muted">Total revenue from fines</p>

                                <!-- Chart Canvas -->
                                <canvas id="revenueChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Script for Chart.js -->

                </div>
            </div>


        </main>
    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('revenueChart').getContext('2d');
    var revenueChart = new Chart(ctx, {
        type: 'line', 
        data: {
            labels: @json($months), 
            datasets: [{
                label: 'Revenue Over Time',
                data: @json($revenueData), 
                borderColor: 'rgba(255, 159, 64, 1)', 
                backgroundColor: 'rgba(255, 159, 64, 0.2)', 
                fill: true, 
                tension: 0.1, 
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.raw + ' Tsh'; // Adding "Tsh" to the tooltip
                        }
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
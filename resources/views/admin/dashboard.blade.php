<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js for charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-10" style="overflow-x: auto; height:100vh;">
                <div class="row mt-3">
                    <!-- Primary Card -->
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header">Total Orders</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $totalOrder }} Orders</h5>
                            </div>
                        </div>
                    </div>
                    <!-- Warning Card -->
                    <div class="col-md-3">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-header">Pending Orders</div>
                            <div class="card-body">
                                <h5 class="card-title">50 Pending</h5>
                            </div>
                        </div>
                    </div>
                    <!-- Success Card -->
                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-header">Completed Orders</div>
                            <div class="card-body">
                                <h5 class="card-title">200 Completed</h5>
                            </div>
                        </div>
                    </div>
                    <!-- Danger Card -->
                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-header">Cancelled Orders</div>
                            <div class="card-body">
                                <h5 class="card-title">5 Cancelled</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="row mt-4">
                    <!-- Area Chart Example -->
                    <div class="col-md-6">
                        <canvas id="areaChart"></canvas>
                    </div>
                    <!-- Bar Chart Example -->
                    <div class="col-md-6">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>

                <!-- Food Data Table -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h4>Most Ordered Foods</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Food Item</th>
                                    <th>Orders</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Pizza</td>
                                    <td>150</td>
                                </tr>
                                <tr>
                                    <td>Burger</td>
                                    <td>120</td>
                                </tr>
                                <tr>
                                    <td>Pasta</td>
                                    <td>90</td>
                                </tr>
                                <tr>
                                    <td>Salad</td>
                                    <td>50</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        // Area Chart Data and Configuration
        var ctx1 = document.getElementById('areaChart').getContext('2d');
        var areaChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['March 1', 'March 3', 'March 5', 'March 7', 'March 9', 'March 11', 'March 13'],
                datasets: [{
                    label: 'Total Orders',
                    data: [10000, 12000, 15000, 14000, 13000, 16000, 18000],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Bar Chart Data and Configuration
        var ctx2 = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Orders per Month',
                    data: [5000, 6000, 8000, 7000, 11000, 15000],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>

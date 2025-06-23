@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Bagian 1: Tiket Masuk per Periode -->
    <div class="row mb-5">
        <div class="col-12">
            <h4 class="text-center mb-4">Jumlah Tiket Masuk per Periode</h4>
            <canvas id="harianBarChart"></canvas>
        </div>
    </div>

    <!-- Bagian 2: Jumlah Layanan per Bulan -->
    <div class="row mb-5">
        <div class="col-12">
            <h4 class="text-center mb-4">Jumlah Layanan per Bulan</h4>
            <canvas id="layananLineChart"></canvas>
        </div>
    </div>

    <!-- Bagian 3: Diagram Pie -->
    <div class="row">
        <!-- Pie Chart Jenis Layanan -->
        <div class="col-md-6 mb-5">
            <h4 class="text-center mb-4">Jumlah Tiket Berdasarkan Jenis Layanan</h4>
            <canvas id="layananPieChart" class="mb-3"></canvas>
            <div class="text-center">
                @foreach ($labels as $index => $label)
                    <span style="display:inline-block;margin:0 10px;">
                        <span style="display:inline-block;width:15px;height:15px;background-color:{{ ['#FF6384', '#36A2EB', '#FFCE56', '#8E44AD', '#2ECC71'][$index % 5] }};margin-right:5px;border-radius:50%;"></span>
                        {{ $label }}
                    </span>
                @endforeach
            </div>
        </div>

        <!-- Pie Chart Status Layanan -->
        <div class="col-md-6 mb-5">
            <h4 class="text-center mb-4">Status Layanan (Buka vs Selesai)</h4>
            <canvas id="statusPieChart"></canvas>
            <div class="text-center mt-2">
                @foreach ($statusLabels as $index => $status)
                    <span style="display:inline-block;margin:0 10px;">
                        <span style="display:inline-block;width:15px;height:15px;background-color:{{ ['#3498DB', '#95A5A6'][$index % 2] }};margin-right:5px;border-radius:50%;"></span>
                        {{ ucfirst($status) }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Data dari Controller
    const labels = @json($labels);
    const values = @json($values);
    const bulanLabels = @json($bulanLabels);
    const jumlahPerBulan = @json($jumlahPerBulan);
    const statusLabels = @json($statusLabels);
    const statusCounts = @json($statusCounts);
    const tiketHariLabels = @json($tiketHariLabels);
    const tiketHariValues = @json($tiketHariValues);

    // Bar Chart Tiket Masuk per Hari
    new Chart(document.getElementById('harianBarChart'), {
        type: 'bar',
        data: {
            labels: tiketHariLabels,
            datasets: [{
                label: 'Jumlah Tiket Masuk',
                data: tiketHariValues,
                backgroundColor: '#3498DB'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Bar Chart: Jumlah Tiket Masuk per Periode'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 80,
                    title: {
                        display: true,
                        text: 'Jumlah Tiket'
                    }
                }
            }
        }
    });

    // Line Chart Layanan per Bulan
    new Chart(document.getElementById('layananLineChart'), {
        type: 'line',
        data: {
            labels: bulanLabels,
            datasets: [{
                label: 'Jumlah Layanan per Bulan',
                data: jumlahPerBulan,
                fill: false,
                borderColor: '#FF5733',
                backgroundColor: '#FF5733',
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Line Chart: Jumlah Layanan per Bulan'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precison: 0,
                        callback:function(value) {
                            return Number.isInteger(value)? value : null;
                        }
                    }
                }
            }
        }
    });

    // Pie Chart Jenis Layanan
    new Chart(document.getElementById('layananPieChart'), {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Tiket',
                data: values,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#8E44AD', '#2ECC71'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Pie Chart: Jenis Layanan'
                },
                legend: { display: false }
            }
        }
    });

    // Pie Chart Status Layanan
    new Chart(document.getElementById('statusPieChart'), {
        type: 'pie',
        data: {
            labels: statusLabels,
            datasets: [{
                label: 'Status Layanan',
                data: statusCounts,
                backgroundColor: ['#3498DB', '#95A5A6'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Pie Chart: Status Layanan'
                },
                legend: { display: false }
            }
        }
    });
</script>
@endsection

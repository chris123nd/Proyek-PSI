{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1 text-dark fw-bold">Dashboard Admin</h2>
                    <p class="text-muted mb-0">Selamat datang kembali! Berikut ringkasan sistem Anda.</p>
                </div>
                <div class="text-end">
                    <small class="text-muted">{{ date('d F Y, H:i') }}</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-ticket-alt text-info fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 fw-normal">Total Tiket</h6>
                            <h3 class="mb-0 fw-bold text-dark">{{ number_format($totalumkm) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-play-circle text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 fw-normal">Layanan Aktif</h6>
                            <h3 class="mb-0 fw-bold text-dark">{{ number_format($LayananAktif) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-danger bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-check-circle text-danger fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 fw-normal">Layanan Selesai</h6>
                            <h3 class="mb-0 fw-bold text-dark">{{ number_format($LayananSelesai) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Section -->
    @if($tiketBaru > 0)
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-warning border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-bell text-warning me-2"></i>
                    <div>
                        <strong>Notifikasi:</strong> Ada {{ $tiketBaru }} tiket baru yang menunggu verifikasi.
                        <a href="#" class="alert-link ms-2">Lihat Detail →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Charts Section -->
    <div class="row g-4">
        <!-- Bar Chart -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title mb-0 fw-bold">Statistik Layanan</h5>
                    <small class="text-muted">Ringkasan data tiket dan layanan</small>
                </div>
                <div class="card-body p-4">
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="ticketChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title mb-0 fw-bold">Survey Kepuasan </h5>
                    <small class="text-muted">Tingkat kepuasan layanan</small>
                </div>
                <div class="card-body p-4 text-center">
                    <div class="chart-container" style="position: relative; height: 250px;">
                        <canvas id="surveyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom Styles --}}
<style>
    .card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    
    .chart-container {
        width: 100%;
    }
    
    .bg-opacity-10 {
        background-color: rgba(var(--bs-primary-rgb), 0.1);
    }
    
    .alert {
        border-left: 4px solid var(--bs-warning);
    }
    
    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .card-body {
            padding: 1.5rem !important;
        }
    }
</style>

{{-- ChartJS Configuration --}}
<script>
    // Bar Chart Configuration
    var ctx = document.getElementById('ticketChart').getContext('2d');
    var ticketChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total Tiket', 'Layanan Aktif', 'Layanan Selesai'],
            datasets: [{
                label: 'Jumlah',
                data: [{{ $totalumkm }}, {{ $LayananAktif }}, {{ $LayananSelesai }}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(255, 99, 132, 0.8)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    cornerRadius: 8,
                    padding: 12
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    },
                    ticks: {
                        color: '#6c757d',
                        stepSize: 1,        // Menentukan jarak antar garis
                        precision: 0        // Membulatkan ke bilangan bulat
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6c757d'
                    }
                }
            }

        }
    });

    // Pie Chart Configuration
    var ctxSurvey = document.getElementById('surveyChart').getContext('2d');
    var surveyChart = new Chart(ctxSurvey, {
        type: 'doughnut',
        data: {
            labels: [
                'Sangat Baik (88,31-100)',
                'Baik (76,61-88,30)',
                'Kurang Baik (65-76,60)',
                'Tidak Baik (25-64,99)'
            ],
            datasets: [{
                data: [
                    {{ $surveyData['Sangat Baik'] }},
                    {{ $surveyData['Baik'] }},
                    {{ $surveyData['Kurang Baik'] }},
                    {{ $surveyData['Tidak Baik'] }}
                ],
                backgroundColor: [
                    '#28a745',
                    '#17a2b8',
                    '#ffc107',
                    '#dc3545'
                ],
                borderWidth: 3,
                borderColor: '#ffffff',
                hoverBorderWidth: 4,
                hoverBorderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 11
                        },
                        boxWidth: 12,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    cornerRadius: 8,
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            var total = context.dataset.data.reduce((a, b) => a + b, 0);
                            var percentage = ((context.parsed * 100) / total).toFixed(1);
                            return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });

    // Auto-refresh charts every 30 seconds (optional)
    setInterval(function() {
        // Add AJAX call here to refresh data if needed
        // location.reload(); // Simple refresh - uncomment if needed
    }, 30000);
</script>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="display-6 fw-bold text-primary mb-2">
                        <i class="fas fa-poll me-3"></i>Data Survey
                    </h1>
                    <p class="text-muted mb-0">Kelola dan pantau hasil survey kepuasan layanan</p>
                </div>
                {{-- <div class="d-flex gap-2">
                    <a href="{{ route('export.full') }}" class="btn btn-success btn-lg shadow-sm">
                        <i class="fas fa-download me-2"></i>Unduh Data
                    </a>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="GET" action="{{ route('surveys.index') }}" class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="filterModalLabel"><i class="fas fa-filter me-2"></i>Filter Data Survey</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <!-- Tambahkan filter sesuai kebutuhan -->
            <div class="mb-3">
            <label for="submitted" class="form-label">Status Submit</label>
            <select class="form-select" name="is_submitted" id="submitted">
                <option value="">-- Semua --</option>
                <option value="1" {{ request('is_submitted') === '1' ? 'selected' : '' }}>Selesai</option>
                <option value="0" {{ request('is_submitted') === '0' ? 'selected' : '' }}>Belum Selesai</option>
            </select>
            </div>
            <div class="mb-3">
            <label for="rating_min" class="form-label">Rating Minimal</label>
            <input type="number" step="0.1" min="0" max="100" name="rating_min" id="rating_min" class="form-control" value="{{ request('rating_min') }}">
            </div>
            <div class="mb-3">
            <label for="rating_max" class="form-label">Rating Maksimal</label>
            <input type="number" step="0.1" min="0" max="100" name="rating_max" id="rating_max" class="form-control" value="{{ request('rating_max') }}">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-filter me-1"></i>Terapkan Filter</button>
        </div>
        </form>
    </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <form method="GET" action="{{ route('surveys.index') }}">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0" 
                                   placeholder="Cari berdasarkan nama Req, jenis layanan, atau komentar..." 
                                   value="{{ request('search') }}">
                            <button class="btn btn-primary px-4" type="submit">
                                <i class="fas fa-search me-2"></i>Cari
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 text-end mt-3 mt-md-0">
                    <div class="d-flex gap-2 justify-content-end">
                        <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#filterModal">
                            <i class="fas fa-filter me-1"></i>Filter
                        </button>
                        <button class="btn btn-outline-primary btn-sm" onclick="exportTableToExcel('surveyTable')">
                            <i class="fas fa-file-excel me-1"></i>Export Excel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title opacity-75 mb-1">Total Survey</h6>
                            <h3 class="mb-0 fw-bold">{{ $surveys->count() }}</h3>
                        </div>
                        <div class="ms-3">
                            <div class="rounded-circle bg-white bg-opacity-25 p-3">
                                <i class="fas fa-poll fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-success text-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title opacity-75 mb-1">Survey Selesai</h6>
                            <h3 class="mb-0 fw-bold">{{ $surveys->where('is_submitted', true)->count() }}</h3>
                        </div>
                        <div class="ms-3">
                            <div class="rounded-circle bg-white bg-opacity-25 p-3">
                                <i class="fas fa-check-circle fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-warning text-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title opacity-75 mb-1">Menunggu Submit</h6>
                            <h3 class="mb-0 fw-bold">{{ $surveys->where('is_submitted', false)->count() }}</h3>
                        </div>
                        <div class="ms-3">
                            <div class="rounded-circle bg-white bg-opacity-25 p-3">
                                <i class="fas fa-clock fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-info text-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title opacity-75 mb-1">Rating Rata-rata</h6>
                            <h3 class="mb-0 fw-bold">{{ number_format($surveys->avg('survey'), 1) }}</h3>
                        </div>
                        <div class="ms-3">
                            <div class="rounded-circle bg-white bg-opacity-25 p-3">
                                <i class="fas fa-star fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom-0 py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-semibold">
                    <i class="fas fa-table me-2 text-primary"></i>Daftar Survey Kepuasan
                </h5>
                <span class="badge bg-light text-dark fs-6">{{ $surveys->count() }} Data</span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="surveyTable" class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0 fw-semibold text-uppercase text-muted small ps-4">
                                <i class="fas fa-hashtag me-2"></i>Survey ID
                            </th>
                            <th class="border-0 fw-semibold text-uppercase text-muted small">
                                <i class="fas fa-user me-2"></i>Nama Req
                            </th>
                            <th class="border-0 fw-semibold text-uppercase text-muted small">
                                <i class="fas fa-cog me-2"></i>Jenis Layanan
                            </th>
                            <th class="border-0 fw-semibold text-uppercase text-muted small">
                                <i class="fas fa-calendar me-2"></i>Tanggal Layanan
                            </th>
                            <th class="border-0 fw-semibold text-uppercase text-muted small">
                                <i class="fas fa-star me-2"></i>Rating
                            </th>
                            <th class="border-0 fw-semibold text-uppercase text-muted small">
                                <i class="fas fa-comment me-2"></i>Komentar
                            </th>
                            <th class="border-0 fw-semibold text-uppercase text-muted small pe-4">
                                <i class="fas fa-tools me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($surveys as $survey)
                            <tr class="border-bottom">
                                <td class="ps-4">
                                    <span class="badge bg-light text-dark fw-semibold">
                                        #{{ str_pad($survey->id, 3, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <i class="fas fa-building text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ $survey->layanan->umkm->nama ?? '-' }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 fw-medium">
                                        {{ $survey->layanan->jenis_layanan ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-alt text-muted me-2"></i>
                                        <span class="fw-medium">
                                            {{ \Carbon\Carbon::parse($survey->layanan->tanggal_layanan)->format('d M Y') }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @php
                                            $rating = $survey->survey;
                                        @endphp
                                        <span class="ms-2">
                                            {{ $rating }}
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <div class="comment-preview" style="max-width: 200px;">
                                        @if($survey->komentar)
                                            <span class="text-truncate d-block" title="{{ $survey->komentar }}">
                                                {{ Str::limit($survey->komentar, 50) }}
                                            </span>
                                        @else
                                            <span class="text-muted fst-italic">Tidak ada komentar</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="pe-4">
                                    @if(!$survey->is_submitted)
                                        <div class="d-flex gap-2 flex-wrap">
                                            <a href="{{ route('surveys.edit', $survey->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <form action="{{ route('surveys.submit', $survey->id) }}" method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Yakin ingin submit survey? Setelah ini tidak bisa diubah.')">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fas fa-paper-plane me-1"></i>Submit
                                                </button>
                                            </form>
                                            <a href="{{ route('surveys.show', $survey->id) }}" class="btn btn-outline-warning btn-sm">
                                                <i class="fas fa-eye me-1"></i>Detail
                                            </a>
                                        </div>
                                    @else
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-success bg-opacity-15 text-success border border-success border-opacity-25">
                                                <i class="fas fa-check me-1"></i>Selesai
                                            </span>
                                            <a href="{{ route('surveys.show', $survey->id) }}" class="btn btn-outline-warning btn-sm">
                                                <i class="fas fa-eye me-1"></i>Detail
                                            </a>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="mb-3">
                                            <i class="fas fa-poll fa-3x text-muted opacity-50"></i>
                                        </div>
                                        <h5 class="text-muted mb-2">Belum Ada Data Survey</h5>
                                        <p class="text-muted mb-0">Data survey akan muncul di sini setelah survey dibuat</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="px-4 py-3">
                    {{ $surveys->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>

    <!-- Bottom Actions -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center p-4 bg-light rounded-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle text-primary me-2"></i>
                    <span class="text-muted">Total {{ $surveys->count() }} survey ditemukan</span>
                </div>
                <div class="d-flex gap-3">
                    <a href="{{ route('export.full') }}" class="btn btn-success">
                        <i class="fas fa-download me-2"></i>Unduh Semua Data
                    </a>
                    <a href="{{ route('account.dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .avatar-sm {
        width: 40px;
        height: 40px;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.03);
        transition: background-color 0.2s ease;
    }
    
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    
    .btn {
        transition: all 0.2s ease;
    }
    
    .btn:hover {
        transform: translateY(-1px);
    }
    
    .badge {
        font-size: 0.75rem;
        padding: 0.375rem 0.75rem;
    }
    
    .input-group .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    
    .rating-stars .fa-star {
        font-size: 0.9rem;
    }
    
    .comment-preview {
        min-height: 24px;
    }
    
    .alert {
        border: none;
        border-radius: 0.5rem;
    }
    
    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    function exportTableToExcel(tableID) {
        var table = document.getElementById(tableID);
        var wb = XLSX.utils.table_to_book(table, { sheet: "Data Survey" });
        XLSX.writeFile(wb, 'data_survey.xlsx');
    }

    // Add smooth scrolling and animations
    document.addEventListener('DOMContentLoaded', function() {
        // Fade in animation for cards
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
        
        // Add loading state to search button
        const searchForm = document.querySelector('form');
        const searchButton = searchForm?.querySelector('button[type="submit"]');
        
        if (searchForm && searchButton) {
            searchForm.addEventListener('submit', function() {
                searchButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mencari...';
                searchButton.disabled = true;
            });
        }
        
        // Enhanced confirm dialogs
        const confirmForms = document.querySelectorAll('form[onsubmit*="confirm"]');
        confirmForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const confirmMessage = 'Yakin ingin submit survey? Setelah ini tidak bisa diubah.';
                if (!confirm(confirmMessage)) {
                    e.preventDefault();
                }
            });
        });
        
        // Auto dismiss alerts
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                if (alert.classList.contains('show')) {
                    alert.classList.remove('show');
                    setTimeout(() => alert.remove(), 150);
                }
            });
        }, 5000);
    });
</script>
@endpush
@endsection
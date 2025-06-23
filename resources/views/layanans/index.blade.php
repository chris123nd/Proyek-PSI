@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="display-6 fw-bold text-primary mb-2">
                        <i class="fas fa-cogs me-3"></i>Data Layanan
                    </h1>
                    <p class="text-muted mb-0">Kelola dan pantau layanan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Filter -->
        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <form method="GET" action="{{ route('layanans.index') }}" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">
                <i class="fas fa-filter me-2"></i>Filter Layanan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <!-- Status -->
                <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status" id="status">
                    <option value="">Semua</option>
                    <option value="buka" {{ request('status') === 'buka' ? 'selected' : '' }}>Buka</option>
                    <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                </div>

                <!-- Jenis Layanan -->
                <div class="mb-3">
                <label for="jenis_layanan" class="form-label">Jenis Layanan</label>
                <input type="text" class="form-control" name="jenis_layanan" id="jenis_layanan" value="{{ request('jenis_layanan') }}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                <i class="fas fa-filter me-1"></i>Terapkan
                </button>
                <a href="{{ route('layanans.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
            </form>
        </div>
        </div>


    <!-- Search and Filter Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <form method="GET" action="{{ route('layanans.index') }}">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0" 
                                   placeholder="Cari berdasarkan nama REQ, jenis layanan..." 
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
                            <h6 class="card-title opacity-75 mb-1">Total Layanan</h6>
                            <h3 class="mb-0 fw-bold">{{ $layanans->count() }}</h3>
                        </div>
                        <div class="ms-3">
                            <div class="rounded-circle bg-white bg-opacity-25 p-3">
                                <i class="fas fa-clipboard-list fa-lg"></i>
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
                            <h6 class="card-title opacity-75 mb-1">Status Buka</h6>
                            <h3 class="mb-0 fw-bold">{{ $layanans->where('status', 'buka')->count() }}</h3>
                        </div>
                        <div class="ms-3">
                            <div class="rounded-circle bg-white bg-opacity-25 p-3">
                                <i class="fas fa-door-open fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-secondary text-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title opacity-75 mb-1">Selesai</h6>
                            <h3 class="mb-0 fw-bold">{{ $layanans->where('status', 'selesai')->count() }}</h3>
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
            <div class="card border-0 shadow-sm bg-info text-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title opacity-75 mb-1">Sudah Survey</h6>
                            <h3 class="mb-0 fw-bold">{{ $layanans->whereNotNull('survey')->count() }}</h3>
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
    </div>

    <!-- Data Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom-0 py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-semibold">
                    <i class="fas fa-table me-2 text-primary"></i>Daftar Layanan
                </h5>
                <span class="badge bg-light text-dark fs-6">{{ $layanans->count() }} Data</span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0 fw-semibold text-uppercase text-muted small ps-4">
                                <i class="fas fa-hashtag me-2"></i>ID Req
                            </th>
                            <th class="border-0 fw-semibold text-uppercase text-muted small">
                                <i class="fas fa-id-badge me-2"></i>ID Layanan
                            </th>
                            <th class="border-0 fw-semibold text-uppercase text-muted small">
                                <i class="fas fa-user me-2"></i>Nama Req
                            </th>
                            <th class="border-0 fw-semibold text-uppercase text-muted small">
                                <i class="fas fa-calendar me-2"></i>Tanggal
                            </th>
                            <th class="border-0 fw-semibold text-uppercase text-muted small">
                                <i class="fas fa-cog me-2"></i>Jenis Layanan
                            </th>
                            <th class="border-0 fw-semibold text-uppercase text-muted small">
                                <i class="fas fa-flag me-2"></i>Status
                            </th>
                            <th class="border-0 fw-semibold text-uppercase text-muted small pe-4">
                                <i class="fas fa-tools me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($layanans as $index => $layanan)
                            <tr class="border-bottom">
                                <td class="ps-4">
                                    <span class="badge bg-light text-dark fw-semibold">
                                        #{{ str_pad($layanan->umkm_id, 3, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-primary text-white">
                                        {{ str_pad($layanan->id, 3, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <i class="fas fa-building text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ $layanan->umkm->nama ?? '-' }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-alt text-muted me-2"></i>
                                        <span class="fw-medium">
                                            {{ \Carbon\Carbon::parse($layanan->tanggal_layanan)->format('d M Y') }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 fw-medium">
                                        {{ $layanan->jenis_layanan }}
                                    </span>
                                </td>
                                <td>
                                    @if ($layanan->status === 'buka')
                                        <span class="badge bg-success bg-opacity-15 text-success border border-success border-opacity-25 fw-medium">
                                            <i class="fas fa-door-open me-1"></i>Buka
                                        </span>
                                    @elseif ($layanan->status === 'selesai')
                                        <span class="badge bg-secondary bg-opacity-15 text-secondary border border-secondary border-opacity-25 fw-medium">
                                            <i class="fas fa-check-circle me-1"></i>Selesai
                                        </span>
                                    @endif
                                </td>
                                <td class="pe-4">
                                    <div class="d-flex gap-2">
                                        @if (!$layanan->survey)
                                            <a href="{{ route('umkms.layanans.surveys.create', ['umkm' => $layanan->umkm_id, 'layanan' => $layanan->id]) }}" 
                                               class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-poll me-1"></i>Survey
                                            </a>
                                        @else
                                            <span class="badge bg-info bg-opacity-15 text-info border border-info border-opacity-25">
                                                <i class="fas fa-check me-1"></i>Sudah Survey
                                            </span>
                                        @endif
                                        
                                        @if ($layanan->status !== 'selesai')
                                            <a href="{{ route('layanans.edit', $layanan->id) }}" 
                                               class="btn btn-outline-secondary btn-sm">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="mb-3">
                                            <i class="fas fa-inbox fa-3x text-muted opacity-50"></i>
                                        </div>
                                        <h5 class="text-muted mb-2">Belum Ada Data Layanan</h5>
                                        <p class="text-muted mb-0">Data layanan akan muncul di sini setelah ditambahkan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="px-4 py-3">
                    {{ $layanans->links('pagination::bootstrap-5') }}
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
</style>
@endpush

@push('scripts')
<script>
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
    });
</script>
@endpush
@endsection
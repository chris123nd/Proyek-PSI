@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="display-6 fw-bold text-primary mb-2">
                        <i class="fas fa-clipboard-list me-3"></i>Data Request
                    </h1>
                    <p class="text-muted mb-0">Kelola permintaan layanan</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('umkms.create') }}" 
                       class="btn btn-success btn-lg shadow-sm">
                        <i class="fas fa-plus me-2"></i>Tambah Data
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <form method="GET" action="{{ route('umkms.index') }}">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0" 
                                   placeholder="Cari nama, instansi atau jenis perusahaan..." 
                                   value="{{ request('search') }}">
                            <button class="btn btn-primary px-4" type="submit">
                                <i class="fas fa-search me-2"></i>Cari
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Tombol Filter & Export -->
                <div class="d-flex gap-2 justify-content-end">
                    <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fas fa-filter me-1"></i>Filter
                    </button>
                    {{-- <button class="btn btn-outline-success btn-sm">
                        <i class="fas fa-download me-1"></i>Export
                    </button> --}}
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Filter -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="GET" action="{{ route('umkms.index') }}" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="filterModalLabel">Filter Data</h5>
        <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#filterModal">
            <i class="fas fa-filter me-1"></i>Filter
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="statusFilter" class="form-label">Status</label>
          <select name="status" id="statusFilter" class="form-select">
            <option value="">-- Semua Status --</option>
            <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
            <option value="verifikasi" {{ request('status') == 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
            <option value="cancel" {{ request('status') == 'cancel' ? 'selected' : '' }}>Cancel</option>
            <option value="close" {{ request('status') == 'close' ? 'selected' : '' }}>Close</option>
          </select>
        </div>
        <!-- Tambahkan filter lain di sini kalau perlu -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-filter me-1"></i> Terapkan
        </button>
      </div>
    </form>
  </div>
</div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title opacity-75 mb-1">Total Request</h6>
                            <h3 class="mb-0 fw-bold">{{ $umkms->total() }}</h3>
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
                            <h6 class="card-title opacity-75 mb-1">Buka Tiket</h6>
                            <h3 class="mb-0 fw-bold">{{ $umkms->where('status', 'open')->count() }}</h3>
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
            <div class="card border-0 shadow-sm bg-info text-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title opacity-75 mb-1">Verifikasi</h6>
                            <h3 class="mb-0 fw-bold">{{ $umkms->where('status', 'verifikasi')->count() }}</h3>
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
            <div class="card border-0 shadow-sm bg-warning text-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title opacity-75 mb-1">Sudah Dilayani</h6>
                            <h3 class="mb-0 fw-bold">{{ $umkms->filter(function($umkm) { return $umkm->layanans()->exists(); })->count() }}</h3>
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
    </div>

    <!-- Data Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom-0 py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-semibold">
                    <i class="fas fa-table me-2 text-primary"></i>Daftar Request
                </h5>
                <span class="badge bg-light text-dark fs-6">{{ $umkms->total() }} Data</span>
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
                                <i class="fas fa-user me-2"></i>Nama
                            </th>
                            <th class="border-0 fw-semibold text-uppercase text-muted small">
                                <i class="fas fa-building me-2"></i>Instansi
                            </th>
                            <th class="border-0 fw-semibold text-uppercase text-muted small">
                                <i class="fas fa-venus-mars me-2"></i>Jenis Kelamin
                            </th>
                            <th class="border-0 fw-semibold text-uppercase text-muted small sortable-header">
                                @php
                                    $currentSort = request('sort') === 'asc' ? 'desc' : 'asc';
                                    $sortDirection = request('sort');
                                @endphp
                                <a href="{{ route('umkms.index', array_merge(request()->all(), ['sort' => $currentSort])) }}" 
                                   class="text-decoration-none text-muted d-flex align-items-center">
                                    <i class="fas fa-calendar me-2"></i>
                                    <span>Tanggal</span>
                                    <span class="ms-2">
                                        @if($sortDirection === 'asc')
                                            <i class="fas fa-sort-up text-primary"></i>
                                        @elseif($sortDirection === 'desc')
                                            <i class="fas fa-sort-down text-primary"></i>
                                        @else
                                            <i class="fas fa-sort"></i>
                                        @endif
                                    </span>
                                </a>
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
                        @forelse($umkms as $index => $umkm)
                            <tr class="border-bottom">
                                <td class="ps-4">
                                    <span class="badge bg-light text-dark fw-semibold">
                                        #{{ str_pad($umkms->firstItem() + $index, 3, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ $umkm->nama }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-building text-muted me-2"></i>
                                        <span class="fw-medium">{{ $umkm->instansi }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 fw-medium">
                                        {{ $umkm->jenis_kelamin }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-alt text-muted me-2"></i>
                                        <span class="fw-medium">
                                            {{ \Carbon\Carbon::parse($umkm->tanggal)->format('d M Y') }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $statusConfig = [
                                            'open' => ['class' => 'success', 'icon' => 'door-open', 'text' => 'Open'],
                                            'verifikasi' => ['class' => 'info', 'icon' => 'clock', 'text' => 'Verifikasi'],
                                            'cancel' => ['class' => 'danger', 'icon' => 'times-circle', 'text' => 'Cancel'],
                                            'close' => ['class' => 'secondary', 'icon' => 'check-circle', 'text' => 'Close']
                                        ];
                                        $config = $statusConfig[$umkm->status] ?? ['class' => 'dark', 'icon' => 'question', 'text' => ucfirst($umkm->status)];
                                    @endphp
                                    <span class="badge bg-{{ $config['class'] }} bg-opacity-15 text-{{ $config['class'] }} border border-{{ $config['class'] }} border-opacity-25 fw-medium">
                                        <i class="fas fa-{{ $config['icon'] }} me-1"></i>{{ $config['text'] }}
                                    </span>
                                </td>
                                <td class="pe-4">
                                    <div class="d-flex gap-2 flex-wrap">
                                        @php
                                            $sudahDilayani = $umkm->layanans()->exists();
                                        @endphp

                                        @if (!$sudahDilayani)
                                            <a href="{{ route('umkms.layanans.create', ['umkm' => $umkm->id]) }}"
                                                class="btn btn-primary btn-sm"
                                                onclick="return confirm('Apakah anda yakin memverifikasi data ini?')">
                                                <i class="fas fa-arrow-right me-1"></i>Lanjut
                                            </a>

                                            @if($umkm->status === 'open')
                                                <a href="{{ route('umkms.edit', $umkm->id) }}" class="btn btn-outline-warning btn-sm">
                                                    <i class="fas fa-edit me-1"></i>Edit
                                                </a>
                                            @else
                                                <button class="btn btn-outline-warning btn-sm" disabled>
                                                    <i class="fas fa-edit me-1"></i>Edit
                                                </button>
                                            @endif

                                            <a href="{{ route('umkms.updateStatus', ['id' => $umkm->id, 'status' => 'cancel']) }}" 
                                               class="btn btn-outline-danger btn-sm"
                                               onclick="return confirm('Apakah anda yakin ingin membatalkan request ini?')">
                                                <i class="fas fa-times me-1"></i>Cancel
                                            </a>
                                        @else
                                            <span class="badge bg-warning bg-opacity-15 text-warning border border-warning border-opacity-25">
                                                <i class="fas fa-check me-1"></i>Sudah Dilayani
                                            </span>
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
                                        <h5 class="text-muted mb-2">Belum Ada Data Request</h5>
                                        <p class="text-muted mb-0">Data request UMKM akan muncul di sini setelah ditambahkan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        @if($umkms->hasPages())
        <div class="card-footer bg-white border-top-0">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Menampilkan {{ $umkms->firstItem() }} - {{ $umkms->lastItem() }} dari {{ $umkms->total() }} data
                </div>
                <div>
                    {{ $umkms->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
        @endif
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
    
    .sortable-header {
        cursor: pointer;
        user-select: none;
        transition: background-color 0.2s ease;
    }
    
    .sortable-header:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }
    
    .sort-icon {
        font-size: 0.8em;
        opacity: 0.6;
    }
    
    .sort-icon.active {
        opacity: 1;
        color: #0d6efd;
    }
    
    .pagination .page-link {
        border-radius: 0.375rem;
        border: 1px solid #dee2e6;
        color: #6c757d;
        margin: 0 2px;
    }
    
    .pagination .page-link:hover {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #0d6efd;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
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
        
        // Enhanced confirm dialogs
        const confirmButtons = document.querySelectorAll('[onclick*="confirm"]');
        confirmButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const originalOnclick = this.getAttribute('onclick');
                if (originalOnclick) {
                    e.preventDefault();
                    const confirmMessage = originalOnclick.match(/confirm\('([^']+)'\)/);
                    if (confirmMessage) {
                        if (confirm(confirmMessage[1])) {
                            // Execute the action
                            if (this.tagName === 'A') {
                                window.location.href = this.href;
                            }
                        }
                    }
                }
            });
        });
    });
</script>
@endpush
@endsection
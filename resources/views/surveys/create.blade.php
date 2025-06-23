@extends('layouts.app')
@section('content')

<div class="container py-5">
    <h1 class="text-center mb-5 fw-bold">Survey</h1>

    <form action="{{ route('surveys.store') }}" method="POST" novalidate onsubmit="return validateForm()">
        @csrf
        <input type="hidden" name="layanan_id" value="{{ $layanan->id }}">

    <div class="row mb-4">
        <div class="col-md-4">
            <label class="form-label">ID Layanan</label>
            <input type="text" class="form-control" value="{{ str_pad($layanan->id, 3, '0', STR_PAD_LEFT) }}" readonly>
        </div>
        <div class="col-md-4">
            <label class="form-label">Jenis Layanan</label>
            <input type="text" class="form-control" value="{{ $layanan->jenis_layanan }}" readonly>
        </div>
        <div class="col-md-4">
            <label class="form-label">Petugas Layanan</label>
            <input type="text" class="form-control" value="{{ $layanan->petugas_layanan }}" readonly>
        </div>
    </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">Isi Layanan</label>
                <textarea class="form-control" rows="3" readonly>{{ $layanan->isi_layanan }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Rating</label>
                <input type="number" name="survey" class="form-control @error('survey') is-invalid @enderror" value="{{ old('survey') }}" required>
                @error('survey') <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">Tanggal Layanan</label>
                <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($layanan->tanggal_layanan)->format('d-m-Y') }}" readonly>
            </div>
            
            <div class="col-md-6">
                <label class="form-label">Komentar</label>
                <textarea name="komentar" class="form-control" rows="3"></textarea>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success px-4">Simpan Survey</button>
        </div>
    </form>
</div>

@endsection

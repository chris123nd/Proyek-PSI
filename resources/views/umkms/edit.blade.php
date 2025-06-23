@extends('layouts.app')

@section('content')
{{-- <script src="https://cdn.tailwindcss.com"></script> --}}
<div class="container bg-white p-4 rounded shadow" >
    <h2 class="text-center mb-4">Edit Data UMKM</h2>

    {{-- Menampilkan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('umkms.update', $umkm->id) }}" method="POST" class="row g-3">
        @csrf
        @method('PUT')

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $umkm->nama) }}">
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $umkm->email) }}">
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="Laki-laki" {{ old('jenis_kelamin', $umkm->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $umkm->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Negara</label>
            <input type="text" name="negara" class="form-control" value="{{ old('negara', $umkm->negara) }}">
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Tanggal</label>
            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $umkm->tanggal) }}">
            @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Instansi</label>
            <input type="text" name="instansi" class="form-control" value="{{ old('instansi', $umkm->instansi) }}">
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Provinsi</label>
            <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi', $umkm->provinsi) }}">
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Jenis Perusahaan</label>
            <input type="text" name="jenis_perusahaan" class="form-control" value="{{ old('jenis_perusahaan', $umkm->jenis_perusahaan) }}">
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Kota</label>
            <input type="text" name="kota" class="form-control" value="{{ old('kota', $umkm->kota) }}">
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $umkm->alamat) }}">
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Usia</label>
            <input type="text" name="usia" class="form-control" value="{{ old('usia', $umkm->usia) }}">
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan', $umkm->pekerjaan) }}">
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">No Fax</label>
            <input type="text" name="no_fax" class="form-control" value="{{ old('no_fax', $umkm->no_fax) }}">
        </div>

        <div class="col-12 text-end">
            <a href="{{ route('umkms.index') }}" class="btn btn-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>

    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="bg-white p-4 rounded shadow max-w-3xl mx-auto mb-12">
    <h2 class="text-center mb-4">Data Pribadi</h2>

    <form action="{{ route('umkms.store') }}" method="POST" class="row g-3" novalidate onsubmit="return validateForm()">
        @csrf

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Nama</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama lengkap Anda" value="{{ old('nama') }}" required maxlength="50">
            @error('nama')
                <div class="text-danger d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="contoh: email@example.com" value="{{ old('email') }}">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Negara</label>
            <input type="text" name="negara" class="form-control @error('negara') is-invalid @enderror" placeholder="contoh: Indonesia" value="{{ old('negara') }}">
            @error('negara') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        @php
            $today = \Carbon\Carbon::now()->format('Y-m-d');
        @endphp

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
            @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Instansi</label>
            <input type="text" name="instansi" class="form-control @error('instansi') is-invalid @enderror" placeholder="contoh: PT Sukses Makmur" value="{{ old('instansi') }}">
            @error('instansi') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Provinsi</label>
            <select name="provinsi" class="form-control @error('provinsi') is-invalid @enderror">
                <option value="">Pilih Provinsi</option>
                <option value="Aceh" {{ old('provinsi') == 'Aceh' ? 'selected' : '' }}>Aceh</option>
                <option value="Sumatera Utara" {{ old('provinsi') == 'Sumatera Utara' ? 'selected' : '' }}>Sumatera Utara</option>
                <option value="Sumatera Barat" {{ old('provinsi') == 'Sumatera Barat' ? 'selected' : '' }}>Sumatera Barat</option>
                <option value="Riau" {{ old('provinsi') == 'Riau' ? 'selected' : '' }}>Riau</option>
                <option value="Kepulauan Riau" {{ old('provinsi') == 'Kepulauan Riau' ? 'selected' : '' }}>Kepulauan Riau</option>
                <option value="Jambi" {{ old('provinsi') == 'Jambi' ? 'selected' : '' }}>Jambi</option>
                <option value="Bengkulu" {{ old('provinsi') == 'Bengkulu' ? 'selected' : '' }}>Bengkulu</option>
                <option value="Sumatera Selatan" {{ old('provinsi') == 'Sumatera Selatan' ? 'selected' : '' }}>Sumatera Selatan</option>
                <option value="Kepulauan Bangka Belitung" {{ old('provinsi') == 'Kepulauan Bangka Belitung' ? 'selected' : '' }}>Kepulauan Bangka Belitung</option>
                <option value="Lampung" {{ old('provinsi') == 'Lampung' ? 'selected' : '' }}>Lampung</option>
                <option value="Banten" {{ old('provinsi') == 'Banten' ? 'selected' : '' }}>Banten</option>
                <option value="DKI Jakarta" {{ old('provinsi') == 'DKI Jakarta' ? 'selected' : '' }}>DKI Jakarta</option>
                <option value="Jawa Barat" {{ old('provinsi') == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                <option value="Jawa Tengah" {{ old('provinsi') == 'Jawa Tengah' ? 'selected' : '' }}>Jawa Tengah</option>
                <option value="DI Yogyakarta" {{ old('provinsi') == 'DI Yogyakarta' ? 'selected' : '' }}>DI Yogyakarta</option>
                <option value="Jawa Timur" {{ old('provinsi') == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
                <option value="Bali" {{ old('provinsi') == 'Bali' ? 'selected' : '' }}>Bali</option>
                <option value="Nusa Tenggara Barat" {{ old('provinsi') == 'Nusa Tenggara Barat' ? 'selected' : '' }}>Nusa Tenggara Barat</option>
                <option value="Nusa Tenggara Timur" {{ old('provinsi') == 'Nusa Tenggara Timur' ? 'selected' : '' }}>Nusa Tenggara Timur</option>
                <option value="Kalimantan Barat" {{ old('provinsi') == 'Kalimantan Barat' ? 'selected' : '' }}>Kalimantan Barat</option>
                <option value="Kalimantan Tengah" {{ old('provinsi') == 'Kalimantan Tengah' ? 'selected' : '' }}>Kalimantan Tengah</option>
                <option value="Kalimantan Selatan" {{ old('provinsi') == 'Kalimantan Selatan' ? 'selected' : '' }}>Kalimantan Selatan</option>
                <option value="Kalimantan Timur" {{ old('provinsi') == 'Kalimantan Timur' ? 'selected' : '' }}>Kalimantan Timur</option>
                <option value="Kalimantan Utara" {{ old('provinsi') == 'Kalimantan Utara' ? 'selected' : '' }}>Kalimantan Utara</option>
                <option value="Sulawesi Utara" {{ old('provinsi') == 'Sulawesi Utara' ? 'selected' : '' }}>Sulawesi Utara</option>
                <option value="Sulawesi Tengah" {{ old('provinsi') == 'Sulawesi Tengah' ? 'selected' : '' }}>Sulawesi Tengah</option>
                <option value="Sulawesi Selatan" {{ old('provinsi') == 'Sulawesi Selatan' ? 'selected' : '' }}>Sulawesi Selatan</option>
                <option value="Sulawesi Tenggara" {{ old('provinsi') == 'Sulawesi Tenggara' ? 'selected' : '' }}>Sulawesi Tenggara</option>
                <option value="Gorontalo" {{ old('provinsi') == 'Gorontalo' ? 'selected' : '' }}>Gorontalo</option>
                <option value="Sulawesi Barat" {{ old('provinsi') == 'Sulawesi Barat' ? 'selected' : '' }}>Sulawesi Barat</option>
                <option value="Maluku" {{ old('provinsi') == 'Maluku' ? 'selected' : '' }}>Maluku</option>
                <option value="Maluku Utara" {{ old('provinsi') == 'Maluku Utara' ? 'selected' : '' }}>Maluku Utara</option>
                <option value="Papua" {{ old('provinsi') == 'Papua' ? 'selected' : '' }}>Papua</option>
                <option value="Papua Barat" {{ old('provinsi') == 'Papua Barat' ? 'selected' : '' }}>Papua Barat</option>
                <option value="Papua Selatan" {{ old('provinsi') == 'Papua Selatan' ? 'selected' : '' }}>Papua Selatan</option>
                <option value="Papua Tengah" {{ old('provinsi') == 'Papua Tengah' ? 'selected' : '' }}>Papua Tengah</option>
                <option value="Papua Pegunungan" {{ old('provinsi') == 'Papua Pegunungan' ? 'selected' : '' }}>Papua Pegunungan</option>
                <option value="Papua Barat Daya" {{ old('provinsi') == 'Papua Barat Daya' ? 'selected' : '' }}>Papua Barat Daya</option>
            </select>
            @error('provinsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Jenis Perusahaan</label>
            <input type="text" name="jenis_perusahaan" class="form-control @error('jenis_perusahaan') is-invalid @enderror" placeholder="Jenis Perusahaan" value="{{ old('jenis_perusahaan') }}">
            @error('jenis_perusahaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6 mt-4">
            <label class="block font-medium mb-1 text-gray-700">Kota/Kab</label>
            <select name="kota" id="kota" class="form-control @error('kota') is-invalid @enderror">
                <option value="">Pilih Kota/Kab</option>
                {{-- Opsi akan diisi otomatis oleh JS jika Sumatera Utara dipilih --}}
            </select>
            @error('kota') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Alamat</label>
            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="contoh: Jl. Merdeka No. 10, Balige" value="{{ old('alamat') }}">
            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Usia</label>
            <input type="text" name="usia" class="form-control @error('usia') is-invalid @enderror" placeholder="contoh: 30" value="{{ old('usia') }}">
            @error('usia') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" placeholder="contoh: Wiraswasta" value="{{ old('pekerjaan') }}">
            @error('pekerjaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>


        <div class="col-md-6">
            <label class="block font-medium mb-1 text-gray-700">No Fax</label>
            <input type="text" name="no_fax" class="form-control @error('no_fax') is-invalid @enderror" placeholder="contoh: 0623-1234567" value="{{ old('no_fax') }}">
            @error('no_fax') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>

</div>
@endsection

@section('scripts')
<script>
const dataKotaKab = {
    'Sumatera Utara': [
        // Kabupaten
        'Asahan', 'Batu Bara', 'Dairi', 'Deli Serdang', 'Humbang Hasundutan', 'Karo', 'Labuhan Batu', 'Labuhan Batu Selatan', 'Labuhan Batu Utara', 'Langkat', 'Mandailing Natal', 'Nias', 'Nias Barat', 'Nias Selatan', 'Nias Utara', 'Padang Lawas', 'Padang Lawas Utara', 'Pakpak Bharat', 'Samosir', 'Serdang Bedagai', 'Simalungun', 'Tapanuli Selatan', 'Tapanuli Tengah', 'Tapanuli Utara', 'Toba Samosir',
        // Kota
        'Binjai', 'Gunungsitoli', 'Medan', 'Padangsidimpuan', 'Pematangsiantar', 'Sibolga', 'Tanjung Balai', 'Tebing Tinggi'
    ]
};

const provinsiSelect = document.querySelector('select[name="provinsi"]');
const kotaSelect = document.getElementById('kota');

function updateKotaKab() {
    const provinsi = provinsiSelect.value;
    kotaSelect.innerHTML = '<option value="">Pilih Kota/Kab</option>';
    if (dataKotaKab[provinsi]) {
        dataKotaKab[provinsi].forEach(function(kota) {
            const option = document.createElement('option');
            option.value = kota;
            option.textContent = kota;
            kotaSelect.appendChild(option);
        });
    }
}

provinsiSelect.addEventListener('change', updateKotaKab);
// Jika form reload dan provinsi sudah terisi, isi kota/kab juga
document.addEventListener('DOMContentLoaded', function() {
    updateKotaKab();
    // Set selected kota jika ada old value
    const oldKota = @json(old('kota'));
    if (oldKota) {
        kotaSelect.value = oldKota;
    }
});
</script>
@endsection

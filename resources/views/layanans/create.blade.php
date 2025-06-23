@extends('layouts.app')  
@section('content')                    

<div class="container my-5">
    <h2 class="text-center mb-4" style="color: black; font-weight: bold;">Form Layanan</h2>

    <form action="{{ route('umkms.layanans.store', ['umkm' => $umkm->id]) }}" method="POST" novalidate>
        @csrf
        <input type="hidden" name="umkm_id" value="{{ $umkm->id }}">

        {{-- Informasi UMKM --}}
        <h4 class="mb-3 border-bottom pb-2">Informasi UMKM</h4>
        <div class="row">
            @foreach ([
                'ID Req' => str_pad($umkm->id, 3, '0', STR_PAD_LEFT),
                'Nama' => $umkm->nama,
                'Tanggal' => $umkm->tanggal,
                'Email' => $umkm->email,
                'Jenis Kelamin' => $umkm->jenis_kelamin,
                'Negara' => $umkm->negara,
                'Instansi' => $umkm->instansi,
                'Provinsi' => $umkm->provinsi,
                'Jenis Perusahaan' => $umkm->jenis_perusahaan,
                'Kota' => $umkm->kota,
                'Alamat' => $umkm->alamat,
                'Usia' => $umkm->usia,
                'Pekerjaan' => $umkm->pekerjaan,
                'No Fax' => $umkm->no_fax
            ] as $label => $value)
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ $label }}</label>
                <input type="text" class="form-control bg-light" value="{{ $value }}" readonly>
            </div>
            @endforeach
        </div>

        {{-- Form Layanan --}}
        <h4 class="mt-4 mb-3 border-bottom pb-2">Layanan</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Jenis Layanan</label>
                <select name="jenis_layanan" id="jenis_layanan" class="form-select" onchange="toggleFields()" required>
                    <option value="" disabled selected hidden>Pilih Jenis Layanan</option>
                    <option value="permintaan informasi" {{ old('jenis_layanan') == 'permintaan informasi' ? 'selected' : '' }}>Permintaan Informasi</option>
                    <option value="pendampingan" {{ old('jenis_layanan') == 'pendampingan' ? 'selected' : '' }}>Pendampingan</option>
                    <option value="pengaduan" {{ old('jenis_layanan') == 'pengaduan' ? 'selected' : '' }}>Pengaduan</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Petugas Layanan</label>
                <input type="text" name="petugas_layanan" class="form-control" value="{{ old('petugas_layanan') }}">
            </div>

            <!-- Isi layanan -->
            <div id="isi_layanan_field" class="col-12 mb-3" style="display: none;">
                <label>Isi Layanan</label>
                <textarea name="isi_layanan" class="form-control"></textarea>
            </div>


            @php $today = \Carbon\Carbon::now()->format('Y-m-d'); @endphp
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Layanan</label>
                <input type="date" name="tanggal_layanan" class="form-control" value="{{ old('tanggal_layanan') }}" min="{{ $today }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Jam Layanan</label>
                <input type="time" name="jam_layanan" class="form-control" value="{{ old('jam_layanan') }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Whatsapp</label>
                <input type="text" name="no_telpon" class="form-control" value="{{ old('no_telpon') }}" required>
            </div>

            {{-- Zoom Field --}}
            <div id="pendampingan_fields" class="col-md-6 mb-3" style="display: none;">
                <label class="form-label">Zoom</label>
                <div class="input-group">
                    <input type="text" name="zoom" id="zoom_link" class="form-control" readonly>
                    <button type="button" onclick="generateZoom()" class="btn btn-success">Generate Zoom</button>
                </div>
                <small id="zoom_status" class="text-muted"></small>
            </div>

            <div id="pengaduan_fields" class="col-md-12 mb-3" style="display: none;">
                <label class="form-label">Hasil pengaduan</label>
                <textarea name="hasil_pengaduan" class="form-control" rows="3"></textarea>
            </div>

            <div id="informasi_fields" class="col-md-12 mb-3" style="display: none;">
                <label class="form-label">Hasil Permintaan Informasi</label>
                <textarea name="hasil_permintaan_informasi" class="form-control" rows="3"></textarea>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Layanan</button>
        </div>
    </form>
</div>

{{-- Scripts --}}
<script>
        function toggleFields() {
            const jenis = document.getElementById('jenis_layanan').value;

            const pendampinganFields = document.getElementById('pendampingan_fields');
            const pengaduanFields = document.getElementById('pengaduan_fields');
            const informasiFields = document.getElementById('informasi_fields');
            const isiLayananField = document.getElementById('isi_layanan_field');

            const petugasField = document.querySelector('input[name="petugas_layanan"]').closest('.col-md-6');
            const isiLayanan = document.querySelector('textarea[name="isi_layanan"]');
            const jamLayanan = document.querySelector('input[name="jam_layanan"]').closest('.col-md-6');

            pendampinganFields.style.display = jenis === 'pendampingan' ? 'block' : 'none';
            pengaduanFields.style.display = jenis === 'pengaduan' ? 'block' : 'none';
            informasiFields.style.display = jenis === 'permintaan informasi' ? 'block' : 'none';
            isiLayananField.style.display = jenis === 'pendampingan' ? 'block' : 'none';

            // Tampilkan Petugas hanya untuk pendampingan
            if (jenis === 'pendampingan') {
                petugasField.style.display = 'block';
                petugasField.querySelector('input').setAttribute('required', 'required');
            } else {
                petugasField.style.display = 'none';
                petugasField.querySelector('input').removeAttribute('required');
                petugasField.querySelector('input').value = '';
            }

            // Jam layanan tetap tampil kecuali jenis pengaduan
            // if (jenis === 'pengaduan') {
            //     jamLayanan.style.display = 'none';
            //     jamLayanan.querySelector('input').removeAttribute('required');
            //     jamLayanan.querySelector('input').value = '';
            // } else {
            //     jamLayanan.style.display = 'block';
            //     jamLayanan.querySelector('input').setAttribute('required', 'required');
            // }

            // Required isi layanan hanya saat pendampingan
            if (jenis === 'pendampingan') {
                isiLayanan.setAttribute('required', 'required');
            } else {
                isiLayanan.removeAttribute('required');
                isiLayanan.value = ''; // clear kalau pindah jenis layanan
            }
        }


    function generateZoom() {
        const tanggal = document.querySelector('input[name="tanggal_layanan"]').value;
        const jam = document.querySelector('input[name="jam_layanan"]').value;
        const status = document.getElementById('zoom_status');

        if (!tanggal || !jam) {
            status.innerText = 'Isi tanggal dan jam terlebih dahulu.';
            return;
        }

        status.innerText = 'Membuat link Zoom...';

        fetch('{{ route("generate.zoom.link") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                tanggal_layanan: tanggal,
                jam_layanan: jam,
                id: '{{ $umkm->id }}'
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.join_url) {
                document.getElementById('zoom_link').value = data.join_url;
                status.innerText = 'Link Zoom berhasil dibuat.';
            } else {
                status.innerText = 'Gagal membuat link Zoom.';
            }
        })
        .catch(() => {
            status.innerText = 'Terjadi kesalahan saat membuat Zoom.';
        });
    }

    document.addEventListener("DOMContentLoaded", toggleFields);
</script>

@endsection

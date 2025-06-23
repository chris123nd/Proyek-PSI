@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Detail Survey</h2>

    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">Request</dt>
                <dd class="col-sm-8">{{ $survey->layanan->umkm->nama ?? '-' }}</dd>

                <dt class="col-sm-4">Jenis Kelamin</dt>
                <dd class="col-sm-8">{{ $survey->layanan->umkm->jenis_kelamin ?? '-' }}</dd>

                <dt class="col-sm-4">Instansi</dt>
                <dd class="col-sm-8">{{ $survey->layanan->umkm->instansi ?? '-' }}</dd>

                <dt class="col-sm-4">Jenis Perusahaan</dt>
                <dd class="col-sm-8">{{ $survey->layanan->umkm->jenis_perusahaan ?? '-' }}</dd>

                <dt class="col-sm-4">Alamat</dt>
                <dd class="col-sm-8">{{ $survey->layanan->umkm->alamat ?? '-' }}</dd>

                <dt class="col-sm-4">Usia</dt>
                <dd class="col-sm-8">{{ $survey->layanan->umkm->usia ?? '-' }}</dd>
                
                <dt class="col-sm-4">Pekerjaan</dt>
                <dd class="col-sm-8">{{ $survey->layanan->umkm->pekerjaan ?? '-' }}</dd>

                <dt class="col-sm-4">Email</dt>
                <dd class="col-sm-8">{{ $survey->layanan->umkm->email ?? '-' }}</dd>

                <dt class="col-sm-4">Negara</dt>
                <dd class="col-sm-8">{{ $survey->layanan->umkm->negara ?? '-' }}</dd>

                <dt class="col-sm-4">Provinsi</dt>
                <dd class="col-sm-8">{{ $survey->layanan->umkm->provinsi ?? '-' }}</dd>

                <dt class="col-sm-4">Kota/Kab</dt>
                <dd class="col-sm-8">{{ $survey->layanan->umkm->kota ?? '-' }}</dd>

                <dt class="col-sm-4">No. Telp</dt>
                <dd class="col-sm-8">{{ $survey->layanan->no_telpon ?? '-' }}</dd>

                <dt class="col-sm-4">No. Fax</dt>
                <dd class="col-sm-8">{{ $survey->layanan->umkm->no_fax ?? '-' }}</dd>
            
                <dt class="col-sm-4">Jenis Layanan</dt>
                <dd class="col-sm-8">{{ $survey->layanan->jenis_layanan ?? '-' }}</dd>

                <dt class="col-sm-4">Tanggal Layanan</dt>
                <dd class="col-sm-8">{{ $survey->layanan->tanggal_layanan ?? '-' }}</dd>

                <dt class="col-sm-4">Petugas Layanan</dt>
                <dd class="col-sm-8">{{ $survey->layanan->petugas_layanan ?? '-' }}</dd>

                <dt class="col-sm-4">Isi Layanan</dt>
                <dd class="col-sm-8">{{ $survey->layanan->isi_layanan ?? '-' }}</dd>

                <dt class="col-sm-4">Tanggal Survey</dt>
                <dd class="col-sm-8">{{ \Carbon\Carbon::parse($survey->tanggal)->format('d-m-Y') }}</dd>

                <dt class="col-sm-4">Komentar</dt>
                <dd class="col-sm-8">{{ $survey->komentar ?? '-' }}</dd>

                <dt class="col-sm-4">Rating</dt>
                <dd class="col-sm-8">{{ $survey->survey }}</dd>
            </dl>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <div class="d-flex justify-content-between mt-3">
                        <a href="/surveys" class="btn btn-secondary">Kembali</a>
                        <a href="#" class="btn btn-primary" onclick="downloadPDF()">Unduh</a>
                    </div>
            </div>
        </div>
    <script>
        function downloadPDF() {
            const element = document.querySelector('.card');
            const opt = {
                margin:       0.5,
                filename:     'data_pengguna.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>

@endsection
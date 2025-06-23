<?php

namespace App\Exports;

use App\Models\Umkm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FullDataExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Umkm::with(['layanans.survey'])->get()->map(function ($umkm) {
            return $umkm->layanans->map(function ($layanan) use ($umkm) {
                return [
                    'Nama UMKM' => $umkm->nama,
                    'Jenis Kelamin' => $umkm->jenis_kelamin,
                    'Instansi' => $umkm->instansi,
                    'Alamat' => $umkm->alamat,
                    'Usia' => $umkm->usia,
                    'Pekerjaan' =>$umkm->pekerjaan,
                    'Email' =>$umkm->email,
                    'Negara' =>$umkm->negara,
                    'Provinsi' => $umkm->provinsi,
                    'Kota' => $umkm->kota,
                    'No Fax' => $umkm->no_fax,
                    'Jenis Perusahaan' => $umkm->jenis_perusahaan,
                    'Tanggal Request' => $umkm->tanggal,
                    'Jenis Layanan' => $layanan->jenis_layanan,
                    'Tanggal Layanan' => $layanan->tanggal_layanan,
                    'Status Layanan' => $layanan->status,
                    'Rating Survey' => $layanan->survey->survey ?? '-',
                    'Komentar Survey' => $layanan->survey->komentar ?? '-',
                ];
            });
        })->collapse();
    }

    public function headings(): array
    {
        return [
            'Nama UMKM',
            'Jenis Kelamin',
            'Instansi',
            'Jenis Perusahaan',
            'Alamat',
            'Usia',
            'Pekerjaan',
            'Email',
            'Negara',
            'Provinsi',
            'Kota',
            'No Fax',
            'Tanggal Request',
            'Jenis Layanan',
            'Tanggal Layanan',
            'Status Layanan',
            'Rating Survey',
            'Komentar Survey',
        ];
    }
}


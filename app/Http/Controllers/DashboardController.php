<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Survey;
use App\Models\Ticket;
use App\Models\Umkm;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(): View
    {
        $totalumkm = Umkm::distinct('nama')->count('nama');
        $LayananAktif = Layanan::where('status', 'Buka')->count();
        $LayananSelesai = Layanan::where('status', 'Selesai')->count();
        $tiketBaru = Umkm::where('status', 'open')->count();

        $surveyData = [

            'Sangat Baik' => Survey::whereBetween('survey', [88.31, 100.00])->count(),
            'Baik' => Survey::whereBetween('survey', [76.61, 88.30])->count(),
            'Kurang Baik' => Survey::whereBetween('survey', [65.00, 76.60])->count(),
            'Tidak Baik' => Survey::whereBetween('survey', [25.00, 64.99])->count(),
        ];
        
        return view('dashboard', compact('totalumkm', 'LayananAktif', 'LayananSelesai', 'surveyData', 'tiketBaru'));

    }

    
    public function chart()
    {
        // Pie & bar chart data untuk jenis layanan
        $data = DB::table('layanans')
            ->select('jenis_layanan', DB::raw('count(*) as total'))
            ->groupBy('jenis_layanan')
            ->get();

        $labels = $data->pluck('jenis_layanan');
        $values = $data->pluck('total');

        // Line chart data: jumlah layanan per bulan
        $layananPerBulan = DB::table('layanans')
            ->select(DB::raw("DATE_FORMAT(created_at, '%M %Y') as bulan"), DB::raw('count(*) as total'))
            ->groupBy('bulan')
            ->orderBy(DB::raw("STR_TO_DATE(bulan, '%M %Y')"))
            ->get();

        $bulanLabels = $layananPerBulan->pluck('bulan');
        $jumlahPerBulan = $layananPerBulan->pluck('total');

        // Data status layanan
        $statusLayanan = DB::table('layanans')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        $statusLabels = $statusLayanan->pluck('status');
        $statusValues = $statusLayanan->pluck('total');

        $statusData = DB::table('layanans')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        $statusLabels = $statusData->pluck('status');
        $statusCounts = $statusData->pluck('total');

        // Durasi penyelesaian layanan per jenis layanan
        $durasiRataRata = DB::table('layanans')
            ->select('jenis_layanan', DB::raw('AVG(DATEDIFF(updated_at, created_at)) as rata_hari'))
            ->whereNotNull('updated_at')
            ->groupBy('jenis_layanan')
            ->get();

        $durasiLabels = $durasiRataRata->pluck('jenis_layanan');
        $durasiValues = $durasiRataRata->pluck('rata_hari');

            // Tiket masuk per hari (Minggu - Sabtu)
        $tiketPerHari = DB::table('layanans')
            ->select(DB::raw("DAYNAME(created_at) as hari"), DB::raw("COUNT(*) as total"))
            ->groupBy('hari')
            ->get();

        // Urutkan hari manual
        $hariUrut = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $hariNama = ['Ming', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

        $hariCounts = array_fill_keys($hariUrut, 0);
        foreach ($tiketPerHari as $item) {
            $hariCounts[$item->hari] = $item->total;
        }

        $tiketHariLabels = $hariNama;
        $tiketHariValues = array_values($hariCounts);
        return view('statistik', compact(
        'labels', 'values',
        'bulanLabels', 'jumlahPerBulan',
        'statusLabels', 'statusCounts',
        'durasiLabels', 'durasiValues', 'tiketHariLabels', 'tiketHariValues',


    ));

    }
}

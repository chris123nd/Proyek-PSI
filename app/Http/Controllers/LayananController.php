<?php
namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http; // pastikan ini di atas

// use Illuminate\Support\Facades\DB;

class LayananController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $jenisLayanan = $request->input('jenis_layanan');

        $query = Layanan::with('umkm');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('umkm', function ($subQ) use ($search) {
                    $subQ->where('nama', 'like', '%' . $search . '%');
                })->orWhere('jenis_layanan', 'like', '%' . $search . '%');
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($jenisLayanan) {
            $query->where('jenis_layanan', 'like', '%' . $jenisLayanan . '%');
        }

        // Ubah ini: orderBy tanggal_layanan descending
        $layanans = $query->orderBy('tanggal_layanan', 'asc')
                        ->paginate(10)
                        ->withQueryString(); // agar filter tetap

        return view('layanans.index', compact('layanans'));
    }


    public function create($umkmId): View
    {
        $umkm = Umkm::findOrFail($umkmId);

        if ($umkm->status !== 'verifikasi') {
            $umkm->status = 'verifikasi';
            $umkm->save();
        }

        return view('layanans.create', compact('umkm'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'umkm_id' => 'required|exists:umkms,id',
            'jenis_layanan' => 'required',
            'tanggal_layanan' => 'required|date',
            'petugas_layanan' => 'nullable',
            'no_telpon' => 'required',
            'isi_layanan' => 'nullable|string',
            'hasil_permintaan_informasi' => 'nullable|string',
            'hasil_pengaduan' => 'nullable|string',
        ], [
            'jenis_layanan.required' => 'Jenis layanan wajib dipilih.',
            'tanggal_layanan.required' => 'Tanggal layanan wajib diisi.',
            'petugas_layanan.required' => 'Petugas layanan wajib diisi.',
            'no_telpon.required' => 'Nomor WhatsApp wajib diisi.',
        ]);

        $layanan = Layanan::create($request->all());

        // Kirim pesan WhatsApp jika berhasil
        try {
            $message = "Halo!";

            switch ($layanan->jenis_layanan) {
                case 'permintaan informasi':
                    // $message .= " Layanan Permintaan Informasi Anda telah dijadwalkan pada tanggal {$layanan->tanggal_layanan} oleh petugas {$layanan->petugas_layanan}.";
                    $message .= "\nHasil Permintaan Informasi: {$layanan->hasil_permintaan_informasi}";
                    break;

                case 'pendampingan':
                    $message .= "\nIsi Layanan Pendampingan: {$layanan->isi_layanan}";
                    break;

                case 'pengaduan':
                    // $message .= " Layanan Pengaduan Anda telah dijadwalkan pada tanggal {$layanan->tanggal_layanan} oleh petugas {$layanan->petugas_layanan}.";
                    $message .= "\nHasil Pengaduan: {$layanan->hasil_pengaduan}";
                    break;

            }

            // Tambahkan info Zoom jika tersedia
            if ($layanan->zoom) {
                $message .= "\nBerikut link Zoom Anda: {$layanan->zoom}";
            }

            // Kirim via Fonnte
            Http::withHeaders([
                'Authorization' => 'sJKyRptUdnqLVpKCHHvF',
            ])->post('https://api.fonnte.com/send', [
                'target' => $layanan->no_telpon,
                'message' => $message,
            ]);

        } catch (\Exception $e) {
            return redirect()->route('layanans.index')
                ->with('warning', 'Layanan berhasil dibuat, namun pengiriman WhatsApp gagal.');
        }

        return redirect()->route('layanans.index')->with('success', 'Layanan berhasil dibuat dan pesan WhatsApp telah dikirim.');

    }

    public function updateStatus($id, $status): RedirectResponse
    {
        $validStatuses = ['buka', 'selesai'];

        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $layanan = Layanan::findOrFail($id);
        $layanan->status = $status;
        $layanan->save();

        return redirect()->back()->with('success', 'Status layanan diperbarui ke: ' . ucfirst($status));
    }

    public function edit($id): View
    {
        $layanan = Layanan::findOrFail($id);
        return view('layanans.edit', compact('layanan'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'jenis_layanan' => 'required|string|max:255',
            'isi_layanan' => 'required|string',
            'tanggal_layanan' => 'required|date',
            'petugas_layanan' => 'required|string|max:255',
            'zoom' => 'nullable|string|max:255',
            'no_telpon' => 'required|string|max:13',
            'pesan' => 'nullable|string|max:255',
            'status' => 'required|in:buka,selesai',
        ]);

        $layanan = Layanan::findOrFail($id);
        $layanan->update($request->all());

        return redirect()->route('layanans.index')->with('success', 'Data layanan berhasil diperbarui.');
    }

}
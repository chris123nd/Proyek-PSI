<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UmkmController extends Controller
{
    public function index(Request $request)
    {
        $query = Umkm::query();

        // Pencarian
            // if ($request->filled('search')) {
            //     $query->where(function($q) use ($request) {
            //         $q->where('nama', 'like', '%'.$request->search.'%')
            //         ->orWhere('instansi', 'like', '%'.$request->search.'%')
            //         ->orWhere('jenis_perusahaan', 'like', '%'.$request->search.'%');
            //     });
            // }

            if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('instansi', 'like', '%' . $request->search . '%')
                ->orWhere('jenis_perusahaan', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // if ($request->has('sort')) {
        //     $query->orderBy('tanggal', $request->sort);
        // } else {
        //     $query->orderByDesc('tanggal');
        // }

        // Sorting
        $sortOrder = $request->input('sort', 'asc'); // default ASC (paling lama dulu)
        $query->orderBy('tanggal', $sortOrder);

        $umkms = $query->paginate(10)->appends($request->query());

        return view('umkms.index', compact('umkms'));
    }

    public function create(): View
    {
        // Menampilkan halaman form pembuatan UMKM
        return view('umkms.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validasi data yang diterima dari form dengan pesan kustom
        $request->validate([
            'nama' => 'required|max:50',
            'email' => 'required|email',
            'jenis_kelamin' => 'required',
            'tanggal' => 'required|date',
            'negara' => 'required',
            'instansi' => 'required',
            'provinsi' => 'required',
            'jenis_perusahaan' => 'required',
            'kota' => 'required',
            'alamat' => 'required',
            'usia' => 'nullable|integer',
            'pekerjaan' => 'nullable|string',
            'no_fax' => 'nullable',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid. Harap masukkan email yang benar.',
            'jenis_kelamin.required' => 'Silakan pilih jenis kelamin.',
            'tanggal.required' => 'Tanggal lahir tidak valid. Harap masukkan format yang benar (dd/mm/yyyy).',
            'tanggal.date' => 'Tanggal harus berupa tanggal yang valid.',
            'provinsi.required' => 'Provinsi harus dipilih.',
            'kota.required' => 'Kota harus diisi.',
            'no_fax.required' => 'Nomor fax harus diisi dengan benar.',
            'negara.required' => 'Negara harus dipilih.',
            'instansi.required' => 'Instansi harus diisi.',
            'jenis_perusahaan.required' => 'Jenis perusahaan harus dipilih.',
            'alamat.required' => 'Alamat harus diisi.',
        ]);

        // Simpan data ke database
        Umkm::create($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('umkms.index')->with('success', 'UMKM created successfully.');
    }

    public function edit($id): View
{
    // Ambil data UMKM berdasarkan ID
    $umkm = Umkm::findOrFail($id);

    // Tampilkan view edit dan kirimkan data UMKM
    return view('umkms.edit', compact('umkm'));
}

    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi data yang diterima dari form dengan pesan kustom
        $request->validate([
            'nama' => 'required|max:50',
            'email' => 'required|email',
            'jenis_kelamin' => 'required',
            'tanggal' => 'required|date',
            'negara' => 'required',
            'instansi' => 'required',
            'provinsi' => 'required',
            'jenis_perusahaan' => 'required',
            'kota' => 'required',
            'alamat' => 'required',
            'usia' => 'nullable|integer',
            'pekerjaan' => 'nullable|string',
            'no_fax' => 'nullable',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid. Harap masukkan email yang benar.',
            'jenis_kelamin.required' => 'Silakan pilih jenis kelamin.',
            'tanggal.required' => 'Tanggal lahir tidak valid. Harap masukkan format yang benar (dd/mm/yyyy).',
            'tanggal.date' => 'Tanggal harus berupa tanggal yang valid.',
            'provinsi.required' => 'Provinsi harus dipilih.',
            'kota.required' => 'Kota harus diisi.',
            'no_fax.required' => 'Nomor fax harus diisi dengan benar.',
            'negara.required' => 'Negara harus dipilih.',
            'instansi.required' => 'Instansi harus diisi.',
            'jenis_perusahaan.required' => 'Jenis perusahaan harus dipilih.',
            'alamat.required' => 'Alamat harus diisi.',
        ]);

        // Update data UMKM
        $umkm = Umkm::findOrFail($id);
        $umkm->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('umkms.index')->with('success', 'UMKM updated successfully.');
    }

    public function updateStatus($id, $status): RedirectResponse
    {
        // Daftar status yang valid
        $validStatuses = ['open', 'verifikasi', 'cancel', 'close'];

        // Periksa apakah status yang diterima valid
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        // Temukan UMKM berdasarkan ID
        $umkm = Umkm::findOrFail($id);

        // Perbarui status UMKM
        $umkm->status = $status;
        $umkm->save();

        // Redirect dengan pesan sukses
        return redirect()->route('umkms.index')->with('success', 'Status berhasil diperbarui ke: ' . ucfirst($status));
    }
}

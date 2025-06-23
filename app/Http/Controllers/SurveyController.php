<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SurveyController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $ratingMin = $request->input('rating_min');
        $ratingMax = $request->input('rating_max');
        $isSubmitted = $request->input('is_submitted');

        $surveys = Survey::with('layanan.umkm')
            ->when($search, function ($query, $search) {
                $query->whereHas('layanan.umkm', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhereHas('layanan', function ($q) use ($search) {
                    $q->where('jenis_layanan', 'like', "%{$search}%");
                });
            })
            ->when(!is_null($isSubmitted), fn($q) => $q->where('is_submitted', $isSubmitted))
            ->when($ratingMin, fn($q) => $q->where('survey', '>=', $ratingMin))
            ->when($ratingMax, fn($q) => $q->where('survey', '<=', $ratingMax))
            ->latest()
            ->paginate(10);

        return view('surveys.index', compact('surveys'));
    }


    public function create($umkmId, $layananId): View
    {
        $layanan = Layanan::where('id', $layananId)->where('umkm_id', $umkmId)->firstOrFail();

        if ($layanan->status !== 'selesai') {
            $layanan->status = 'selesai';
            $layanan->save();
        }

        return view('surveys.create', compact('layanan'));
    }

        public function store(Request $request): RedirectResponse
        {
            $request->validate([
                'layanan_id' => 'required|exists:layanans,id',
                'survey' => 'required|integer|min:1|max:100',
                'komentar' => 'nullable|string|max:255',
            ], [
                'survey.required' => 'Survey harus diisi.',
            ]);

            // Cek apakah sudah ada survey untuk layanan_id tersebut
            $existingSurvey = Survey::where('layanan_id', $request->layanan_id)->first();
            if ($existingSurvey) {
                return redirect()->back()->withErrors([
                    'survey' => 'Survey untuk layanan ini sudah pernah dibuat.'
                ])->withInput();
            }

            Survey::create($request->only('layanan_id', 'survey', 'komentar'));

            return redirect()->route('surveys.index')->with('success', 'Survey berhasil disimpan.');
        }

    public function show($id): View
    {
        $survey = Survey::with('layanan.umkm')->findOrFail($id);
        return view('surveys.show', compact('survey'));
    }

    public function edit($id): View
    {
        $survey = Survey::findOrFail($id);

        return view('surveys.edit', compact('survey'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $survey = Survey::findOrFail($id);

        $request->validate([
            'survey' => 'required|integer|min:1|max:100',
            'komentar' => 'nullable|string|max:255',
        ]);

        $survey->update($request->only('survey', 'komentar'));

        return redirect()->route('surveys.index')->with('success', 'Survey updated successfully.');
    }

    public function submit(Survey $survey)
    {
        $survey->update([
            'is_submitted' => true,
            // 'submitted_at' => now(), // jika pakai timestamp
        ]);

        return redirect()->route('surveys.index')->with('success', 'Survey berhasil disubmit.');
    }

}


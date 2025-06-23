@extends('layouts.app')
@section('content')

<div class="container py-5">
    <h2 class="mb-4 text-center">Edit Survey</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('surveys.update', $survey->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="survey" class="form-label">Rating</label>
            <input
                type="number"
                name="survey"
                id="survey"
                class="form-control"
                min="1"
                max="100"
                value="{{ old('survey', $survey->survey) }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Komentar</label>
            <textarea
                name="keterangan"
                id="keterangan"
                class="form-control"
                rows="4"
            >{{ old('keterangan', $survey->keterangan) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('surveys.index') }}" class="btn btn-secondary ms-2">Batal</a>
    </form>
</div>

@endsection

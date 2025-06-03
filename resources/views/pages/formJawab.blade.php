@extends('main-dakwah')

@section('content')
<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Jawab Pertanyaan</h3>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('kyai.pertanyaan.simpan', $pertanyaan->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Penanya</label>
                    <input type="text" class="form-control" value="{{ $pertanyaan->name }}" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pertanyaan</label>
                    <textarea class="form-control" rows="4" disabled>{{ $pertanyaan->pertanyaan }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jawaban</label>
                    <textarea name="jawaban" class="form-control" rows="6" required>{{ old('jawaban', $pertanyaan->jawaban) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Jawaban</button>
                <a href="{{ route('kyai.pertanyaan.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection

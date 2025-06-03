@extends('main-admin')

{{-- @section('content')
<div class="page-inner">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Daftar Pertanyaan</h3>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="table-responsive">
    <table class="table table-bordered table-striped" id="pertanyaanTable">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Pertanyaan</th>
          <th>Jawaban</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pertanyaan as $index => $p)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $p->nama }}</td>
          <td>{{ $p->email }}</td>
          <td>{{ $p->pertanyaan }}</td>
          <td>{{ $p->jawaban ?? '-' }}</td>
          <td>
            @if($p->is_answer)
              <span class="badge bg-success">Dijawab</span>
            @else
              <span class="badge bg-warning text-dark">Belum dijawab</span>
            @endif
          </td>
          <td>
            @if(!$p->is_answer)
            <button 
              class="btn btn-primary btn-sm"
              data-id="{{ $p->id }}"
              data-nama="{{ $p->nama }}"
              data-pertanyaan="{{ $p->pertanyaan }}"
              data-jawaban="{{ $p->jawaban }}"
              onclick="jawabPertanyaan(this)"
              data-bs-toggle="modal"
              data-bs-target="#modalJawab"
            >
              Jawab
            </button>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Jawaban -->
<div class="modal fade" id="modalJawab" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" id="formJawaban">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Jawab Pertanyaan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="jawab-id">
          <div class="mb-3">
            <label>Pertanyaan</label>
            <textarea class="form-control" id="jawab-pertanyaan" readonly></textarea>
          </div>
          <div class="mb-3">
            <label>Jawaban</label>
            <textarea class="form-control" name="jawaban" id="jawab-jawaban" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit">Kirim Jawaban</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection

@push('custom-js')
<script>
  function jawabPertanyaan(button) {
    const data = button.dataset;
    const id = data.id;
    const pertanyaan = data.pertanyaan;
    const jawaban = data.jawaban || '';

    $('#jawab-id').val(id);
    $('#jawab-pertanyaan').val(pertanyaan);
    $('#jawab-jawaban').val(jawaban);
    $('#formJawaban').attr('action', `/admin/pertanyaan/${id}`);
  }

  $(document).ready(function () {
    $('#pertanyaanTable').DataTable();
  });
</script>
@endpush --}}


{{-- @section('content')
<div class="container">
    <h2>Daftar Pertanyaan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Pertanyaan</th>
                <th>Status</th>
                <th>Jawaban</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pertanyaans as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->pertanyaan }}</td>
                <td>
                    @if($item->is_answer)
                        <span class="badge bg-success">Sudah Dijawab</span>
                    @else
                        <span class="badge bg-warning">Belum Dijawab</span>
                    @endif
                </td>
                <td>
                    @if($item->is_answer)
                        {{ $item->jawaban }}
                    @else
                        <form action="{{ route('pertanyaan.jawab', $item->id) }}" method="POST">
                            @csrf
                            <textarea name="jawaban" class="form-control" rows="3" required></textarea>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Kirim Jawaban</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection --}}

@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Daftar Pertanyaan
    </h2>
@endsection

@section('content')
<div class="container">
    <h2>Daftar Pertanyaan</h2>
    <ul>
        @foreach ($pertanyaans as $p)
            <li>
                <strong>{{ $p->name }}</strong>: {{ $p->pertanyaan }} <br>
                <a href="{{ route('kyai.pertanyaan.jawab', $p->id) }}">Jawab</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection


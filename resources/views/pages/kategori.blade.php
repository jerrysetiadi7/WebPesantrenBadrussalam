@extends('main-kategori')  

@section('content')
<div class="page-inner">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Data Kategori</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalkategori" onclick="clearForm()">Tambah Kategori</button>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="table-responsive">
    <table class="table table-bordered table-striped" id="kategoriTable">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Kategori</th>
          <th>tipe Kategori</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($kategori as $index => $k)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $k->nama_kategori }}</td>
          <td>{{ $k->tipe_kategori ?? '-' }}</td>
          <td>
            <button 
              class="btn btn-warning btn-sm"
              onclick="editKategori(this)"
              data-id="{{ $k->id }}"
              data-nama_kategori="{{ $k->nama_kategori }}"
              data-tipe_kategori="{{ $k->tipe_kategori }}"
            >
              Edit
            </button>

            <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" style="display:inline-block">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Form Kategori -->
<div class="modal fade" id="modalkategori" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formkategori" method="POST">
        @csrf
        <input type="hidden" name="_method" id="_method" value="POST">
        <div class="modal-header">
          <h5 class="modal-title">Form Kategori</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body row g-3">
          <input type="hidden" id="form-id">
          <div class="col-md-12">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" id="form-nama_kategori" class="form-control" required>
          </div>
          <div class="col-md-12">
            <label>tipe Kategori (Opsional)</label>
            <input type="text" name="tipe_kategori" id="form-tipe_kategori" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="tipemit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@push('custom-js')
<script>
  function clearForm() {
    $('#formkategori')[0].reset();
    $('#formkategori').attr('action', "{{ route('kategori.store') }}");
    $('#_method').val('POST');
  }

  function editKategori(button) {
    const data = button.dataset;

    $('#formkategori')[0].reset();
    $('#formkategori').attr('action', `/kategori/${data.id}`);
    $('#_method').val('PUT');

    document.getElementById('form-id').value = data.id;
    document.getElementById('form-nama_kategori').value = data.nama_kategori;
    document.getElementById('form-tipe_kategori').value = data.tipe_kategori;

    const modal = new bootstrap.Modal(document.getElementById('modalkategori'));
    modal.show();
  }

  $(document).ready(function () {
    $('#kategoriTable').DataTable();
  });
</script>
@endpush

@extends('main-galeri') 

@section('content')
<div class="page-inner">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Data foto</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalgaleri" onclick="clearForm()">Tambah Foto</button>
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
    <table class="table table-bordered table-striped" id="galeriTable">
      <thead>
        <tr>
          <th>No</th>
          <th>Judul</th>
          <th>Deskripsi</th>
          <th>Foto</th>
          <th>kategori</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($galeri as $index => $p)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $p->judul }}</td>
          <td>{{ $p->deskripsi }}</td>
          <td>
            @if($p->image_url)
             <img src="{{ asset($p->image_url) }}" alt="Foto" width="100">
             @else
              Tidak ada gambar
             @endif
          </td>
          <td>{{ $p->kategori->nama_kategori ?? 'Tidak ada' }}</td>
          <td>
            <button 
              class="btn btn-warning btn-sm"
              onclick="editgaleri(this)"
              data-id="{{ $p->id }}"
              data-judul="{{ $p->judul }}"
              data-deskripsi="{{ $p->deskripsi }}"
              data-image_url="{{ $p->image_url }}"
              data-id_kategori="{{ $p->id_kategori }}"
            >
              Edit
            </button>

            <form action="{{ route('galeri.destroy', $p->id) }}" method="POST" style="display:inline-block">
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

<!-- Modal Form galeri -->
<div class="modal fade" id="modalgaleri" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="formgaleri" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" id="_method" value="POST">
        <div class="modal-header">
          <h5 class="modal-title">Form Galeri</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body row g-3">
          <input type="hidden" id="form-id">
          <div class="col-md-6">
            <label>Judul</label>
            <input type="text" name="judul" id="form-judul" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Deskripsi</label>
            <input type="text" name="deskripsi" id="form-deskripsi" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Foto</label>
            <input type="file" name="image_url" id="form-image_url" class="form-control" accept="image/*">
            <small id="current-image" class="text-muted mt-1"></small>
          </div>
          <div class="col-md-6">
            <label>Kategori</label>
            <select name="id_kategori" class="form-control" required>
              <option value="">-- Pilih Kategori --</option>
              @foreach($kategori as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
              @endforeach
            </select>
          </div> 
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        {{-- <form id="form-kategori" method="POST" action="{{ route('kategori.update', $kategori->id) }}">
          @csrf
          @method('PUT')
      </form>        --}}
      </form>
    </div>
  </div>
</div>

@endsection

@push('custom-js')
<script>
 

  function clearForm() {
    $('#formgaleri')[0].reset();
    $('#formgaleri').attr('action', "{{ route('galeri.store') }}");
    $('#_method').val('POST');
    $('#current-image').html('');
  }

  function editgaleri(button) {
    const data = button.dataset;

    $('#formgaleri')[0].reset();
    $('#formgaleri').attr('action', `/galeri-pesantren/${data.id}`);
    $('#_method').val('PUT');

    document.getElementById('form-id').value = data.id;
    document.getElementById('form-judul').value = data.judul;
    document.getElementById('form-deskripsi').value = data.deskripsi;
    document.getElementById('form-image_url').value = "";
    // document.querySelector('select[name="id_kategori"]').value = data.id_kategori;
    document.querySelector('select[name="id_kategori"]').value = data.id_kategori || "";


    if (data.image_url) {
      const imagePath = "{{ asset('storage/galeri') }}/" + data.image_url;
      document.getElementById('current-image').innerHTML = `Gambar saat ini: <br>
      <img src="/storage/${data.image_url}" width="100" class="mt-1">
      <source src="${imagePath}" type="jpeg,png,jpg,gif,svg">
      Browser Anda tidak mendukung tag video.
    </video>`;
  }
    //else {
    //document.getElementById('current-image').innerHTML = '';
  //}

    const modal = new bootstrap.Modal(document.getElementById('modalgaleri'));
    modal.show();
   

  }

  $(document).ready(function () {
    $('#galeriTable').DataTable();
   
  });
</script>
@endpush

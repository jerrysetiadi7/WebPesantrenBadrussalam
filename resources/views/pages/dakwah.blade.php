@extends('main-dakwah') 

@section('content')
<div class="page-inner">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Data dakwah</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaldakwah" onclick="clearForm()">Tambah video</button>
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
    <table class="table table-bordered table-striped" id="dakwahTable">
      <thead>
        <tr>
          <th>No</th>
          <th>judul</th>
          <th>isi</th>
          <th>video</th>
          <th>kategori</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($dakwah as $index => $p)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $p->judul }}</td>
          <td>{{ $p->isi }}</td>
          <td>
            @if($p->video_url)
            <video width="200" controls>
            <source src="{{ asset('storage/dakwah/' . $p->video_url) }}" type="video/mp4">
                Browser Anda tidak mendukung tag video.
            </video>
            @else
            Tidak ada video
            @endif
          </td>
          <td>{{ $p->kategori->nama_kategori ?? 'Tidak ada' }}</td>
          <td>
            <button 
              class="btn btn-warning btn-sm"
              onclick="editdakwah(this)"
              data-id="{{ $p->id }}"
              data-judul="{{ $p->judul }}"
              data-isi="{{ $p->isi }}"
              data-video_url="{{ $p->video_url }}"
              data-id_kategori="{{ $p->id_kategori }}"
            >
              Edit
            </button>

            <form action="{{ route('dakwah.destroy', $p->id) }}" method="POST" style="display:inline-block">
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

<!-- Modal Form dakwah -->
<div class="modal fade" id="modaldakwah" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="formdakwah" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" id="_method" value="POST">
        <div class="modal-header">
          <h5 class="modal-title">Form dakwah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body row g-3">
          <input type="hidden" id="form-id">
          <div class="col-md-6">
            <label>Judul</label>
            <input type="text" name="judul" id="form-judul" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Isi</label>
            <textarea name="isi" id="form-isi" class="form-control" required></textarea>
            </div>
          <div class="col-md-6">
            <label>Upload Video (mp4, max 1GB)</label>
                <input type="file" name="video_url" id="form-video_url" class="form-control" accept="video/mp4">
                <small id="current-video" class="text-muted mt-1"></small>
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
      </form>
    </div>
  </div>
</div>

@endsection

@push('custom-js')
<script>
  function clearForm() {
    $('#formdakwah')[0].reset();
    $('#formdakwah').attr('action', "{{ route('dakwah.store') }}");
    $('#_method').val('POST');
    $('#current-video').html('');
  }

  function editdakwah(button) {
    const data = button.dataset;

    $('#formdakwah')[0].reset();
    $('#formdakwah').attr('action', `/dakwah-pesantren/${data.id}`);
    $('#_method').val('PUT');

    document.getElementById('form-id').value = data.id;
    document.getElementById('form-judul').value = data.judul;
    document.getElementById('form-isi').value = data.isi;
    document.getElementById('form-video_url').value = "";
    document.querySelector('select[name="id_kategori"]').value = data.id_kategori || "";

if (data.video_url) {
  const videoPath = "{{ asset('storage/dakwah') }}/" + data.video_url;
  document.getElementById('current-video').innerHTML = `Video saat ini:<br>
    <video width="200" controls class="mt-1">
      <source src="${videoPath}" type="video/mp4">
      Browser Anda tidak mendukung tag video.
    </video>`;
}


    const modal = new bootstrap.Modal(document.getElementById('modaldakwah'));
    modal.show();
  }

  $(document).ready(function () {
    $('#dakwahTable').DataTable();
  });
</script>
@endpush

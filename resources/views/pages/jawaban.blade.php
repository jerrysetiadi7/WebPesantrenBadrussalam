{{-- <h2>Pertanyaan dari {{ $question->name }}</h2>
<p>{{ $question->question }}</p>

@if($question->answer)
    <h4>Jawaban Anda:</h4>
    <p>{{ $question->answer->answer }}</p>
@else
    <form method="POST" action="{{ route('kyai.questions.answer', $question->id) }}">
        @csrf
        <textarea name="answer" rows="5" cols="50" required></textarea><br>
        <button type="submit">Kirim Jawaban</button>
    </form>
@endif

<a href="{{ route('kyai.questions.index') }}">⬅ Kembali ke daftar</a> --}}
{{-- @extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Jawab Pertanyaan
    </h2>
@endsection

@section('content')
<div class="container">
    <h2>Jawab Pertanyaan dari {{ $pertanyaan->name }}</h2>

    <p><strong>Pertanyaan:</strong> {{ $pertanyaan->pertanyaan }}</p>

    <form method="POST" action="{{ route('kyai.pertanyaan.simpan', $pertanyaan->id) }}">
        @csrf
        <div class="form-group">
            <label for="jawaban">Jawaban:</label>
            <textarea name="jawaban" id="jawaban" class="form-control" rows="5">{{ old('jawaban') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
    </form>
</div>
@endsection
 --}}




 @extends('main-dakwah')

 @section('content')
 <div class="page-inner">
   <div class="d-flex justify-content-between align-items-center mb-4">
     <h3 class="fw-bold">Jawaban Pertanyaan</h3>
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
     <table class="table table-bordered table-striped" id="jawabanTable">
       <thead>
         <tr>
           <th>No</th>
           <th>Nama Penanya</th>
           <th>Pertanyaan</th>
           <th>Jawaban</th>
           <th>Action</th>
         </tr>
       </thead>
       <tbody>
         {{-- @foreach($pertanyaans as $index => $p)
         <tr>
           <td>{{ $index + 1 }}</td>
           <td>{{ $p->name }}</td>
           <td>{{ $p->pertanyaan }}</td>
           <td>{!! $p->jawaban ?? '<span class="text-muted">Belum dijawab</span>' !!}</td>
           <td>
             <button 
               class="btn btn-primary btn-sm"
               onclick="editJawaban(this)"
               data-id="{{ $p->id }}"
               data-name="{{ $p->name }}"
               data-pertanyaan="{{ $p->pertanyaan }}"
               data-jawaban="{{ $p->jawaban }}"
             >
               Jawab
             </button>
           </td>
         </tr>
         @endforeach --}}

         @foreach($pertanyaans as $index => $p)
<tr>
    <td>{{ $index + 1 }}</td>
    <td>{{ $p->name }}</td>
    <td>{{ $p->pertanyaan }}</td>
    <td>{!! $p->jawaban ?? '<span class="text-muted">Belum dijawab</span>' !!}</td>
    <td>
        <a href="{{ route('kyai.pertanyaan.jawab', $p->id) }}" class="btn btn-sm btn-primary">Jawab</a>
    </td>
</tr>
@endforeach
       </tbody>
     </table>
   </div>
 </div>
 
 <!-- Modal Jawaban -->
 <div class="modal fade" id="modalJawaban" tabindex="-1">
   <div class="modal-dialog">
     <div class="modal-content">
       <form id="formJawaban" method="POST">
         @csrf
         <input type="hidden" name="_method" id="jawaban-method" value="POST">
         <div class="modal-header">
           <h5 class="modal-title">Form Jawaban</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
         </div>
         <div class="modal-body">
           <input type="hidden" id="jawaban-id">
 
           <div class="mb-3">
             <label class="form-label">Nama Penanya</label>
             <input type="text" class="form-control" id="jawaban-name" disabled>
           </div>
 
           <div class="mb-3">
             <label class="form-label">Pertanyaan</label>
             <textarea class="form-control" id="jawaban-pertanyaan" rows="3" disabled></textarea>
           </div>
 
           <div class="mb-3">
             <label class="form-label">Jawaban</label>
             <textarea name="jawaban" id="jawaban-text" class="form-control" rows="4" required></textarea>
           </div>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary">Simpan Jawaban</button>
         </div>
       </form>
     </div>
   </div>
 </div>
 @endsection
 
 @push('custom-js')
 <script>
   function editJawaban(button) {
     const data = button.dataset;
     
     $('#formJawaban')[0].reset();
     $('#formJawaban').attr('action', `/jawaban/${data.id}`);
     $('#jawaban-method').val('PUT');
 
     document.getElementById('jawaban-id').value = data.id;
     document.getElementById('jawaban-name').value = data.name;
     document.getElementById('jawaban-pertanyaan').value = data.pertanyaan;
     document.getElementById('jawaban-text').value = data.jawaban || "";
 
     const modal = new bootstrap.Modal(document.getElementById('modalJawaban'));
     modal.show();
   }
 
   $(document).ready(function () {
     $('#jawabanTable').DataTable();
   });
 </script>
 @endpush
 
<h2>Daftar Pertanyaan</h2>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<ul>
@foreach($questions as $q)
    <li>
        <strong>{{ $q->name }}</strong> — {{ Str::limit($q->question, 50) }}
        @if($q->answer)
            ✅ Sudah dijawab
        @else
            ❌ Belum dijawab
        @endif
        <a href="{{ route('kyai.questions.show', $q->id) }}">Lihat</a>
    </li>
@endforeach
</ul>

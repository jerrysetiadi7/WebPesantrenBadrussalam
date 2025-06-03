<!DOCTYPE html>
<html>
<head>
    <title>Tanya Kyai</title>
</head>
<body>
    <h1>Tanya Kyai</h1>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('pertanyaan.store') }}">
        @csrf
        <div>
            <label>Nama Anda:</label><br>
            <input type="text" name="name" required>
        </div>

        <div>
            <label>Pertanyaan:</label><br>
            <textarea name="pertanyaan" rows="5" cols="40" required></textarea>
        </div>

        <div>
            <button type="submit">Kirim Pertanyaan</button>
        </div>
    </form>
</body>
</html>

<?php

namespace App\Http\Controllers;
use App\Models\dakwahModel as dakwah;
use App\Models\kategoriModel as kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class dakwahController extends Controller
{
      public function index()
    {
        $kategori = Kategori::all();
        $kategoriId = request('kategori');
$dakwah = dakwah::when($kategoriId, function ($query, $kategoriId) {
    return $query->where('id_kategori', $kategoriId);
})->get();
        return view('pages.dakwah', compact('dakwah','kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'video_url' => 'required|file|mimes:mp4,avi,mov,mkv|max:100000',
            'id_kategori' => 'required|exists:kategori,id'
        ]);

        // Simpan file ke storage/public/dakwah
        if ($request->hasFile('video_url')) {
    $file = $request->file('video_url');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->storeAs('public/dakwah', $filename);
}

Dakwah::create([
    'judul' => $request->judul,
    'isi' => $request->isi,
    'id_kategori' => $request->id_kategori,
]);

        return redirect()->route('dakwah')->with('success', 'video berhasil ditambahkan.');

    }

    public function update(Request $request, $id)
    {
        $dakwah = dakwah::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'video_url' => 'nullable|file|mimes:mp4,avi,mov,mkv|max:100000',
            'id_kategori' => 'required|exists:kategori,id'
        ]);

        // Jika ada gambar baru diupload
       if ($request->hasFile('video_url')) {
    $file = $request->file('video_url');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->storeAs('public/dakwah', $filename);
    $dakwah->video_url = $filename;
}

$dakwah->judul = $request->judul;
$dakwah->isi = $request->isi;
$dakwah->id_kategori = $validated['id_kategori'];
$dakwah->save();


        return redirect()->route('dakwah')->with('success', 'video berhasil diperbaharui.');
    }

    public function destroy($id)
    {
        $dakwah = dakwah::findOrFail($id);

        // Hapus file dari storage jika ada
        if ($dakwah->video_url) {
    $path = str_replace('storage/', '', $dakwah->video_url);
    Storage::disk('public')->delete($path);
}

        $dakwah->delete();
        return redirect()->route('dakwah')->with('success', 'video berhasil dihapus.');
    }
}

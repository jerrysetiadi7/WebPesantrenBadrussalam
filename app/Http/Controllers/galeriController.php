<?php
namespace App\Http\Controllers;

use App\Models\galeriModel as galeri;
use App\Models\kategoriModel as kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class galeriController extends Controller
{
    public function index()
    {
        
        $kategori = Kategori::all();
        $kategoriId = request('kategori');
$galeri = galeri::when($kategoriId, function ($query, $kategoriId) {
    return $query->where('id_kategori', $kategoriId);
})->get();
        return view('pages.geleri', compact('galeri','kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'id_kategori' => 'required|exists:kategori,id',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000'
            
        ]);
        // if ($request->hasFile('image_url')) {
        //     $galeri = $request->file('image_url');
        //     $path = $galeri->store('galeri', 'public');
        //     $validated['image_url'] = $path;
        // }
        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/galeri', $filename);
    
        Galeri::create($validated);
    
        return redirect()->route('galeri')->with('success', 'Data berhasil ditambahkan.');
    
        // Simpan file ke storage/public/galeri
        // $path = $request->file('image_url')->store('galeri', 'public');

        // Simpan ke database
        // galeri::create([
        //     'judul' => $validated['judul'],
        //     'deskripsi' => $validated['deskripsi'],
        //     'id_kategori' => $request->id_kategori,
        // ]);

        // return redirect()->route('galeri')->with('success', 'Foto berhasil ditambahkan.');

    }}

    public function update(Request $request, $id)
    {
        $galeri = galeri::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'id_kategori' => 'required|exists:kategori,id',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ]);

        // Jika ada gambar baru diupload
        if ($request->hasFile('image_url')) {
            // Hapus file lama jika ada
            if ($galeri->image_url && file_exists(public_path($galeri->image_url))) {
                unlink(public_path($galeri->image_url));
            }

            $path = $request->file('image_url')->store('galeri', 'public');
            $galeri->image_url = 'storage/' . $path;
        }

        $galeri->judul = $validated['judul'];
        $galeri->deskripsi = $validated['deskripsi'];
        $galeri->id_kategori = $validated['id_kategori'];
        $galeri->save();

        return redirect()->route('galeri')->with('success', 'Foto berhasil diperbaharui.');
    }

    public function destroy($id)
    {
        $galeri = galeri::findOrFail($id);

        // Hapus file dari storage jika ada
        if ($galeri->image_url && file_exists(public_path($galeri->image_url))) {
            unlink(public_path($galeri->image_url));
        }

        $galeri->delete();
        return redirect()->route('galeri')->with('success', 'Foto berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\kategoriModel as kategori;
use Illuminate\Http\Request;

class kategoriController extends Controller
{
    public function index()
{
    $kategori = Kategori::all();
    return view('pages.kategori', compact('kategori'));
}

public function store(Request $request)
{
    $request->validate([
        'nama_kategori' => 'required|string|max:255',
        'sub_kategori' => 'nullable|string|max:255',
    ]);

    Kategori::create($request->all());

    return back()->with('success', 'Kategori berhasil ditambahkan');
}
public function update (Request $request, $id)
{
    $kategori = kategori::findOrFail($id);
    $validated = $request->validate([
       'nama_kategori' => 'required|string|max:255',
        'sub_kategori' => 'nullable|string|max:255',
        
    ]);
    $kategori->update($validated);
    return redirect()->route('kategori')->with('sukses','berhasil diperbaharui');
}
public function destroy ($id)
{
    kategori::destroy($id);
    return redirect()->route('kategori')->with('sukses di hapus');

}
}

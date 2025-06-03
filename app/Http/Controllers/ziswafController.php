<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ziswafModel as ziswaf;
use Illuminate\Support\Facades\Storage;

class ZiswafController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string',
            'jumlah' => 'required|integer',
            'metode' => 'required|string',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $buktiPath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

        ziswaf::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'metode' => $request->metode,
            'status' => 'Menunggu Verifikasi',
            'bukti_transfer' => $buktiPath,
        ]);

        return back()->with('success', 'Terima kasih! Form ZISWAF berhasil dikirim.');
    }

    public function index()
    {
        $data = Ziswaf::orderBy('created_at', 'desc')->get();
        return view('admin.ziswaf.index', compact('data'));
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu Verifikasi,Terverifikasi,Ditolak',
        ]);

        $ziswaf = Ziswaf::findOrFail($id);
        $ziswaf->update(['status' => $request->status]);

        return back()->with('success', 'Status berhasil diperbarui.');
    }
}


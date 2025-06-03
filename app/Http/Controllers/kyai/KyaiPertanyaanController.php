<?php

namespace App\Http\Controllers\Kyai;

use App\Http\Controllers\Controller;
use App\Models\pertanyaanModel as pertanyaan;
use App\Models\jawabanModel as jawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KyaiPertanyaanController extends Controller
{
    public function index()
    {
        $pertanyaans = pertanyaan::all();
        return view('pages.jawaban', compact('pertanyaans'));
    }
    
    public function jawab($id)
    {
        $pertanyaan = pertanyaan::findOrFail($id);
        return view('pages.formJawab', compact('pertanyaan'));
    }

    public function simpanJawaban(Request $request, $id)
    {
        $request->validate([
            'jawaban' => 'required|string',
        ]);

        $pertanyaan = pertanyaan::findOrFail($id);
        $pertanyaan->jawaban = $request->jawaban;
        $pertanyaan->status = 'answered';
        $pertanyaan->save();

        // jawaban::create([
        //     'pertanyaan_id' => $pertanyaan->id,
        //     'jawaban' => $request->jawaban,
        // ]);
        
        // $pertanyaan->status = 'answered';
        // $pertanyaan->save();

        return redirect()->route('kyai.pertanyaan.index')->with('success', 'Jawaban berhasil disimpan.');
    }
}
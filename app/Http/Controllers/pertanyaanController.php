<?php

namespace App\Http\Controllers;
use App\Models\pertanyaanModel as pertanyaan;



use Illuminate\Http\Request;

class pertanyaanController extends Controller
{
    public function create()
    {
        return view('pages.pertanyaanUser');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'pertanyaan' => 'required|string',
        ]);

        pertanyaan::create([
            'name' => $request->name,
            'pertanyaan' => $request->pertanyaan,
        ]);

        return redirect()->route('pertanyaan.create')->with('success', 'Pertanyaan Anda telah dikirim!');
    }
}
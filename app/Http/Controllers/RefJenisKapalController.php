<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use App\Models\RefJenisKapal;
use Illuminate\Http\Request;

class RefJenisKapalController extends Controller
{
    public function editBiaya()
    {
        $jenisKapal = RefJenisKapal::all();
        return view('fitur.ubah-format-retribusi', compact('jenisKapal'));
    }

    // Mengupdate biaya retribusi kapal
    public function updateBiaya(Request $request)
    {
        // Validasi input
        $request->validate([
            'id' => 'required|exists:ref_jenis_kapal,id',
            'jenis_kapal' => 'required|string|max:255',
            'biaya_retribusi' => 'required|numeric|min:0'
        ]);

        $kapal = RefJenisKapal::findOrFail($request->id);

        $kapal->jenis_kapal = $request->jenis_kapal;
        $kapal->biaya_retribusi = $request->biaya_retribusi;
        $kapal->save();

        return response()->json(['success' => 'Data kapal berhasil diperbarui!']);
    }



    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'jenis_kapal' => 'required|string|max:255',
            'biaya_retribusi' => 'required|numeric',
        ]);

        // Simpan data baru
        RefJenisKapal::create([
            'jenis_kapal' => $request->jenis_kapal,
            'biaya_retribusi' => $request->biaya_retribusi,
        ]);

        return response()->json(['success' => 'Data kapal berhasil ditambahkan']);
    }

    public function update(Request $request)
    {
        $kapal = RefJenisKapal::findOrFail($request->id);
        $kapal->jenis_kapal = $request->jenis_kapal;
        $kapal->biaya_retribusi = $request->biaya_retribusi;
        $kapal->save();

        return response()->json(['success' => 'Data berhasil diubah']);
    }
}

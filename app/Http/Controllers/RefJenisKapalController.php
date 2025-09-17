<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use App\Models\RefJenisKapal;
use Illuminate\Http\Request;

class RefJenisKapalController extends Controller
{
    public function index()
    {
        $jenisKapal = RefJenisKapal::all();
        return view('fitur.ubah-format-retribusi', compact('jenisKapal'));
    }

    public function destroy($id)
    {
        $jenisKapal = RefJenisKapal::findOrFail($id);

        if ($jenisKapal->jenisKapal()->count() > 0) {
            return redirect()->route('jenis-kapal.index')->with('error', 'Gagal menghapus! Jenis kapal ini sedang digunakan oleh Wajib Retribusi.');
        }

        $jenisKapal->delete();

        return redirect()->route('jenis-kapal.index')->with('success', 'Data berhasil dihapus.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kapal' => 'required|string|max:255',
            'biaya_retribusi' => 'required|numeric',
        ]);

        RefJenisKapal::create([
            'jenis_kapal' => $request->jenis_kapal,
            'biaya_retribusi' => $request->biaya_retribusi,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_kapal' => 'required|string|max:255',
            'biaya_retribusi' => 'required|numeric',
        ]);

        $data = RefJenisKapal::findOrFail($id);

        $data->update([
            'jenis_kapal' => $request->jenis_kapal,
            'biaya_retribusi' => $request->biaya_retribusi,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }
}

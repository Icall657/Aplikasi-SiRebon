<?php

namespace App\Http\Controllers;

use App\Models\RefBank;
use App\Models\MsRekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    public function index()
    {
        $rekening = MsRekening::all();
        return view('fitur.rekeningpembayaran', compact('rekening'));
    }

    public function create()
    {
        $refBanks = RefBank::all();
        return view('fitur.Rekening.create', compact('refBanks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ref_bank' => 'required|exists:ref_bank,id',
            'nama_akun' => 'required|string|max:50',
            'no_rekening' => 'required|string|max:50',
        ]);

        MsRekening::create($request->all());

        return redirect()->route('rekening.index')->with('success', 'Data rekening berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $data = MsRekening::findOrFail($id);
        $data->delete();

        return redirect()->route('rekening.index')->with('success', 'Data berhasil dihapus.');
    }

    public function edit($id)
    {
        // Temukan data rekening berdasarkan ID
        $data = MsRekening::findOrFail($id);

        // Ambil daftar bank dari tabel ref_bank untuk dropdown (jika diperlukan)
        $refBanks = RefBank::all();

        // Kirim data rekening yang ingin diedit dan daftar bank ke view
        return view('fitur.Rekening.edit', compact('data', 'refBanks'));
    }

    public function update(Request $request, $id)
    {
        $data = MsRekening::findOrFail($id);

        // Validasi input
        $request->validate([
            'id_ref_bank' => 'required|exists:ref_bank,id',
            'nama_akun' => 'required|string|max:50',
            'no_rekening' => 'required|string|max:50',
        ]);

        // Update data
        $data->update([
            'id_ref_bank' => $request->id_ref_bank,
            'nama_akun' => $request->nama_akun,
            'no_rekening' => $request->no_rekening,
        ]);

        return redirect()->route('rekening.index')->with('success', 'Data rekening berhasil diperbarui.');
    }
}

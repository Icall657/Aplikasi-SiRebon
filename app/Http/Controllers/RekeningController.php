<?php

namespace App\Http\Controllers;

use App\Models\RefBank;
use App\Models\MsRekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    public function index()
    {
        // ambil semua data rekening yang terkait dengan wajib retribusi yang masih aktif
        $rekening = MsRekening::whereHas('user.wajibRetribusi', function ($query) {
            $query->where('status', '!=', 'B');
        })->get();

        return view('fitur.rekeningpembayaran', compact('rekening'));
    }


    public function create()
    {
        // ambil daftar bank buat dropdown
        $refBanks = RefBank::all();
        return view('fitur.Rekening.create', compact('refBanks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ref_bank' => 'required|exists:ref_bank,id',
            'nama_akun' => 'required|string|max:50',
            'no_rekening' => 'required|string|digits:12|max:50|unique:ms_rekening,no_rekening',
        ], [
            'nama_akun.unique' => 'Nama akun sudah terdaftar. Silakan pilih nama akun lain.',
            'no_rekening.digits' => 'Nomor rekening harus terdiri dari 12 digit.',
            'no_rekening.unique' => 'Nomor rekening sudah terdaftar. Silakan pilih nomor rekening lain.',
        ]);

        MsRekening::create(attributes: $request->all());

        return redirect()->route('rekening.index')->with('success', 'Data rekening berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        // cari data rekening berdasarkan id
        $data = MsRekening::findOrFail($id);

        // hapus data rekening
        $data->delete();

        // balik ke halaman rekening dengan pesan sukses
        return redirect()->route('rekening.index')->with('success', 'Data berhasil dihapus.');
    }

    public function edit($id)
    {
        // temukan data rekening berdasarkan id
        $data = MsRekening::findOrFail($id);

        // ambil daftar bank dari tabel ref_bank buat dropdown
        $refBanks = RefBank::all();

        // kirim data rekening yang ingin diedit dan daftar bank ke view
        return view('fitur.Rekening.edit', compact('data', 'refBanks'));
    }

    public function update(Request $request, $id)
    {
        // cari data rekening berdasarkan id
        $data = MsRekening::findOrFail($id);

        // validasi input sebelum update
        $request->validate([
            'id_ref_bank' => 'required|exists:ref_bank,id',
            'nama_akun' => 'required|string|max:50',
            'no_rekening' => 'required|string|max:50',
        ]);

        // update data rekening
        $data->update([
            'id_ref_bank' => $request->id_ref_bank,
            'nama_akun' => $request->nama_akun,
            'no_rekening' => $request->no_rekening,
        ]);

        // balik ke halaman rekening dengan pesan sukses
        return redirect()->route('rekening.index')->with('success', 'Data rekening berhasil diperbarui.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WajibRetribusi;

class WajibController extends Controller
{
    public function index()
    {
        $wajibRetribusi = WajibRetribusi::whereHas('user', function ($query) {
            $query->where('level', 'Wajib Retribusi');
        })->get();
        return view('fitur.wajibretribusi', compact('wajibRetribusi')); // Mengirim data ke view
    }


    public function edit($id)
    {
        $wajib = WajibRetribusi::findOrFail($id);
        return view('fitur.Wajib-Retribusi.edit', compact('wajib')); // Menampilkan halaman edit
    }

    public function update(Request $request, $id)
    {
        $wajib = WajibRetribusi::findOrFail($id);
        $wajib->update($request->all()); // Menyimpan data yang telah diperbarui
        return redirect()->route('wajib-retribusi.index')->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        $wajib = WajibRetribusi::findOrFail($id);
        $wajib->delete(); // Menghapus data
        return response()->json(['message' => 'Data berhasil dihapus']);
    }

    public function create()
    {
        return view('fitur.Wajib-Retribusi.create');
    }

    // Menyimpan data Wajib Retribusi yang baru
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'nik' => 'required|string|max:16',
            'alamat' => 'required|string',
            'kelurahan' => 'required|string|max:255',
        ]);

        // Menyimpan data ke database
        WajibRetribusi::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'kelurahan' => $request->kelurahan,
            'id_user' => auth()->user()->id,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('wajib-retribusi.index')->with('success', 'Data berhasil ditambahkan.');
    }
}

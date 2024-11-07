<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriRetribusi;

class KategoriController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel kategori_retribusi
        $kategoris = KategoriRetribusi::all();

        // Mengirim data ke view
        return view('fitur.kategoriretribusi', compact('kategoris'));
    }

    public function create()
    {
        return view('fitur.Kategori.create');  // pastikan view ini berada di resources/views/kategori-retribusi/create.blade.php
    }

    // Menyimpan data kategori retribusi yang baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        // Simpan data kategori ke dalam tabel
        KategoriRetribusi::create([
            'kategori' => $request->kategori,
        ]);

        // Redirect ke halaman kategori retribusi dengan pesan sukses
        return redirect()->route('kategori-retribusi.index')->with('success', 'Kategori Retribusi berhasil ditambahkan.');
    }

    public function edit($id)
    {

        $kategori = KategoriRetribusi::findOrFail($id);

        return view('fitur.Kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);


        $kategori = KategoriRetribusi::findOrFail($id);
        $kategori->update([
            'kategori' => $request->input('kategori'),
        ]);


        return redirect()->route('kategori-retribusi.index')->with('success', 'Data kategori berhasil diubah.');
    }

    public function destroy($id)
    {
        // Mencari data kategori berdasarkan ID
        $kategori = KategoriRetribusi::findOrFail($id);

        // Menghapus data kategori
        $kategori->delete();

        // Redirect ke halaman kategori dengan pesan sukses
        return redirect()->route('kategori-retribusi.index')->with('success', 'Data kategori berhasil dihapus.');
    }
}

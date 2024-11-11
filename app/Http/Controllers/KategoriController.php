<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriRetribusi;

class KategoriController extends Controller
{
    public function index()
    {
        // ambil semua data dari tabel kategori_retribusi
        $kategoris = KategoriRetribusi::all();

        // kirim data ke view
        return view('fitur.kategoriretribusi', compact('kategoris'));
    }

    public function create()
    {
        // buka halaman buat kategori baru
        return view('fitur.Kategori.create');
    }

    public function store(Request $request)
    {
        // validasi input kategori biar sesuai aturan
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        // simpan data kategori baru ke database
        KategoriRetribusi::create([
            'kategori' => $request->kategori,
        ]);

        // balik ke halaman kategori dengan pesan sukses
        return redirect()->route('kategori-retribusi.index')->with('success', 'Kategori Retribusi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // ambil data kategori berdasarkan id buat diedit
        $kategori = KategoriRetribusi::findOrFail($id);

        // kirim data kategori ke view edit
        return view('fitur.Kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        // validasi input kategori sebelum update
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        // cari data kategori sesuai id dan update
        $kategori = KategoriRetribusi::findOrFail($id);
        $kategori->update([
            'kategori' => $request->input('kategori'),
        ]);

        // balik ke halaman kategori dengan pesan sukses
        return redirect()->route('kategori-retribusi.index')->with('success', 'Data kategori berhasil diubah.');
    }

    public function destroy($id)
    {
        // cari data kategori sesuai id
        $kategori = KategoriRetribusi::findOrFail($id);

        // hapus data kategori
        $kategori->delete();

        // balik ke halaman kategori dengan pesan sukses
        return redirect()->route('kategori-retribusi.index')->with('success', 'Data kategori berhasil dihapus.');
    }
}

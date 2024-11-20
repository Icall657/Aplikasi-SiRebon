<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriRetribusi;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = KategoriRetribusi::all();

        return view('fitur.kategoriretribusi', compact('kategoris'));
    }

    public function create()
    {
        return view('fitur.Kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255|unique:kategori_retribusi,kategori',
        ], [
            'kategori.unique' => 'Nama kategori sudah ada, silakan gunakan nama lain.',
        ]);


        KategoriRetribusi::create([
            'kategori' => $request->kategori,
        ]);

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
            'kategori' => "required|string|max:255|unique:kategori_retribusi,kategori,{$id}",
        ], [
            'kategori.unique' => 'Nama kategori sudah ada, silakan gunakan nama lain.',
        ]);
        

        $kategori = KategoriRetribusi::findOrFail($id);
        $kategori->update([
            'kategori' => $request->input('kategori'),
        ]);

        return redirect()->route('kategori-retribusi.index')->with('success', 'Data kategori berhasil diubah.');
    }


    public function destroy($id)
    {
        $kategori = KategoriRetribusi::findOrFail($id);

        $kategori->delete();

        return redirect()->route('kategori-retribusi.index')->with('success', 'Data kategori berhasil dihapus.');
    }
}

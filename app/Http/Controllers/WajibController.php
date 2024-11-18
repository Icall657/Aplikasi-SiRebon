<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use App\Models\WajibRetribusi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class WajibController extends Controller
{
    public function index()
    {
        // ambil data wajib retribusi yang punya user dengan level 'Wajib Retribusi'
        $wajibRetribusi = WajibRetribusi::whereHas('user', function ($query) {
            $query->where('level', 'Wajib Retribusi');
        })->get();
        return view('fitur.wajibretribusi', compact('wajibRetribusi')); // kirim data ke view
    }

    public function edit($id)
    {
        // cari data wajib_retribusi berdasarkan id
        $wajib = WajibRetribusi::findOrFail($id);
        $kelurahans = Kelurahan::all();
        return view('fitur.Wajib-Retribusi.edit', compact('wajib','kelurahans')); // tampilkan halaman edit
    }

    public function update(Request $request, $id)
    {
        // cari data wajib_retribusi berdasarkan id
        $wajib = WajibRetribusi::findOrFail($id);
        $wajib->update($request->all()); // update data yang diubah
        return redirect()->route('wajib-retribusi.index')->with('success', 'Data udah berhasil diubah.');
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $wajib = WajibRetribusi::findOrFail($id);
            $wajib->delete();

            DB::commit();

            return redirect()->route('wajib-retribusi.index')->with('success', 'Data udah kebuang, bro.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('wajib-retribusi.index')->with('error', 'Eh, ada error waktu ngehapus datanya.');
        }
    }

    public function create()
    {
        $kelurahans = Kelurahan::all();
        return view('fitur.Wajib-Retribusi.create', compact('kelurahans'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'nama' => 'required|string|max:255',
        'no_hp' => 'required|string|max:15|regex:/^[0-9]+$/',
        'nik' => 'required|string|regex:/^[0-9]+$/',
        'alamat' => 'required|string|max:255',
        'id_kelurahan' => 'required|exists:kelurahan,id',
        'status' => 'required|in:A,B',
    ]);

    WajibRetribusi::create([
        'id_user' => auth()->id(),
        'nama' => $request->nama,
        'no_hp' => $request->no_hp,
        'nik' => $request->nik,
        'alamat' => $request->alamat,
        'id_kelurahan' => $request->id_kelurahan,
        'status' => $request->status,
    ]);

    return redirect()->route('wajib-retribusi.index')->with('success', 'Data berhasil ditambahkan.');
    }    
}

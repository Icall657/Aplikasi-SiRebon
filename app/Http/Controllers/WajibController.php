<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WajibRetribusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
        return view('fitur.Wajib-Retribusi.edit', compact('wajib')); // tampilkan halaman edit
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
            // cari data wajib_retribusi berdasarkan id
            $wajib = WajibRetribusi::findOrFail($id);
            $user = $wajib->user; // cari user yang terhubung
            $wajib->delete(); // hapus data wajib_retribusi
            if ($user) {
                $user->delete(); // hapus juga usernya
            }

            DB::commit();

            return redirect()->route('wajib-retribusi.index')->with('success', 'Data udah kebuang, bro.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('wajib-retribusi.index')->with('error', 'Eh, ada error waktu ngehapus datanya.');
        }
    }

    public function create()
    {
        return view('fitur.Wajib-Retribusi.create'); // tampilin form buat tambah data
    }

    public function store(Request $request)
    {
        Log::info('Data yang dimasukin:', $request->all());

        // validasi inputan, biar ga salah
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'nik' => 'required|string|max:16',
            'alamat' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            // bikin user baru
            $user = User::create([
                'username' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'level' => 'Wajib Retribusi',
            ]);

            // bikin data wajib_retribusi yang nyambung ke user baru
            WajibRetribusi::create([
                'id_user' => $user->id,
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'kelurahan' => $request->kelurahan,
            ]);

            DB::commit();

            Log::info('Data udah ke-save dengan baik.');

            return redirect()->route('wajib-retribusi.index')->with('success', 'Data berhasil dimasukin, bro!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error pas nyimpen data:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Aduh, ada masalah pas nambahin data.');
        }
    }
}

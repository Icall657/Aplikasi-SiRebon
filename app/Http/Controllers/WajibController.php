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
        DB::beginTransaction();
        try {
            $wajib = WajibRetribusi::findOrFail($id);
            $user = $wajib->user;
            $wajib->delete();
            if ($user) {
                $user->delete();
            }

            DB::commit();

            return redirect()->route('wajib-retribusi.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('wajib-retribusi.index')->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }


    public function create()
    {
        return view('fitur.Wajib-Retribusi.create');
    }

    // Menyimpan data Wajib Retribusi yang baru
    public function store(Request $request)
    {
        Log::info('Data input:', $request->all());

        $request->validate([
            'username' => 'required|string|max:255|unique:users',
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
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'level' => 'Wajib Retribusi',
            ]);

            WajibRetribusi::create([
                'id_user' => $user->id,
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'kelurahan' => $request->kelurahan,
            ]);

            DB::commit();

            Log::info('Data berhasil disimpan.');

            return redirect()->route('wajib-retribusi.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error saat menyimpan data:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambah data.');
        }
    }
}

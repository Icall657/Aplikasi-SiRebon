<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kapal;
use Illuminate\Http\Request;
use App\Models\RefJenisKapal;
use Illuminate\Support\Facades\Log;

class KapalwajibController extends Controller
{
    public function index()
    {
        // ambil semua data kapal lengkap sama data relasinya, biar gampang akses info lain
        $kapals = Kapal::with(['user', 'jenisKapal'])->get();
        return view('fitur.kapalwajibretribusi', compact('kapals'));
    }

    public function create()
    {
        // ambil data user yang levelnya wajib retribusi aja buat dropdown
        $users = User::where('level', 'Wajib Retribusi')->get();
        // ambil data semua jenis kapal buat dropdown juga
        $refJenisKapals = RefJenisKapal::all();

        return view('fitur.Kapal-WajibRetribusi.create', compact('users', 'refJenisKapals'));
    }

    public function store(Request $request)
    {
        // validasi biar data sesuai aturan dan tabel yang ada
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'nama_kapal' => 'required|string|max:50',
            'id_jenis_kapal' => 'required|exists:ref_jenis_kapal,id',
            'ukuran' => 'required|string|max:50',
        ]);

        try {
            // masukin data kapal baru ke database
            Kapal::create([
                'id_user' => $request->id_user,
                'nama_kapal' => $request->nama_kapal,
                'id_jenis_kapal' => $request->id_jenis_kapal,
                'ukuran' => $request->ukuran,
                'created_date' => now(),
                'created_id' => auth()->user()->id,
                'updated_id' => auth()->user()->id,
            ]);

            return redirect()->route('kapal-wajib-retribusi.index')->with('success', 'Data kapal berhasil ditambahkan.');
        } catch (\Exception $e) {
            // kalau ada error, masukin ke log dan balik ke halaman sebelumnya
            Log::error('Gagal menyimpan data kapal:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data kapal.');
        }
    }

    public function destroy($id)
    {
        // hapus data kapal sesuai id yang dipilih
        $data = Kapal::findOrFail($id);
        $data->delete();

        return redirect()->route('kapal-wajib-retribusi.index')->with('success', 'Data berhasil dihapus.');
    }

    public function edit($id)
    {
        // ambil data kapal sesuai id buat diedit
        $kapal = Kapal::findOrFail($id);
        $users = User::with('wajibRetribusi')->get();
        $refJenisKapals = RefJenisKapal::all();

        return view('fitur.Kapal-WajibRetribusi.edit', compact('kapal', 'users', 'refJenisKapals'));
    }

    public function update(Request $request, $id)
    {
        // validasi input sebelum update data kapal
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'nama_kapal' => 'required|string|max:255',
            'id_jenis_kapal' => 'required|exists:ref_jenis_kapal,id',
            'ukuran' => 'required|string|max:255',
        ]);

        // update data kapal sesuai id
        $kapal = Kapal::findOrFail($id);
        $kapal->id_user = $request->id_user;
        $kapal->nama_kapal = $request->nama_kapal;
        $kapal->id_jenis_kapal = $request->id_jenis_kapal;
        $kapal->ukuran = $request->ukuran;
        $kapal->save();

        return redirect()->route('kapal-wajib-retribusi.index')->with('success', 'Data kapal berhasil diperbarui');
    }
}

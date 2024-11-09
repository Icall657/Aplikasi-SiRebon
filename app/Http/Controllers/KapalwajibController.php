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
        // ambil data kapal beserta data relasinya
        $kapals = Kapal::with(['user', 'jenisKapal'])->get();
        return view('fitur.kapalwajibretribusi', compact('kapals'));
    }

    public function create()
    {
        $users = User::where('level', 'Wajib Retribusi')->get();
        $refJenisKapals = RefJenisKapal::all();

        return view('fitur.Kapal-WajibRetribusi.create', compact('users', 'refJenisKapals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'nama_kapal' => 'required|string|max:50',
            'id_jenis_kapal' => 'required|exists:ref_jenis_kapal,id',
            'ukuran' => 'required|string|max:50',
        ]);

        try {
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
            Log::error('Gagal menyimpan data kapal:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data kapal.');
        }
    }

    public function destroy($id)
    {
        $data = Kapal::findOrFail($id);
        $data->delete();

        return redirect()->route('kapal-wajib-retribusi.index')->with('success', 'Data berhasil dihapus.');
    }
}

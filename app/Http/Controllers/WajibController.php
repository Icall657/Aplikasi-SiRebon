<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use App\Models\WajibRetribusi;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class WajibController extends Controller
{
    public function index()
    {
        $wajibRetribusi = WajibRetribusi::whereHas('user', function ($query) {
            $query->where('level', 'Wajib Retribusi');
        })->where('status', '!=', 'B')->get();

        return view('fitur.wajibretribusi', compact('wajibRetribusi')); // kirim data ke view
    }


    public function edit($id)
    {
        $wajib = WajibRetribusi::findOrFail($id);
        $kelurahans = Kelurahan::all();
        return view('fitur.Wajib-Retribusi.edit', compact('wajib', 'kelurahans')); // tampilkan halaman edit
    }

    public function update(Request $request, $id)
    {
        $wajib = WajibRetribusi::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15|regex:/^[0-9]+$/',
            'nik' => [
                'required',
                'string',
                'size:16',
                'regex:/^[0-9]+$/',
                Rule::unique('wajib_retribusi', 'nik')->ignore($wajib->id),
            ],
            'alamat' => 'required|string|max:255',
            'id_kelurahan' => 'required|exists:kelurahan,id',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nama.string' => 'Nama lengkap harus berupa teks.',
            'nama.max' => 'Nama lengkap maksimal 255 karakter.',

            'no_hp.required' => 'Nomor telepon wajib diisi.',
            'no_hp.string' => 'Nomor telepon harus berupa teks.',
            'no_hp.max' => 'Nomor telepon maksimal 15 karakter.',
            'no_hp.regex' => 'Nomor telepon hanya boleh berisi angka.',

            'nik.required' => 'NIK wajib diisi.',
            'nik.string' => 'NIK harus berupa teks.',
            'nik.size' => 'NIK harus berjumlah 16 angka.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'nik.unique' => 'NIK sudah terdaftar. Silakan gunakan NIK lain.',

            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',

            'id_kelurahan.required' => 'Kelurahan wajib dipilih.',
            'id_kelurahan.exists' => 'Kelurahan yang dipilih tidak valid.',
        ]);

        $wajib->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'id_kelurahan' => $request->id_kelurahan,
        ]);

        return redirect()->route('wajib-retribusi.index')->with('success', 'Data Wajib Retribusi berhasil diubah.');
    }


    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $wajib = WajibRetribusi::findOrFail($id);
            $wajib->status = 'B';
            $wajib->save();

            DB::commit();

            return redirect()->route('wajib-retribusi.index')->with('success', 'Data udah dinonaktifkan, bro.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('wajib-retribusi.index')->with('error', 'Eh, ada error waktu ngehapus datanya.');
        }
    }


    public function create()
    {
        $users = User::where('level', 'Wajib Retribusi')->get();
        $kelurahans = Kelurahan::all();
        return view('fitur.Wajib-Retribusi.create', compact('users', 'kelurahans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15|regex:/^[0-9]+$/',
            'nik' => 'required|string|size:16|regex:/^[0-9]+$/|unique:wajib_retribusi,nik',
            'alamat' => 'required|string|max:255',
            'id_kelurahan' => 'required|exists:kelurahan,id',
            'status' => 'required|in:A,B',
            'id_user' => 'required|exists:users,id',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nama.string' => 'Nama lengkap harus berupa teks.',
            'nama.max' => 'Nama lengkap maksimal 255 karakter.',

            'no_hp.required' => 'Nomor telepon wajib diisi.',
            'no_hp.string' => 'Nomor telepon harus berupa teks.',
            'no_hp.max' => 'Nomor telepon maksimal 15 karakter.',
            'no_hp.regex' => 'Nomor telepon hanya boleh berisi angka.',

            'nik.required' => 'NIK wajib diisi.',
            'nik.string' => 'NIK harus berupa teks.',
            'nik.size' => 'NIK harus berjumlah 16 angka.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'nik.unique' => 'NIK sudah terdaftar. Silakan gunakan NIK lain.',

            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',

            'id_kelurahan.required' => 'Kelurahan wajib dipilih.',
            'id_kelurahan.exists' => 'Kelurahan yang dipilih tidak valid.',

            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
        ]);

        WajibRetribusi::create([
            'id_user' => $request->id_user,
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'id_kelurahan' => $request->id_kelurahan,
            'status' => $request->status,
        ]);

        return redirect()->route('wajib-retribusi.index')->with('success', 'Data Wajib Retribusi berhasil ditambahkan.');
    }
}

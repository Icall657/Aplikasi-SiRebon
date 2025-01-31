<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WajibRetribusi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $wajibRetribusi = WajibRetribusi::where('id_user', $user->id)->first();

        return view('fitur.profil', compact('wajibRetribusi'));
    }


    public function update(Request $request)
    {
        $messages = [
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username maksimal 255 karakter.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.string' => 'NIK harus berupa teks.',
            'nik.max' => 'NIK maksimal 16 karakter.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'namaLengkap.required' => 'Nama lengkap wajib diisi.',
            'namaLengkap.string' => 'Nama lengkap harus berupa teks.',
            'namaLengkap.max' => 'Nama lengkap maksimal 255 karakter.',
            'namaLengkap.regex' => 'Nama lengkap hanya boleh berisi huruf dan spasi.',
            'telepon.required' => 'Nomor telepon wajib diisi.',
            'telepon.string' => 'Nomor telepon harus berupa teks.',
            'telepon.max' => 'Nomor telepon maksimal 16 karakter.',
            'telepon.regex' => 'Nomor telepon hanya boleh berisi angka.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',
        ];

        $request->validate([
            'username' => 'required|string|max:255',
            'nik' => 'required|string|max:16|regex:/^[0-9]+$/',
            'namaLengkap' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'telepon' => 'required|string|max:16|regex:/^[0-9]+$/',
            'alamat' => 'required|string|max:255',
        ], $messages);

        $user = Auth::user();
        $user->username = $request->input('username');
        $user->save();

        if ($user->wajibRetribusi) {
            $wajib = $user->wajibRetribusi;
            $wajib->nik = $request->input('nik');
            $wajib->nama = $request->input('namaLengkap');
            $wajib->no_hp = $request->input('telepon');
            $wajib->alamat = $request->input('alamat');
            $wajib->save();
        }

        return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbarui!');
    }


    public function gantiPassword()
    {
        return view('fitur.profil');
    }

    public function prosesGantiPassword(Request $request)
    {
        // cek password lama
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with('error', 'password lama salah');
        }

        if ($request->new_password != $request->password_confirmation) {
            return back()->with('error', 'password baru dan konfirmasi password tidak sama');
        }

        auth()->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('status', 'ganti password berhasil');
    }
}

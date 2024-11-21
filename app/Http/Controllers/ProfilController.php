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
        $request->validate([
            'username' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'namaLengkap' => 'required|string|max:255',
            'telepon' => 'required|string|max:16',
            'alamat' => 'required|string|max:255',
        ]);

        // ambil data user yang sedang login
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

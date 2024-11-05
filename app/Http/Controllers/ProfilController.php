<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function profil(){
        return view('fitur.profil');
    } 

    public function update(Request $request){
    // Validasi input
    $request->validate([
        'username' => 'required|string|max:255',
    ]);

    // Ambil user yang sedang login
    $user = Auth::user();
    
    // Gunakan nilai dari input 'username' untuk mengupdate kolom 'name' di database
    $user->name = $request->input('username');

    // Simpan perubahan ke database
    $user->save();

    // Redirect kembali dengan pesan sukses
    return redirect()->route('profil')->with('success', 'Username berhasil diperbarui!');
    }

    public function gantiPassword(){
        return view('fitur.profil');
    } 

    // Fungsi untuk mengupdate profil pengguna



    public function prosesGantiPassword(Request $request){
        //cek password lama
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with('error', 'password lama salah');
        }

        //cek password baru dan konfirmasi password
        if($request->new_password != $request->password_confirmation){
            return back()->with('error', 'password baru dan konfirmasi password tidak sama');
        }

        auth()->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('status', 'ganti password berhasil');
    } 
}
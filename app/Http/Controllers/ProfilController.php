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

    public function changePasswordForm()
    {
        return view('fitur.profil'); // Sesuaikan dengan nama view yang Anda gunakan
    }

    // Proses ganti password
    public function changePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:5|confirmed', // Pastikan konfirmasi password sama
        ]);

        // Cek apakah password lama benar
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->with('error', 'Password lama salah.');
        }

        // Ganti password
        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password berhasil diganti.');
    }
}

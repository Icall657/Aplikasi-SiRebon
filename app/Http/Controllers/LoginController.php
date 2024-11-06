<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function halamanlogin()
    {
        return view('login.login');
    }

    public function postlogin(Request $request)
    {
        // Mengambil kredensial tanpa opsi remember me
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Cek level user untuk menentukan redirect
            $user = Auth::user();

            if ($user->level === 'Admin Aplikasi') {
                return redirect()->route('home.index')->with('success', 'Selamat datang, Admin!');
            } elseif ($user->level === 'Wajib Retribusi') {
                return redirect()->route('profil.index')->with('success', 'Selamat datang di halaman profil Anda!');
            }
        }

        return redirect()->back()->with('error', 'Username atau password salah!');
    }



    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

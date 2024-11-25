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
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->level === 'Admin Aplikasi') {
                return redirect()->route('home.index')->with('success', 'Selamat datang, Admin!');
            } elseif ($user->level === 'Wajib Retribusi') {
                return redirect()->route('profil.index')->with('success', 'Selamat datang di halaman profil Anda!');
            } elseif ($user->level === 'Multiadmin') {
                return redirect()->route('multiadmin.index')->with('success', 'Selamat datang di halaman Multiadmin!');
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

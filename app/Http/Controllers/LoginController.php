<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function halamanlogin(){
        return view('login.login');
    }

    public function postlogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            // Cek level user untuk menentukan redirect
            $user = Auth::user();

            if ($user->level === 'admin') {
                return redirect()->route('home')->with('success', 'Selamat datang, Admin!');
            } elseif ($user->level === 'user') {
                return redirect()->route('profil')->with('success', 'Selamat datang di halaman profil Anda!');
            }
        }

        return redirect()->back()->with('error', 'Username atau password salah!');
    }

    public function logout(){
        Auth::logout();
        return redirect ('/login');
    }
}

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

            if ($user->level === 'Wajib Retribusi') {
                if ($user->wajibRetribusi && $user->wajibRetribusi->status !== 'A') {
                    return redirect()->back()->with('error', 'Akun anda sudah tidak aktif.');
                }
                return redirect()->route('profil.index');
            } elseif ($user->level === 'Admin Aplikasi') {
                return redirect()->route('home.index');
            } elseif ($user->level === 'Multiadmin') {
                return redirect()->route('multiadmin.index');
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

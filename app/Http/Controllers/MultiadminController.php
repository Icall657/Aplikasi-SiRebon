<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelurahan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\WajibRetribusi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class MultiadminController extends Controller
{
    public function index()
    {
        $users = User::where('level', '!=', 'Multiadmin')->get();
        return view('fitur.Multiadmin.multiadmin', compact('users'));
    }

    public function create()
    {
        $kelurahans = Kelurahan::all();
        return view('fitur.Multiadmin.create', compact('kelurahans'));
    }

    public function store(Request $request)
    {
        // Validasi input utama untuk pengguna
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'level' => 'required|in:Wajib Retribusi,Admin Aplikasi,Multiadmin',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'username' => $request->username,
            'level' => $request->level,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ]);

        Log::info('User baru dibuat', ['id' => $user->id, 'username' => $user->username, 'level' => $user->level]);

        if ($request->level === 'Wajib Retribusi') {
            $request->validate([
                'nama' => 'required|string|max:255',
                'no_hp' => 'required|string|max:15',
                'nik' => 'required|string|max:16',
                'alamat' => 'required|string',
                'id_kelurahan' => 'required|exists:kelurahan,id',
            ]);

            try {
                WajibRetribusi::create([
                    'id_user' => $user->id,
                    'nama' => $request->nama,
                    'no_hp' => $request->no_hp,
                    'nik' => $request->nik,
                    'alamat' => $request->alamat,
                    'id_kelurahan' => $request->id_kelurahan,
                    'status' => 'A',
                ]);

                Log::info('Data Wajib Retribusi berhasil ditambahkan', ['user_id' => $user->id, 'nama' => $request->nama]);
            } catch (\Exception $e) {
                Log::error('Error saat menambahkan data wajib_retribusi', ['error' => $e->getMessage(), 'user_id' => $user->id]);
                return redirect()->route('multiadmin.index')->with('error', 'Gagal menambahkan data Wajib Retribusi.');
            }
        }

        return redirect()->route('multiadmin.index')->with('success', 'Data berhasil ditambahkan!');
    }
}

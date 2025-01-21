<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RefBank;
use App\Models\Kelurahan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\WajibRetribusi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\MsRekening;  // Tambahkan model MsRekening

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
        $refBanks = RefBank::all(); // Query untuk mendapatkan data bank
        return view('fitur.Multiadmin.create', compact('kelurahans', 'refBanks'));
    }


    public function store(Request $request)
    {
        // Validasi input utama untuk pengguna
        $request->validate(
            [
                'username' => 'required|string|max:255|unique:users',
                'level' => 'required|in:Wajib Retribusi,Admin Aplikasi,Multiadmin',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ],
            [
                'username.required' => 'Username harus diisi.',
                'username.unique' => 'Username sudah digunakan, silakan pilih username lain.',
                'level.required' => 'Level harus dipilih.',
                'level.in' => 'Level yang dipilih tidak valid.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain.',
                'password.required' => 'Password harus diisi.',
                'password.min' => 'Password minimal harus 8 karakter.',
            ]
        );

        $user = User::create([
            'username' => $request->username,
            'level' => $request->level,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ]);

        Log::info('User baru dibuat', ['id' => $user->id, 'username' => $user->username, 'level' => $user->level]);

        if ($request->level === 'Wajib Retribusi') {
            $request->validate(
                [
                    'nama' => 'required|string|max:255',
                    'no_hp' => 'required|string|max:15',
                    'nik' => 'required|string|max:16',
                    'alamat' => 'required|string',
                    'id_kelurahan' => 'required|exists:kelurahan,id',
                ],
                [
                    'nama.required' => 'Nama lengkap harus diisi.',
                    'no_hp.required' => 'Nomor HP harus diisi.',
                    'nik.required' => 'NIK harus diisi.',
                    'nik.max' => 'NIK tidak boleh lebih dari 16 karakter.',
                    'alamat.required' => 'Alamat harus diisi.',
                    'id_kelurahan.required' => 'Kelurahan harus dipilih.',
                    'id_kelurahan.exists' => 'Kelurahan yang dipilih tidak valid.',
                ]
            );

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

        if ($request->level === 'Wajib Retribusi') {
            $request->validate(
                [
                    'id_ref_bank' => 'required|exists:ref_bank,id',
                    'nama_akun' => 'required|string|max:255',
                    'no_rekening' => 'required|string|max:20',
                ],
                [
                    'id_ref_bank.required' => 'Bank harus dipilih.',
                    'id_ref_bank.exists' => 'Bank yang dipilih tidak valid.',
                    'nama_akun.required' => 'Nama akun harus diisi.',
                    'no_rekening.required' => 'Nomor rekening harus diisi.',
                    'no_rekening.max' => 'Nomor rekening tidak boleh lebih dari 20 karakter.',
                ]
            );

            try {
                MsRekening::create([
                    'id_user' => $user->id,
                    'id_ref_bank' => $request->id_ref_bank,
                    'nama_akun' => $request->nama_akun,
                    'no_rekening' => $request->no_rekening,
                ]);

                Log::info('Data MsRekening berhasil ditambahkan', ['user_id' => $user->id, 'nama_akun' => $request->nama_akun]);
            } catch (\Exception $e) {
                Log::error('Error saat menambahkan data MsRekening', ['error' => $e->getMessage(), 'user_id' => $user->id]);
                return redirect()->route('multiadmin.index')->with('error', 'Gagal menambahkan data rekening.');
            }
        }

        return redirect()->route('multiadmin.index')->with('success', 'Data berhasil ditambahkan!');
    }
}

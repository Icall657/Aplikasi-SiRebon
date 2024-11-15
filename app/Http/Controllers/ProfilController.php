<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WajibRetribusi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index(){
        // ambil data wajib retribusi berdasarkan user yang login
        $wajibRetribusi = WajibRetribusi::where('id_user', auth()->user()->id)->get();
        return view('fitur.profil', compact('wajibRetribusi'));
    } 

    public function update(Request $request) {
        // validasi input dari form
        $request->validate([
            'username' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'namaLengkap' => 'required|string|max:255',
            'telepon' => 'required|string|max:16',
            'alamat' => 'required|string|max:255',
        ]);
    
        // ambil data user yang lagi login
        $user = Auth::user();
        
        // update username di tabel users
        $user->username = $request->input('username');
        $user->save();  // simpan perubahan ke tabel users
    
        // ambil data wajib_retribusi yang terhubung dengan user
        $wajibRetribusi = $user->wajibRetribusi; // misalnya ada relasi di model User
    
        // update data wajib_retribusi jika ada
        foreach ($wajibRetribusi as $wajib) {
            $wajib->nik = $request->input('nik');
            $wajib->nama = $request->input('namaLengkap');
            $wajib->no_hp = $request->input('telepon');
            $wajib->alamat = $request->input('alamat');
            $wajib->save(); // simpan perubahan ke tabel wajib_retribusi
        }
    
        // redirect kembali dengan pesan sukses
        return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbarui!');
    }
    
    public function gantiPassword(){
        // tampilkan halaman ganti password
        return view('fitur.profil');
    } 

    public function prosesGantiPassword(Request $request){
        // cek password lama
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with('error', 'password lama salah');
        }

        // cek password baru dan konfirmasi password
        if($request->new_password != $request->password_confirmation){
            return back()->with('error', 'password baru dan konfirmasi password tidak sama');
        }

        // update password user
        auth()->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('status', 'ganti password berhasil');
    } 
}

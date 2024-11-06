<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WajibRetribusi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index(){
        $wajibRetribusi = WajibRetribusi::where('id_user', auth()->user()->id)->get();
        return view('fitur.profil');
    } 

    public function update(Request $request) {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'namaLengkap' => 'required|string|max:255',
            'telepon' => 'required|string|max:16',
            'alamat' => 'required|string|max:255',
        ]);
    
        // Ambil user yang sedang login
        $user = Auth::user();
        
        // Update kolom 'username' di tabel users
        $user->username = $request->input('username');
        $user->save();  // Simpan perubahan pada tabel users
    
        // Ambil data wajib_retribusi terkait dengan user yang sedang login
        $wajibRetribusi = $user->wajibRetribusi; // Misalnya relasi pada model User
    
        // Jika data wajib_retribusi ada, perbarui data terkait
        foreach ($wajibRetribusi as $wajib) {
            $wajib->nik = $request->input('nik');
            $wajib->nama = $request->input('namaLengkap');
            $wajib->no_hp = $request->input('telepon');
            $wajib->alamat = $request->input('alamat');
            $wajib->save(); // Simpan perubahan ke tabel wajib_retribusi
        }
    
        // Redirect kembali dengan pesan sukses
        return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbarui!');
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
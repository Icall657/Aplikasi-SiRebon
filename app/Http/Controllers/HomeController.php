<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\WajibRetribusi;
use App\Models\KonfirmasiBayar;

class HomeController extends Controller
{
    public function index()
    {
        $jumlahBelumBayar = User::where('level', 'Wajib Retribusi')
            ->whereHas('wajibRetribusi', function ($query) {
                $query->where('status', '!=', 'B'); // filter wajib retribusi yang masih aktif
            })
            ->whereNotIn('id', function ($query) {
                $query->select('id_user')
                    ->from('konfirmasi_bayar')
                    ->where('status', 'Y');
            })
            ->distinct('id') // menghindari duplikasi jika ada
            ->count('id');

        $jumlahSudahBayar = KonfirmasiBayar::where('status', 'Y')
            ->distinct('id_user')
            ->whereHas('user.wajibRetribusi', function ($query) {
                $query->where('status', '!=', 'B'); // pastikan hanya hitung user yang aktif
            })
            ->count();

        $jumlahPemasukan = KonfirmasiBayar::where('status', 'Y')
            ->whereHas('user.wajibRetribusi', function ($query) {
                $query->where('status', '!=', 'B'); // hanya hitung pembayaran user aktif
            })
            ->sum('nominal');

        return view('home', compact('jumlahSudahBayar', 'jumlahPemasukan', 'jumlahBelumBayar'));
    }
}

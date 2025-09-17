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
                $query->where('status', '!=', 'B'); // hanya hitung user aktif
            })
            ->whereHas('kapals', function ($query) {
                $query->whereDoesntHave('konfirmasiBayar', function ($subQuery) {
                    $subQuery->where('status', 'Y');
                });
            })
            ->count();


        $jumlahSudahBayar = User::where('level', 'Wajib Retribusi')
            ->whereHas('wajibRetribusi', function ($query) {
                $query->where('status', '!=', 'B');
            })
            ->whereDoesntHave('kapals', function ($query) {
                $query->whereDoesntHave('konfirmasiBayar', function ($subQuery) {
                    $subQuery->where('status', 'Y');
                });
            })
            ->count();


        $jumlahPemasukan = KonfirmasiBayar::where('status', 'Y')
            ->whereHas('user.wajibRetribusi', function ($query) {
                $query->where('status', '!=', 'B');
            })
            ->sum('nominal');

        return view('home', compact('jumlahSudahBayar', 'jumlahPemasukan', 'jumlahBelumBayar'));
    }
}

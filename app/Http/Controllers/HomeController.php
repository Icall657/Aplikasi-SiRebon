<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WajibRetribusi;
use App\Models\KonfirmasiBayar;

class HomeController extends Controller
{
    public function index()
    {
        $jumlahBelumBayar = WajibRetribusi::whereNotIn('id', function ($query) {
            $query->select('id_user')
                ->from('konfirmasi_bayar')
                ->where('status', 'P')
                ->orWhere('status', 'Y');
        })->count();
        
        $jumlahSudahBayar = KonfirmasiBayar::where('status', 'Y')
            ->distinct('id_user')
            ->count();
        $jumlahPemasukan = KonfirmasiBayar::where('status', 'Y')->sum('nominal');

        return view('home', compact('jumlahSudahBayar', 'jumlahPemasukan', 'jumlahBelumBayar'));
    }
}

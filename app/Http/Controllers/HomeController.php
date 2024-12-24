<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KonfirmasiBayar;

class HomeController extends Controller
{
    public function index(){
        $jumlahSudahBayar = KonfirmasiBayar::where('status', 'Y')->count();
        $jumlahPemasukan = KonfirmasiBayar::where('status', 'Y')->sum('nominal');
        
        return view('home', compact('jumlahSudahBayar','jumlahPemasukan'));
    }
}

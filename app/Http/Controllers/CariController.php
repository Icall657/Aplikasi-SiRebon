<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kapal;
use Illuminate\Http\Request;
use App\Models\KonfirmasiBayar;

class CariController extends Controller
{
    public function index()
    {
        return view('fitur.cari', [
            'totalUsers' => User::count(),
            'sudahBayar' => KonfirmasiBayar::where('status', 'Y')->count(),
            'belumBayar' => Kapal::doesntHave('konfirmasiBayar')->count(),
            'pembayaranTerbaru' => KonfirmasiBayar::where('status', 'Y')->latest()->take(5)->get(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KonfirmasiBayar;

class RetribusiController extends Controller
{
    public function index()
    {
        $laporan = KonfirmasiBayar::where('status', 'Y')
            ->with(['user.wajibRetribusi', 'kapal'])
            ->get();

        return view('fitur.retribusi', compact('laporan'));
    }
}

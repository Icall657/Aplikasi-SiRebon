<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KonfirmasiBayar;

class PembayaranController extends Controller
{
    public function index(){
        $konfirmasiBayar = KonfirmasiBayar::with(['user', 'msRekening', 'refBank'])->get();
        return view('fitur.pembayaranretribusi', compact('konfirmasiBayar'));
    }
}

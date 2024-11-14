<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KonfirmasiBayar;

class PembayaranController extends Controller
{
    public function index(){
        $konfirmasiBayars = KonfirmasiBayar::all();
        return view('fitur.pembayaranretribusi', compact('konfirmasiBayars'));
    }
}

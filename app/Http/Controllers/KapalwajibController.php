<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use Illuminate\Http\Request;

class KapalwajibController extends Controller
{
    public function index(){
        // Mengambil data kapal beserta data relasinya
        $kapals = Kapal::with(['user', 'jenisKapal'])->get();
        return view('fitur.kapalwajibretribusi', compact('kapals'));
    }
    
    
}

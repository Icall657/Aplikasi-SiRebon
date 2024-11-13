<?php

namespace App\Http\Controllers;

use App\Models\RefBank;
use App\Models\MsRekening;
use Illuminate\Http\Request;

class KonfirmasiController extends Controller
{
    public function index(){
        $banks = RefBank::all();
        $msRekenings = MsRekening::all();
        return view('fitur.konfirmasipembayaran', compact('banks' , 'msRekenings'));
    }
}

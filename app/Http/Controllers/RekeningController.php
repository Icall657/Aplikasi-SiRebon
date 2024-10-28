<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekeningController extends Controller
{
    public function rekening(){
        return view('fitur.rekeningpembayaran');
    }
}

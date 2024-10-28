<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KapalkuController extends Controller
{
    public function kategori(){
        return view('fitur.kapalku');
    }
}

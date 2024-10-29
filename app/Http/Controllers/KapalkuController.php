<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KapalkuController extends Controller
{
    public function kapalku(){
        return view('fitur.kapalku');
    }
}

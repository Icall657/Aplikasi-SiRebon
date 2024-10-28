<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }

    public function laporan(){
        return view('fitur.laporan');
    }

    public function rekening(){
        return view('fitur.rekeningpembayaran');
    }
}

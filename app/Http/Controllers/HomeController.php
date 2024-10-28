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
    public function retribusi(){
        return view('fitur.wajibretribusi');
    }
    public function pembayaran(){
        return view('fitur.pembayaranretribusi');
    }
    public function kategori(){
        return view('fitur.kategoriretribusi');
    }
    public function kapal(){
        return view('fitur.kapalwajibretribusi');
    }
    
}

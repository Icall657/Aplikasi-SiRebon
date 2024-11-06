<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WajibRetribusi;

class WajibController extends Controller
{
    public function index(){
        $wajibRetribusi = WajibRetribusi::where('id_user', auth()->user()->id)->get();
        return view('fitur.wajibretribusi');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RetribusiController extends Controller
{
    public function index(){
        return view('fitur.retribusi');
    }
}

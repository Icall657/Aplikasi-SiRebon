<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LupaPaswordController extends Controller
{
    public function index()
    {
        return view('login.forgot_password');
    }
}

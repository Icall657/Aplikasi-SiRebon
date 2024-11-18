<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WajibRetribusi;

class KapalkuController extends Controller
{
    public function index()
    {
        $wajibRetribusi = WajibRetribusi::whereHas('user', function ($query) {
            $query->where('level', 'Wajib Retribusi');
        })->get();
        return view('fitur.wajibretribusi', compact('wajibRetribusi'));
    }
}
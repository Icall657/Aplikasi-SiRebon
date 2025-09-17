<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BelumRetribusiController extends Controller
{
    public function index()
    {
        $belumBayar = User::where('level', 'Wajib Retribusi')
            ->whereHas('kapals', function ($query) {
                $query->whereNotIn('id', function ($subQuery) {
                    $subQuery->select('id_kapal')
                        ->from('konfirmasi_bayar')
                        ->where('status', 'Y');
                });
            })
            ->distinct('id')
            ->with(['wajibRetribusi', 'kapals'])
            ->get();

        return view('fitur.belumretribusi', compact('belumBayar'));
    }
}

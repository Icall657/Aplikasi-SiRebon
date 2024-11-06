<?php

namespace App\Http\Controllers;

use App\Models\RefBank;
use App\Models\MsRekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    public function index(){
        $rekening = MsRekening::all();      
        return view('fitur.rekeningpembayaran',compact('rekening'));
    }

    public function create()
    {
        $refBanks = RefBank::all();
        return view('fitur.Rekening.create', compact('refBanks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_ref_bank' => 'required|exists:ref_bank,id',
            'nama_akun' => 'required|string|max:50',
            'no_rekening' => 'required|string|max:50',
        ]);

        MsRekening::create($request->all());

        return redirect()->route('rekening.index')->with('success', 'Data rekening berhasil ditambahkan.');
    }
}

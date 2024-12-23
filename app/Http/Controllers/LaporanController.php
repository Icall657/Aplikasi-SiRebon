<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KonfirmasiBayar;

class LaporanController extends Controller
{
    // LaporanController.php
    public function index(Request $request)
    {
        // Ambil input tanggal awal dan tanggal akhir dari request
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        // Query untuk mengambil data berdasarkan tanggal
        $laporan = KonfirmasiBayar::with(['user', 'msRekening', 'refBank'])
            ->whereBetween('tgl_bayar', [$tanggal_awal, $tanggal_akhir])
            ->get();

        // Kirim data ke view laporan
        return view('fitur.laporan', compact('laporan'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KonfirmasiBayar;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $user = Auth::user();

        $laporanQuery = KonfirmasiBayar::with(['user', 'msRekening', 'refBank'])
            ->whereBetween('tgl_bayar', [$tanggal_awal, $tanggal_akhir]);

        if ($user->level === 'Wajib Retribusi') {
            $laporanQuery->where('id_user', $user->id);
        }

        $laporan = $laporanQuery->get();

        return view('fitur.laporan', compact('laporan'));
    }
}

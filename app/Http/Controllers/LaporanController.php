<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KonfirmasiBayar;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ], [
            'tanggal_akhir.after_or_equal' => 'Tanggal Akhir tidak boleh lebih kecil dari Tanggal Awal!',
        ]);

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

<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use Illuminate\Http\Request;
use App\Models\KonfirmasiBayar;

class PembayaranController extends Controller
{
    public function index()
    {
        $konfirmasiBayar = KonfirmasiBayar::with(['user', 'msRekening', 'refBank'])->get();
        return view('fitur.pembayaranretribusi', compact('konfirmasiBayar'));
    }
    public function updateStatus(Request $request, $id)
    {
        $validatedStatus = $request->validate([
            'status' => 'required|in:sesuai,tidak_sesuai',
        ]);

        $konfirmasiBayar = KonfirmasiBayar::findOrFail($id);

        $konfirmasiBayar->status = $validatedStatus['status'] === 'sesuai' ? 'Y' : 'N';
        $konfirmasiBayar->tindaklanjut_tgl = now();
        $konfirmasiBayar->tindaklanjut_user = 'Admin';
        $konfirmasiBayar->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }
}

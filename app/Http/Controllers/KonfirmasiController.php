<?php

namespace App\Http\Controllers;

use App\Models\RefBank;
use App\Models\MsRekening;
use Illuminate\Http\Request;
use App\Models\KonfirmasiBayar;

class KonfirmasiController extends Controller
{
    public function index()
    {
        $banks = RefBank::all();
        $msRekenings = MsRekening::all();
        return view('fitur.konfirmasipembayaran', compact('banks', 'msRekenings'));
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'id_ref_bank' => 'required|exists:ref_bank,id',
            'nominal_transfer' => 'required|numeric',
            'id_ms_rekening' => 'required|exists:ms_rekening,id',
            'file_bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('file_bukti')) {
            $file = $request->file('file_bukti');
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
            $fileExtension = $file->getClientOriginalExtension();

            if (!in_array($fileExtension, $allowedExtensions)) {
                return back()->withErrors(['file_bukti' => 'File yang diupload tidak dikenal. Harap unggah file dengan ekstensi jpg, jpeg, png, atau pdf.']);
            }
        }

        $user = auth()->user();
        $msRekening = MsRekening::find($request->id_ms_rekening);

        if (!$msRekening) {
            return back()->withErrors(['id_ms_rekening' => 'Rekening tidak ditemukan.']);
        }

        $filePath = $request->file('file_bukti')->store('bukti_pembayaran', 'public');

        $konfirmasiBayar = new KonfirmasiBayar();
        $konfirmasiBayar->id_user = $user->id;
        $konfirmasiBayar->id_ms_rekening = $request->id_ms_rekening;
        $konfirmasiBayar->file_bukti = $filePath;
        $konfirmasiBayar->tgl_bayar = now();
        $konfirmasiBayar->nama_pemilik_rekening = $msRekening->nama_akun;
        $konfirmasiBayar->id_ref_bank = $request->id_ref_bank;
        $konfirmasiBayar->no_rekening_pemilik = $msRekening->no_rekening;
        $konfirmasiBayar->status = 'P';
        $konfirmasiBayar->save();
        $konfirmasiBayar->tindaklanjut_tgl = now();
        $konfirmasiBayar->tindaklanjut_user = 'admin';

        return redirect()->route('konfirmasi.index')->with('success', 'Terima kasih telah membayar retribusi. Mohon tunggu konfirmasi dari admin.');
    }
}

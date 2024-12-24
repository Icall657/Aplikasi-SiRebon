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

    public function confirm(Request $request){
        $request->validate([
            'id_ref_bank' => 'required|exists:ref_bank,id',
            'nominal_transfer' => 'required|numeric',
            'id_ms_rekening' => 'required|exists:ms_rekening,id',
            'file_bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'id_ref_bank.required' => 'Jenis bank harus dipilih.',
            'id_ref_bank.exists' => 'Jenis bank yang dipilih tidak valid.',
            'nominal_transfer.required' => 'Nominal transfer harus diisi.',
            'nominal_transfer.numeric' => 'Nominal transfer harus berupa angka.',
            'id_ms_rekening.required' => 'Nomor rekening harus dipilih.',
            'id_ms_rekening.exists' => 'Nomor rekening yang dipilih tidak valid.',
            'file_bukti.required' => 'File bukti pembayaran harus diunggah.',
            'file_bukti.file' => 'Field bukti pembayaran harus berupa file.',
            'file_bukti.mimes' => 'Bukti pembayaran harus berupa file dengan tipe: jpg, jpeg, png, atau pdf.',
            'file_bukti.max' => 'File bukti pembayaran maksimal 2MB.',
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

        $refBank = RefBank::find($request->id_ref_bank);
        if ($msRekening->id_ref_bank != $refBank->id) {
            return back()->withErrors(['id_ref_bank' => 'Nama bank tidak sesuai dengan rekening yang dipilih.']);
        }

        $filePath = $request->file('file_bukti')->store('bukti_pembayaran', 'public');

        $konfirmasiBayar = new KonfirmasiBayar();
        $konfirmasiBayar->id_user = $user->id;
        $konfirmasiBayar->id_ms_rekening = $request->id_ms_rekening;
        $konfirmasiBayar->file_bukti = $filePath;
        $konfirmasiBayar->nominal = $request->nominal_transfer;
        $konfirmasiBayar->tgl_bayar = now();
        $konfirmasiBayar->nama_pemilik_rekening = $msRekening->nama_akun;
        $konfirmasiBayar->id_ref_bank = $request->id_ref_bank;
        $konfirmasiBayar->no_rekening_pemilik = $msRekening->no_rekening;
        $konfirmasiBayar->status = 'P';
        $konfirmasiBayar->save();

        return redirect()->route('konfirmasi.index')->with('success', 'Terima kasih telah membayar retribusi. Mohon tunggu konfirmasi dari admin.');
    }
}

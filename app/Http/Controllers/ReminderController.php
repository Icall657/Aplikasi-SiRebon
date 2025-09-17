<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\PaymentReminder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReminderController extends Controller
{
    public function sendEmailReminder(Request $request)
    {
        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan!'], 404);
        }

        foreach ($user->kapals as $kapal) {
            $sudahBayar = DB::table('konfirmasi_bayar')
                ->where('id_kapal', $kapal->id)
                ->where('status', 'Y')
                ->exists();

            if (!$sudahBayar) {
                Mail::to($user->email)->send(new PaymentReminder($user->wajibRetribusi->nama, $kapal->nama_kapal, now()->addDays(7)));
            }
        }

        return response()->json(['message' => 'Pengingat berhasil dikirim!']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use Illuminate\Http\Request;
use App\Models\WajibRetribusi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class KapalkuController extends Controller
{


    public function index()
    {
        $currentUser = Auth::user();
        Log::info('User Login:', ['id' => $currentUser->id]);

        $kapalData = Kapal::with(['user.wajibRetribusi', 'jenisKapal'])
            ->where('id_user', $currentUser->id)
            ->get();

        Log::info('Data Kapal:', $kapalData->toArray());

        session(['kapalku_data' => $kapalData->toArray()]);

        return view('fitur.kapalku', ['kapalData' => session('kapalku_data')]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kapal;
use Illuminate\Http\Request;
use App\Models\RefJenisKapal;
use Illuminate\Support\Facades\Log;

class KapalwajibController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $search = $request->input('search'); // Get the search query from the input

        if ($user->level === 'Wajib Retribusi') {
            $kapals = Kapal::with(['jenisKapal', 'user.wajibRetribusi', 'konfirmasiBayar'])
                ->whereHas('user.wajibRetribusi', function ($query) {
                    $query->where('status', '!=', 'B'); // hanya ambil yang statusnya bukan 'B'
                })
                ->where('id_user', $user->id)
                ->where(function ($query) use ($search) {
                    $query->where('nama_kapal', 'like', "%$search%")
                        ->orWhereHas('jenisKapal', function ($query) use ($search) {
                            $query->where('jenis_kapal', 'like', "%$search%");
                        });
                })
                ->get();
        } else {
            $kapals = Kapal::with(['jenisKapal', 'user.wajibRetribusi', 'konfirmasiBayar'])
                ->whereHas('user.wajibRetribusi', function ($query) {
                    $query->where('status', '!=', 'B'); // filter wajib_retribusi yang statusnya bukan 'B'
                })
                ->where(function ($query) use ($search) {
                    $query->where('nama_kapal', 'like', "%$search%")
                        ->orWhereHas('jenisKapal', function ($query) use ($search) {
                            $query->where('jenis_kapal', 'like', "%$search%");
                        });
                })
                ->paginate(5);
        }

        return view('fitur.kapalwajibretribusi', compact('kapals'));
    }


    public function create()
    {
        $users = User::where('level', 'Wajib Retribusi')
            ->whereHas('wajibRetribusi', function ($query) {
                $query->where('status', 'A'); // filter hanya yang statusnya 'A'
            })
            ->get();

        $refJenisKapals = RefJenisKapal::all();

        return view('fitur.Kapal-WajibRetribusi.create', compact('users', 'refJenisKapals'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'nama_kapal' => 'required|string|max:255',
            'id_jenis_kapal' => 'required|exists:ref_jenis_kapal,id',
            'ukuran' => 'required|numeric|min:5|max:400',
        ], [
            'id_user.required' => 'Nama pemilik wajib dipilih.',
            'id_user.exists' => 'Pemilik yang dipilih tidak valid.',

            'nama_kapal.required' => 'Nama kapal wajib diisi.',
            'nama_kapal.string' => 'Nama kapal harus berupa teks.',
            'nama_kapal.max' => 'Nama kapal maksimal 255 karakter.',

            'id_jenis_kapal.required' => 'Jenis kapal wajib dipilih.',
            'id_jenis_kapal.exists' => 'Jenis kapal yang dipilih tidak valid.',

            'ukuran.required' => 'Ukuran kapal wajib diisi.',
            'ukuran.numeric' => 'Ukuran kapal harus berupa angka.',
            'ukuran.min' => 'Ukuran kapal minimal 5 meter.',
            'ukuran.max' => 'Ukuran kapal terlalu besar! Maksimal 400 meter.',
        ]);

        try {
            $ukuran = $request->ukuran;
            if (!str_ends_with($ukuran, 'm')) {
                $ukuran .= 'm';
            }

            Kapal::create([
                'id_user' => $request->id_user,
                'nama_kapal' => $request->nama_kapal,
                'id_jenis_kapal' => $request->id_jenis_kapal,
                'ukuran' => $ukuran,
                'created_date' => now(),
                'created_id' => auth()->user()->id,
                'updated_id' => auth()->user()->id,
            ]);

            return redirect()->route('kapal-wajib-retribusi.index')->with('success', 'Data kapal berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan data kapal:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data kapal.');
        }
    }


    public function destroy($id)
    {
        $kapal = Kapal::findOrFail($id);

        if ($kapal->konfirmasiBayar()->exists()) {
            return redirect()->route('kapal-wajib-retribusi.index')->with('error', 'Kapal ini sudah memiliki konfirmasi pembayaran dan tidak bisa dihapus.');
        }

        $kapal->delete();
        return redirect()->route('kapal-wajib-retribusi.index')->with('success', 'Data berhasil dihapus.');
    }


    public function edit($id)
    {
        $kapal = Kapal::findOrFail($id);
        $users = User::with('wajibRetribusi')->get();
        $refJenisKapals = RefJenisKapal::all();

        return view('fitur.Kapal-WajibRetribusi.edit', compact('kapal', 'users', 'refJenisKapals'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'nama_kapal' => 'required|string|max:255',
            'id_jenis_kapal' => 'required|exists:ref_jenis_kapal,id',
            'ukuran' => 'required|numeric|min:5|max:400',
        ], [
            'ukuran.required' => 'Ukuran kapal wajib diisi.',
            'ukuran.numeric' => 'Ukuran kapal harus berupa angka.',
            'ukuran.min' => 'Ukuran kapal minimal 5 meter.',
            'ukuran.max' => 'Ukuran kapal terlalu besar! Maksimal 400 meter.',
        ]);

        $kapal = Kapal::findOrFail($id);
        $kapal->id_user = $request->id_user;
        $kapal->nama_kapal = $request->nama_kapal;
        $kapal->id_jenis_kapal = $request->id_jenis_kapal;

        $ukuran = $request->ukuran . 'm';

        $kapal->ukuran = $ukuran;
        $kapal->save();

        return redirect()->route('kapal-wajib-retribusi.index')->with('success', 'Data kapal berhasil diperbarui');
    }
}

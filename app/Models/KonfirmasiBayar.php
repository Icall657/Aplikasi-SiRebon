<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonfirmasiBayar extends Model
{
    use HasFactory;

    protected $table = 'konfirmasi_bayar'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key

    // Daftar kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id_user',
        'id_ms_rekening',
        'file_bukti',
        'tgl_bayar',
        'nama_pemilik_rekening',
        'id_ref_bank',
        'no_rekening_pemilik',
        'status',
        'tindaklanjut_tgl',
        'tindaklanjut_user',
    ];

    /**
     * Relasi ke tabel `users`
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relasi ke tabel `ms_rekening`
     */
    public function msRekening()
    {
        return $this->belongsTo(MsRekening::class, 'id_ms_rekening');
    }

    /**
     * Relasi ke tabel `ref_bank`
     */
    public function refBank()
    {
        return $this->belongsTo(RefBank::class, 'id_ref_bank');
    }
}

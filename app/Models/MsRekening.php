<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsRekening extends Model
{
    use HasFactory;

    protected $table = 'ms_rekening';
    protected $fillable = ['id_ref_bank','id_user', 'nama_akun', 'no_rekening'];

    public function refBank()
    {
        return $this->belongsTo(RefBank::class, 'id_ref_bank');
    }

    public function konfirmasiBayar()
    {
        return $this->hasMany(KonfirmasiBayar::class, 'id_ms_rekening');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

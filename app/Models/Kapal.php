<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapal extends Model
{
    use HasFactory;

    protected $table = 'kapal';
    protected $fillable = [
        'id_user',
        'nama_kapal',
        'id_jenis_kapal',
        'ukuran',
        'created_id',
        'updated_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jenisKapal()
    {
        return $this->belongsTo(RefJenisKapal::class, 'id_jenis_kapal');
    }
}

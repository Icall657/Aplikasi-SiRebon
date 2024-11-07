<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WajibRetribusi extends Model
{
    use HasFactory;

    protected $table = 'wajib_retribusi';

    protected $fillable = [
        'id_user',
        'nama',
        'no_hp',
        'nik',
        'alamat',
        'kelurahan',
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

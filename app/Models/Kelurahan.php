<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    protected $table = 'kelurahan';
    protected $fillable = [
        'nama_kelurahan',
    ];

    // Relasi ke WajibRetribusi
    public function wajibRetribusi()
    {
        return $this->hasMany(WajibRetribusi::class, 'id_kelurahan');
    }
}

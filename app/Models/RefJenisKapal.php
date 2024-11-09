<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefJenisKapal extends Model
{
    use HasFactory;
    protected $table = 'ref_jenis_kapal';

    protected $fillable = [
        'jenis_kapal',
        'biaya_retribusi',
        'created_date',
        'created_id',
        'updated_date',
        'updated_id'
    ];

    public $timestamps = false;
}

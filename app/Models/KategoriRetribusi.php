<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriRetribusi extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'kategori_retribusi';

    // Menentukan kolom yang dapat diisi (fillable)
    protected $fillable = ['kategori'];
}

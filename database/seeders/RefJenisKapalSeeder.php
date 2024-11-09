<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefJenisKapalSeeder extends Seeder
{
    public function run()
    {
        DB::table('ref_jenis_kapal')->insert([
            [
                'jenis_kapal' => 'Kapal Penumpang',
                'biaya_retribusi' => 100000,
                'created_date' => now(),
                'created_id' => 'admin',
                'updated_date' => now(),
                'updated_id' => 'admin',
            ],
            [
                'jenis_kapal' => 'Kapal Barang',
                'biaya_retribusi' => 250000,
                'created_date' => now(),
                'created_id' => 'admin',
                'updated_date' => now(),
                'updated_id' => 'admin',
            ],
            [
                'jenis_kapal' => 'Kapal Tanker',
                'biaya_retribusi' => 500000,
                'created_date' => now(),
                'created_id' => 'admin',
                'updated_date' => now(),
                'updated_id' => 'admin',
            ],
            [
                'jenis_kapal' => 'Kapal Ferry',
                'biaya_retribusi' => 150000,
                'created_date' => now(),
                'created_id' => 'admin',
                'updated_date' => now(),
                'updated_id' => 'admin',
            ],
            [
                'jenis_kapal' => 'Kapal Pesiar',
                'biaya_retribusi' => 1000000,
                'created_date' => now(),
                'created_id' => 'admin',
                'updated_date' => now(),
                'updated_id' => 'admin',
            ],
            [
                'jenis_kapal' => 'Kapal Nelayan',
                'biaya_retribusi' => 50000,
                'created_date' => now(),
                'created_id' => 'admin',
                'updated_date' => now(),
                'updated_id' => 'admin',
            ],
            [
                'jenis_kapal' => 'Kapal Tugboat',
                'biaya_retribusi' => 300000,
                'created_date' => now(),
                'created_id' => 'admin',
                'updated_date' => now(),
                'updated_id' => 'admin',
            ],
        ]);
    }
}

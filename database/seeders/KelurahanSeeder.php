<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelurahan = [
            ['nama_kelurahan' => 'Kesambi'],
            ['nama_kelurahan' => 'Drajat'],
            ['nama_kelurahan' => 'Pekalangan'],
            ['nama_kelurahan' => 'Panjunan'],
            ['nama_kelurahan' => 'Kebonbaru'],
            ['nama_kelurahan' => 'Kejaksan'],
            ['nama_kelurahan' => 'Lemahwungkuk'],
            ['nama_kelurahan' => 'Pulasaren'],
            ['nama_kelurahan' => 'Sunyaragi'],
            ['nama_kelurahan' => 'Pekiringan'],
        ];

        DB::table('kelurahan')->insert($kelurahan);
    }
}

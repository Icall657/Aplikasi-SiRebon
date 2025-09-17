<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            ['nama_bank' => 'Bank Central Asia (BCA)'],
            ['nama_bank' => 'Bank Mandiri'],
            ['nama_bank' => 'Bank Negara Indonesia (BNI)'],
            ['nama_bank' => 'Bank Rakyat Indonesia (BRI)'],
            ['nama_bank' => 'Bank CIMB Niaga'],
            ['nama_bank' => 'Bank Danamon'],
            ['nama_bank' => 'Bank Syariah Indonesia (BSI)'],
        ];

        DB::table('ref_bank')->insert($banks);
    }
}


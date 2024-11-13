<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konfirmasi_bayar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_ms_rekening');
            $table->text('file_bukti');
            $table->date('tgl_bayar');
            $table->string('nama_pemilik_rekening', 50);
            $table->unsignedBigInteger('id_ref_bank');
            $table->string('no_rekening_pemilik', 25);
            $table->char('status', 1)->default('P');
            $table->dateTime('tindaklanjut_tgl')->nullable();
            $table->string('tindaklanjut_user', 30)->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_ms_rekening')->references('id')->on('ms_rekening')->onDelete('cascade');
            $table->foreign('id_ref_bank')->references('id')->on('ref_bank')->onDelete('cascade');
        });
    }

    /**
     * Membalikkan migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konfirmasi_bayar');
    }
};

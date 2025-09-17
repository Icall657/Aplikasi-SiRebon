<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ms_rekening', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ref_bank');
            $table->string('nama_akun', 50);
            $table->string('no_rekening', 50);
            $table->timestamps();

            $table->foreign('id_ref_bank')->references('id')->on('ref_bank')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_rekening');
    }
};

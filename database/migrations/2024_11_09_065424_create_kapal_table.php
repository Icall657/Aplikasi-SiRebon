<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKapalTable extends Migration
{
    public function up()
    {
        Schema::create('kapal', function (Blueprint $table) {
            $table->id(); // auto increment id
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade'); // foreign key ke tabel users
            $table->string('nama_kapal', 50);
            $table->foreignId('id_jenis_kapal')->constrained('ref_jenis_kapal')->onDelete('cascade'); // foreign key ke tabel ref_jenis_kapal
            $table->string('ukuran', 50);
            $table->timestamps();
            $table->string('created_id', 30);
            $table->string('updated_id', 30);
        });
    }

    public function down()
    {
        Schema::dropIfExists('kapal');
    }
}

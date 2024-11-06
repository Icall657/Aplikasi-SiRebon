<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWajibRetribusiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wajib_retribusi', function (Blueprint $table) {
            $table->id(); // id sebagai primary key dan auto_increment
            $table->unsignedBigInteger('id_user'); // kolom id_user sebagai foreign key
            $table->string('nama', 50); // nama dengan panjang maksimal 50 karakter
            $table->string('no_hp', 16); // no_hp dengan panjang maksimal 16 karakter
            $table->string('nik', 16); // nik dengan panjang maksimal 16 karakter
            $table->text('alamat'); // alamat dalam bentuk teks
            $table->timestamps();

            // Definisikan foreign key ke tabel users
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wajib_retribusi');
    }
}

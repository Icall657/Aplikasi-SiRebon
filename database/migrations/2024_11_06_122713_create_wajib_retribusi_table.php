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
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('nama', 50);
            $table->string('no_hp', 16);
            $table->string('nik', 16);
            $table->text('alamat');
            $table->unsignedBigInteger('id_kelurahan');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_kelurahan')->references('id')->on('kelurahan')->onDelete('cascade');
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

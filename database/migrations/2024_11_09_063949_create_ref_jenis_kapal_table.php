<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefJenisKapalTable extends Migration
{
    public function up()
    {
        Schema::create('ref_jenis_kapal', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kapal', 50);
            $table->double('biaya_retribusi');
            $table->dateTime('created_date')->nullable();
            $table->string('created_id', 30)->nullable();
            $table->dateTime('updated_date')->nullable();
            $table->string('updated_id', 30)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ref_jenis_kapal');
    }
}

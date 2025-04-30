<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaskapaisTable extends Migration
{
    public function up()
    {
        Schema::create('maskapais', function (Blueprint $table) {
            $table->id();
            $table->string('nama_maskapai');
            $table->string('kota_keberangkatan');
            $table->string('kota_tujuan');
            $table->date('tanggal');
            $table->time('jam_berangkat');
            $table->time('jam_tiba');
            $table->integer('harga_tiket');
            $table->integer('kapasitas_kursi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('maskapais');
    }
}

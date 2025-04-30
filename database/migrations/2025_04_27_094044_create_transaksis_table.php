<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemesan');
            $table->string('email');
            $table->string('no_hp');
            $table->unsignedBigInteger('maskapai_id'); // relasi ke maskapais
            $table->integer('jumlah_tiket');
            $table->integer('total_harga');
            $table->enum('status', ['Pending', 'Confirmed'])->default('Pending');
            $table->timestamps();

            $table->foreign('maskapai_id')->references('id')->on('maskapais')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}

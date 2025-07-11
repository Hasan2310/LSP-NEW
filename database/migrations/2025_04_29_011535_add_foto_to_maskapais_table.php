<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('maskapais', function (Blueprint $table) {
        $table->string('foto')->nullable(); // kolom foto, nullable
    });
}

public function down()
{
    Schema::table('maskapais', function (Blueprint $table) {
        $table->dropColumn('foto');
    });
}

};

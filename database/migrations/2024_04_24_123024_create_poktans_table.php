<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poktans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_petani');
            $table->string('luas_lahan_poktan');
            $table->string('no_hp_poktan');
            $table->string('status_poktan');
            $table->text('alamat_poktan');
            $table->foreignId('penyuluh_id')->nullable();
            $table->foreignId('kelompok_id')->nullable();
            $table->foreignId('kecamatan_id')->nullable();
            $table->foreignId('kelurahan_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poktans');
    }
};

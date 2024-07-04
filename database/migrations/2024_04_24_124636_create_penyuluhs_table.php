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
        Schema::create('penyuluhs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penyuluh');
            $table->string('nip_penyuluh')->nullable();
            $table->string('no_hp_penyuluh');
            $table->text('alamat_penyuluh');
            $table->foreignId('poktan_id')->nullable();
            $table->foreignId('gapoktan_id')->nullable();
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
        Schema::dropIfExists('penyuluhs');
    }
};

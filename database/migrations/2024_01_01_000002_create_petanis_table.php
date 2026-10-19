<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('petanis', function (Blueprint $table) {
            $table->id('id_penjual');
            $table->unsignedBigInteger('id_kelompok_tani');
            $table->string('nama');
            $table->string('nik', 30);
            $table->string('alamat', 100)->nullable();
            $table->string('telp', 30);
            $table->string('foto', 255)->nullable();
            $table->char('status', 1)->default('Y');
            $table->timestamps();

            $table->foreign('id_kelompok_tani')
                  ->references('id_kelompok_tani')
                  ->on('kelompok_tanis')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('petanis');
    }
};

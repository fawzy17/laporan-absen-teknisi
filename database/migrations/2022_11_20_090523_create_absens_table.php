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
        Schema::create('absens', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nip_karyawan');
            $table->string('nama_karyawan');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('kode_mesin');
            $table->enum('kondisi_mesin', ['Sangat Baik', 'Baik', 'Buruk', 'Sangat Buruk']);
            $table->string('foto');
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
        Schema::dropIfExists('absens');
    }
};

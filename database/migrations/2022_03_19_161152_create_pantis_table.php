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
        Schema::create('pantis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_panti')->unique();
            $table->string('lokasi');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('slug')->unique();
            $table->text('informasi');
            $table->text('kebutuhan');
            $table->string('jumlah_anak');
            $table->string('nomor_kontak');
            $table->integer('total_donatur');
            $table->integer('total_donasi_barang');
            $table->json('daftar_kategori_kebutuhan');
            $table->json('daftar_foto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pantis');
    }
};

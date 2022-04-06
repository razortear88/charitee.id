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
        Schema::create('donasi_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('id_donasi')->unique();
            $table->timestamps();
            $table->string('nama_panti');
            $table->string('nama_donatur');
            $table->string('email_donatur');
            $table->string('nomor_kontak_donatur');
            $table->string('alamat_barang');
            $table->text('keterangan_barang');
            $table->float('berat_barang');
            $table->boolean('status_donasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donasi_barangs');
    }
};

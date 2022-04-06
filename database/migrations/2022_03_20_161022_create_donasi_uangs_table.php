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
        Schema::create('donasi_uangs', function (Blueprint $table) {
            $table->id();
            $table->string('id_donasi')->unique();
            $table->timestamps();
            $table->string('nama_panti');
            $table->string('nama_donatur');
            $table->string('email_donatur');
            $table->string('nomor_kontak_donatur');
            $table->bigInteger('jumlah_uang');
            $table->string('tanggal_lunas')->nullable();
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
        Schema::dropIfExists('donasi_uangs');
    }
};

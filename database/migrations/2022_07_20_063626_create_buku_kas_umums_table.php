<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukuKasUmumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku_kas_umum', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('kode_kegiatan', 10);
            $table->string('kode_rekening');
            $table->bigInteger('nominal');
            $table->text('deskripsi');
            $table->date('tanggal_nota');
            $table->date('tanggal_lunas');
            $table->string('penerima');
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
        Schema::dropIfExists('buku_kas_umum');
    }
}

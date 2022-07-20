<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahunAnggaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahun_anggaran', function (Blueprint $table) {
            $table->decimal('tahun_anggaran_id', 4, 0);
            $table->string('nama');
            $table->decimal('periode_aktif', 1, 0);
            $table->timestamps();
            $table->primary('tahun_anggaran_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tahun_anggaran');
    }
}

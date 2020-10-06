<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggaranRealisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggaran_realisasi', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->foreignId('detail_jenis_anggaran_id')->constrained('detail_jenis_anggaran')->onDelete('cascade')->onUpdate('cascade');
            $table->text('keterangan_lainnya')->nullable();
            $table->bigInteger('nilai_anggaran');
            $table->bigInteger('nilai_realisasi');
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
        Schema::dropIfExists('anggaran_realisasi');
    }
}

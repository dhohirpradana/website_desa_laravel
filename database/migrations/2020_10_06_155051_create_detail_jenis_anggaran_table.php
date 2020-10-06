<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailJenisAnggaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_jenis_anggaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_anggaran_id')->constrained('jenis_anggaran')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('kelompok_jenis_anggaran_id')->constrained('kelompok_jenis_anggaran')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama',128)->nullable();
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
        Schema::dropIfExists('detail_jenis_anggaran');
    }
}

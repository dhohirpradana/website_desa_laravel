<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsiSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isi_surat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_id');
            $table->text('isi');
            $table->boolean('paragraf')->default(0);
            $table->boolean('kalimat')->default(0);
            $table->boolean('isian')->default(0);
            $table->boolean('perihal')->default(0);
            $table->boolean('tampilkan')->default(0);
            $table->timestamps();

            $table->foreign('surat_id')->references('id')->on('surat')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('isi_surat');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendudukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('kk', 16);
            $table->string('nama', 64);
            $table->tinyInteger('jenis_kelamin')->comment('1: Laki-laki, 2: Perempuan');
            $table->string('tempat_lahir', 32);
            $table->date('tanggal_lahir');
            $table->foreignId('agama_id')->constrained('agama')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('pendidikan_id')->nullable();
            $table->foreign('pendidikan_id')->references('id')->on('pendidikan')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('pekerjaan_id')->nullable();
            $table->foreign('pekerjaan_id')->references('id')->on('pekerjaan')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('darah_id')->nullable();
            $table->foreign('darah_id')->references('id')->on('darah')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('status_perkawinan_id')->constrained('status_perkawinan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('status_hubungan_dalam_keluarga_id')->constrained('status_hubungan_dalam_keluarga')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('kewarganegaraan');
            $table->string('nomor_paspor')->nullable();
            $table->string('nomor_kitas_atau_kitap')->nullable();
            $table->string('nik_ayah', 16);
            $table->string('nik_ibu', 16);
            $table->string('nama_ayah', 64);
            $table->string('nama_ibu', 64);
            $table->string('alamat');
            $table->unsignedBigInteger('detail_dusun_id')->nullable();
            $table->foreign('detail_dusun_id')->references('id')->on('detail_dusun')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('penduduk');
    }
}

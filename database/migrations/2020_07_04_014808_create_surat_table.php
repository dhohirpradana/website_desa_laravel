<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 64);
            $table->text('deskripsi')->nullable();
            $table->string('icon', 64);
            $table->boolean('tanda_tangan_bersangkutan')->default(0);
            $table->boolean('perihal')->default(0);
            $table->boolean('data_kades')->default(0);
            $table->boolean('tampilkan')->default(0);
            $table->bigInteger('jumlah_cetak')->default(0);
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
        Schema::dropIfExists('surat');
    }
}

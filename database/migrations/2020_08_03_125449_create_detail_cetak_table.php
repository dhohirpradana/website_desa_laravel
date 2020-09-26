<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailCetakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_cetak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cetak_surat_id')->constrained('cetak_surat')->onDelete('cascade')->onUpdate('cascade');
            $table->text('isian');
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
        Schema::dropIfExists('detail_cetak');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditPendudukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->string('nik_ayah', 16)->nullable()->change();
            $table->string('nik_ibu', 16)->nullable()->change();
            $table->string('nama_ayah', 64)->nullable()->change();
            $table->string('nama_ibu', 64)->nullable()->change();
            $table->string('alamat')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->string('nik_ayah', 16)->change();
            $table->string('nik_ibu', 16)->change();
            $table->string('nama_ayah', 64)->change();
            $table->string('nama_ibu', 64)->change();
            $table->string('alamat')->change();
        });
    }
}

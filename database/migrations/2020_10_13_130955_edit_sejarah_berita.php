<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditSejarahBerita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('sejarah', 'pemerintahan_desa');

        Schema::table('pemerintahan_desa', function (Blueprint $table) {
            $table->bigInteger('dilihat')->default(0)->after('konten');
        });

        Schema::table('berita', function (Blueprint $table) {
            $table->bigInteger('dilihat')->default(0)->after('konten');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn('dilihat');
        });

        Schema::table('pemerintahan_desa', function (Blueprint $table) {
            $table->dropColumn('dilihat');
        });

        Schema::rename('pemerintahan_desa', 'sejarah');
    }
}

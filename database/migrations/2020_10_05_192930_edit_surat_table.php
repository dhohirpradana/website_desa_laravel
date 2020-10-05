<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat', function (Blueprint $table) {
            $table->dropColumn('jumlah_cetak');
            $table->text('persyaratan')->nullable()->after('tampilkan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat', function (Blueprint $table) {
            $table->bigInteger('jumlah_cetak')->default(0)->after('tampilkan');
            $table->dropColumn('persyaratan');
        });
    }
}

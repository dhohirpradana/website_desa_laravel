<?php

use App\IsiSurat;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditTableIsiSurat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('isi_surat', function (Blueprint $table) {
            $table->tinyInteger('jenis_isi')->after('isi');
        });

        foreach (IsiSurat::all() as $isiSurat) {
            if ($isiSurat->paragraf == 1) {
                $isiSurat->update(['jenis_isi' => 1]);
            }
            if ($isiSurat->kalimat == 1) {
                $isiSurat->update(['jenis_isi' => 2]);
            }
            if ($isiSurat->isian == 1) {
                $isiSurat->update(['jenis_isi' => 3]);
            }
            if ($isiSurat->perihal == 1) {
                $isiSurat->update(['jenis_isi' => 4]);
            }
        }

        Schema::table('isi_surat', function (Blueprint $table) {
            $table->dropColumn(['paragraf','kalimat','isian','perihal']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('isi_surat', function (Blueprint $table) {
            $table->boolean('paragraf')->default(0)->after('isi');
            $table->boolean('kalimat')->default(0)->after('paragraf');
            $table->boolean('isian')->default(0)->after('kalimat');
            $table->boolean('perihal')->default(0)->after('isian');
        });

        foreach (IsiSurat::all() as $isiSurat) {
            if ($isiSurat->jenis_isi == 1) {
                $isiSurat->update(['paragraf' => 1]);
            }
            if ($isiSurat->jenis_isi == 2) {
                $isiSurat->update(['kalimat' => 1]);
            }
            if ($isiSurat->jenis_isi == 3) {
                $isiSurat->update(['isian' => 1]);
            }
            if ($isiSurat->jenis_isi == 4) {
                $isiSurat->update(['perihal' => 1]);
            }
        }

        Schema::table('isi_surat', function (Blueprint $table) {
            $table->dropColumn('jenis_isi');
        });
    }
}

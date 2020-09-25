<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailDusunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_dusun', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dusun_id')->constrained('dusun')->onUpdate('cascade')->onDelete('cascade');
            $table->string('rw',3);
            $table->string('rt',3);
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
        Schema::dropIfExists('detail_dusun');
    }
}

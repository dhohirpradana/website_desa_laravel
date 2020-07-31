<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChannelIdToDesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('desa', function (Blueprint $table) {
            $table->string('channel_id', 64)->nullable()->after('logo');
            $table->string('api_key', 128)->nullable()->after('channel_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('desa', function (Blueprint $table) {
            //
        });
    }
}

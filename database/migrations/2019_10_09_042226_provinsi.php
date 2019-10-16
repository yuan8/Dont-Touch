<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Provinsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('provinsi',function(Blueprint $table){
            $table->string('id_provinsi')->unique()->primary()->index();
            $table->string('nama');
            $table->string('nama_singkat');
            $table->string('ibukota');
            $table->integer('check');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('provinsi');

    }
}

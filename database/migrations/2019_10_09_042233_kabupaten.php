<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Kabupaten extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('kabupaten',function(Blueprint $table){
            $table->string('id_kabupaten')->unique()->primay()->index();
            $table->string('nama');
            $table->string('id_provinsi');
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

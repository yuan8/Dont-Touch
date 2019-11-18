<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MandatToUu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mandat_to_uu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_mandat')->unsigned();
            $table->bigInteger('id_uu')->unsigned();
            $table->unique(['id_mandat','id_uu']);
            $table->timestamps();


            $table->foreign('id_mandat')
            ->references('id')
            ->on('mandat')
            ->onDelete('cascade');

            $table->foreign('id_uu')
            ->references('id')
            ->on('master_uu')
            ->onDelete('cascade');
            
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
        Schema::dropIfExists('mandat_to_uu');

    }
}

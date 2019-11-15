<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MadatToPerpres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mandat_to_perpres', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('id_mandat')->unsigned();
            $table->bigInteger('id_perpres')->unsigned();
            $table->unique(['id_mandat','id_perpres']);
            $table->timestamps();


            $table->foreign('id_mandat')
            ->references('id')
            ->on('mandat')
            ->onDelete('cascade');

            $table->foreign('id_perpres')
            ->references('id')
            ->on('master_perpres')
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
        Schema::dropIfExists('mandat_to_perpres');
       
    }
}

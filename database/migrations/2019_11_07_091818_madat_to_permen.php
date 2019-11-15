<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MadatToPermen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mandat_to_permen', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('id_mandat')->unsigned();
            $table->bigInteger('id_permen')->unsigned();
            $table->unique(['id_mandat','id_permen']);
            $table->timestamps();


            $table->foreign('id_mandat')
            ->references('id')
            ->on('mandat')
            ->onDelete('cascade');

            $table->foreign('id_permen')
            ->references('id')
            ->on('master_permen')
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
        Schema::dropIfExists('mandat_to_permen');
       
    }
}

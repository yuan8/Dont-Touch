<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbIndikatorElement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         //
         Schema::create('tb_indikator_element', function (Blueprint $table) {
             $table->bigIncrements('id');
             $table->integer('tahun');
             $table->bigInteger('id_indikator')->unsigned();
             $table->bigInteger('id_element')->unsigned();
             $table->timestamps();

             $table->foreign('id_element')
             ->references('id')
             ->on('tb_element_data')
             ->onDelete('cascade');
             $table->foreign('id_indikator')
             ->references('id')
             ->on('tb_indikator')
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
        Schema::dropIfExists('tb_indikator_element');

    }
}

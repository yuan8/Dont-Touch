<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class F1Uu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         //
         Schema::connection('pgsql2')->create('form_1_uu',function(Blueprint $table){
           $table->bigIncrements('id')->index();
           $table->text('nama_uu');
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
         //
         Schema::connection('pgsql2')->dropIfExists('form_1_uu');

     }
}
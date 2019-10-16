<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class F2ArahKebijakan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         //
         Schema::connection('pgsql2')->create('form_2_kebijakan',function(Blueprint $table){
           $table->bigIncrements('id')->index();
           $table->bigInteger('id_form_2');
           $table->text('nama_arah_kebijakan');
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
         Schema::connection('pgsql2')->dropIfExists('form_2_kebijakan');

     }
}

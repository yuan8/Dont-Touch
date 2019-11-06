<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class F1Permen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         //
         Schema::create('form_1_permen',function(Blueprint $table){
           $table->bigIncrements('id')->index();
           $table->text('nama_permen');
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
         Schema::connection('pgsql2')->dropIfExists('form_1_permen');

     }
}

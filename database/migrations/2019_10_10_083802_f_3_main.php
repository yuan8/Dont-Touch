<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class F3Main extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         //
         Schema::connection('pgsql2')->create('form_3_main',function(Blueprint $table){
           $table->bigIncrements('id')->index();
           $table->integer('k_sub_urusan')->nullable();
           $table->integer('k_indikator_pusat')->nullable();
           $table->integer('k_indikator_provinsi')->nullable();
           $table->integer('k_indikator_kotakab')->nullable();
           // $table->text('k_keterangan')->nullable();
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
           Schema::connection('pgsql2')->dropIfExists('form_3_main');
     }
}

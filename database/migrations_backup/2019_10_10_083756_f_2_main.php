<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class F2Main extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         //
         Schema::connection('pgsql2')->create('form_2_main',function(Blueprint $table){
           $table->bigIncrements('id')->index();
           $table->text('k_kondisi_saat_ini');
           $table->text('k_isu_strategis')->nullable();
           $table->text('k_arah_kebijakan')->nullable();
           $table->string('k_sasaran')->nullable();
           $table->integer('k_indikator')->nullable();
           $table->integer('k_urusan')->nullable();
           $table->integer('k_sub_urusan')->nullable();
           $table->integer('k_kewenangan_pusat')->nullable();
           $table->integer('k_kewenangan_provinsi')->nullable();
           $table->integer('k_kewenangan_kotakab')->nullable();
           $table->text('k_keterangan')->nullable();
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
           Schema::connection('pgsql2')->dropIfExists('form_2_main');
     }
}

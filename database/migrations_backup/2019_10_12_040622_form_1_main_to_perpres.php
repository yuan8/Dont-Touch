<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Form1MainToPerpres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::connection(env('DBC2'))->create('form_1_main_to_perpres', function (Blueprint $table) {
             $table->bigInteger('id_form_1');
             $table->bigInteger('id_form_1_perpres');
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::connection(env('DBC2'))->dropIfExists('form_1_main_to_perpres');
     }
}

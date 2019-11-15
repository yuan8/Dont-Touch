<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class F1Main extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::connection('pgsql2')->create('form_1_main',function(Blueprint $table){
          
          $table->bigIncrements('id')->index();
          $table->bigInteger('k_sub_urusan')->unsigned();
          $table->text('k_mandat');
          $table->boolean('k_kesesuaian')->default(0);
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
          Schema::connection('pgsql2')->dropIfExists('form_1_main');
    }
}

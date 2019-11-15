<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tb23SubUrusan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
    {
        //
        Schema::create('master_sub_urusan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_urusan')->index();
            $table->string('nama');
            $table->timestamps();

            $table->unique(['id_urusan','nama']);
            
            
            $table->foreign('id_urusan')
            ->references('id')
           ->on('master_urusan')
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
        Schema::dropIfExists('master_sub_urusan');

    }
}

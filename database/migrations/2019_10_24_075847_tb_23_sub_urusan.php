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
        Schema::create('sub_urusan_23', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_urusan')->index();
            $table->string('nama');
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
        Schema::dropIfExists('sub_urusan_23');

    }
}

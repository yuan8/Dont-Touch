<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tb23SubUrusanDb2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
    {
        //
        Schema::connection('pgsql2')->create('master_sub_urusan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_urusan')->index();
            $table->string('nama');
            $table->timestamps();

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
        Schema::connection('pgsql2')->dropIfExists('master_sub_urusan');

    }
}

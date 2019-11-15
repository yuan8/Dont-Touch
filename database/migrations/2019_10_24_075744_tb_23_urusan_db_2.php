<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tb23UrusanDb2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::connection('pgsql2')->create('master_urusan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('nomenklatur_provinsi',5)->nullable();
            $table->string('nomenklatur_kabkota',5)->nullable();
            $table->unique(['nomenklatur_provinsi','nomenklatur_kabkota']);
            
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
        Schema::connection('pgsql2')->dropIfExists('master_urusan');

    }
}

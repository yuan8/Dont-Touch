<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IntegrasiTargetDaerahKotaKab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        //
        Schema::create('integrasi_target_kotakab', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('id_integrasi')->unsigned()->nullable();
            $table->string('kode_daerah',6)->unsigned();
            $table->string('target_daerah');
            $table->bigInteger('id_urusan')->unsigned();
            $table->integer('tahun')->length(4)->nullable();
            $table->bigInteger('id_user')->unsigned();
            $table->unique(['id_integrasi','kode_daerah','id_urusan','tahun']);
            $table->timestamps();


            $table->foreign('id_urusan')
            ->references('id')
           ->on('master_urusan')
            ->onDelete('cascade');

            $table->foreign('id_integrasi')
            ->references('id')
            ->on('integrasi_kotakab')
            ->onDelete('cascade');

            $table->foreign('kode_daerah')
            ->references('id_kota')
            ->on('kabupaten')
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
        Schema::dropIfExists('integrasi_target_kotakab');

    }
}

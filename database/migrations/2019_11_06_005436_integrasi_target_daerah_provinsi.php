<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IntegrasiTargetDaerahProvinsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('integrasi_target_provinsi', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('id_integrasi')->unsigned()->nullable();
            $table->string('kode_daerah',6)->unsigned();
            $table->integer('target_daerah');
            $table->bigInteger('id_urusan')->unsigned();
            $table->integer('tahun')->nullable();
            $table->bigInteger('id_user')->unsigned();
            $table->unique(['id_integrasi','kode_daerah','id_urusan','tahun']);
            $table->timestamps();


            $table->foreign('id_urusan')
            ->references('id')
            ->on('urusan_23')
            ->onDelete('cascade');

            $table->foreign('id_integrasi')
            ->references('id')
            ->on('integrasi_provinsi')
            ->onDelete('cascade');

            $table->foreign('kode_daerah')
            ->references('id_provinsi')
            ->on('provinsi')
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
        Schema::dropIfExists('integrasi_target_provinsi');

    }
}

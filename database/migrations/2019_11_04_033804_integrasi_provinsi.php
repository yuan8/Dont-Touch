<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IntegrasiProvinsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

         Schema::create('integrasi_provinsi', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('id_identifikasi_kebijakan_tahunan')->unsigned()->nullable();
            $table->string('kode_sub_kegiatan')->unsigned()->nullable();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_urusan')->unsigned();
            $table->integer('tahun')->length(4)->nullable();
            $table->unique(['id_identifikasi_kebijakan_tahunan','kode_sub_kegiatan']);
            
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
        Schema::dropIfExists('integrasi_provinsi');

    }
}

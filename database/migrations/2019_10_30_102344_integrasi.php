<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Integrasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

         Schema::create('integrasi', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('id_identifikasi_kebijakan_tahunan')->unsigned()->nullable();
            $table->bigInteger('id_mandat')->unsigned()->nullable();
            $table->bigInteger('id_urusan')->unsigned();
            $table->integer('tahun')->length(4)->nullable();
            $table->string('kode_sub_kegiatan',10);
            $table->text('indikator');
            $table->integer('target_daerah');
            $table->string('kode_daerah',20)->unsigned();
            $table->string('satuan_target_daerah',20);
            $table->integer('target_pusat');
            $table->string('satuan_target_pusat',20);
            $table->integer('kode')->default(1);
            $table->unique(['id_identifikasi_kebijakan_tahunan','id_urusan']);
            $table->unique(['id_mandat','id_urusan']);

            $table->bigInteger('id_user')->unsigned();

            $table->timestamps();


            $table->foreign('id_urusan')
            ->references('id')
           ->on('master_urusan')
            ->onDelete('cascade');

            

            $table->foreign('id_identifikasi_kebijakan_tahunan')
            ->references('id')
            ->on('identifikasi_kebijakan_tahunan')
            ->onDelete('cascade');


            $table->foreign('id_user')
            ->references('id')
            ->on('users');
          
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
        Schema::dropIfExists('integrasi');

    }
}

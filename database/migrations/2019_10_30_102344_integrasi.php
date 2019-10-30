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
            $table->bigInteger('id_indetifikasi_kebijakan_tahunan')->unsigned()->nullable();
            $table->bigInteger('id_mandat')->unsigned()->nullable();
            $table->bigInteger('id_urusan')->unsigned();
            $table->integer('tahun')->nullable();
            $table->char('kode_sub_kegiatan',10);
            $table->text('indikator');
            $table->integer('target_daerah');
            $table->char('kode_daerah',20)->unsigned();
            $table->char('satuan_target_daerah',20);
            $table->integer('target_pusat');
            $table->char('satuan_target_pusat',20);
            $table->integer('kode')->default(1);

            $table->bigInteger('id_user')->unsigned();

            $table->timestamps();


            $table->foreign('id_urusan')
            ->references('id')
            ->on('urusan_23')
            ->onDelete('cascade');

            

            $table->foreign('id_indetifikasi_kebijakan_tahunan')
            ->references('id')
            ->on('indetifikasi_kebijakan_tahunan')
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

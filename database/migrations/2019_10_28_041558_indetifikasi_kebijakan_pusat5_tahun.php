<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IndetifikasiKebijakanPusat5Tahun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        

          Schema::create('identifikasi_kebijakan_pusat5_tahun', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->bigInteger('id_sub_urusan')->unsigned();
            $table->bigInteger('id_urusan')->unsigned();
            $table->integer('tahun')->nullable();
            

            $table->integer('tahun_mulai')->nullable();
            $table->integer('tahun_selesai')->nullable();
            $table->mediumText('kondisi_saat_ini')->nullable();
            $table->mediumText('isu_strategis')->nullable();
            $table->mediumText('arah_kebijakan')->nullable();
            $table->mediumText('sasaran')->nullable();
            $table->mediumText('target')->nullable();
            $table->boolean('kewenangan_pusat')->default(0);
            $table->boolean('kewenangan_provinsi')->default();
            $table->boolean('kewenangan_kota_kabupaten')->default();
            $table->mediumText('keterangan')->nullable();

            $table->bigInteger('id_user')->unsigned();

            $table->timestamps();
            $table->foreign('id_sub_urusan')
            ->references('id')
            ->on('sub_urusan_23')
            ->onDelete('cascade');

            $table->foreign('id_urusan')
            ->references('id')
            ->on('urusan_23')
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
        Schema::dropIfExists('identifikasi_kebijakan_pusat5_tahun');

    }
}

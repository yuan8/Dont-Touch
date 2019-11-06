<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Permasalahan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('permasalahan', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('id_urusan')->unsigned();
            $table->integer('tahun')->nullable();

            $table->string('provinsi',2)->nullable();
            $table->string('kota_kabupaten',6)->nullable();

            $table->mediumText('masalah_pokok')->nullable();
            $table->mediumText('masalah')->nullable();
            $table->mediumText('akar_masalah')->nullable();
            $table->mediumText('data_pendukung')->nullable();
            $table->bigInteger('id_user')->unsigned();

            $table->timestamps();
           

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
        Schema::dropIfExists('permasalahan');

    }
}
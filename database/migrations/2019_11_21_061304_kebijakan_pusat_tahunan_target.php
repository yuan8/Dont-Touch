<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KebijakanPusatTahunanTarget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('kebijakan_pusat_tahunan_target', function(Blueprint $table) {

            $table->bigIncrements('id');    
            $table->bigInteger('id_urusan')->unsigned();
            $table->bigInteger('id_kebijikan_pusat_tahunan')->unsigned();
            $table->integer('tahun')->length(4)->nullable();
            $table->text('target');
            $table->text('lokus');
            $table->text('pelaksana');
            $table->bigInteger('id_user')->unsigned();

            $table->timestamps();

            $table->foreign('id_urusan')
            ->references('id')
            ->on('master_urusan')
            ->onDelete('cascade');

            $table->foreign('id_kebijikan_pusat_tahunan')
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

        Schema::dropIfExists('kebijakan_pusat_tahunan_target');

    }
}

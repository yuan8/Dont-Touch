<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IndetifikasiKebijakanTahunan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('indetifikasi_kebijakan_tahunan', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('id_urusan')->unsigned();
            $table->integer('tahun')->nullable();
            $table->Text('prioritas_nasional');
            $table->Text('program_prioritas')->nullable();
            $table->Text('kegiatan_prioritas')->nullable();
            $table->Text('target')->nullable();
            $table->Text('lokus')->nullable();
            $table->Text('pelaksana')->nullable();
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
        Schema::dropIfExists('indetifikasi_kebijakan_tahunan');
    }
}

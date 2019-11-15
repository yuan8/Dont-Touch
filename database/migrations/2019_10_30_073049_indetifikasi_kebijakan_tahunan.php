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
         Schema::create('identifikasi_kebijakan_tahunan', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('id_urusan')->unsigned();
            $table->integer('tahun')->length(4)->nullable();
            $table->bigInteger('prioritas_nasional')->unsigned();
            $table->bigInteger('program_prioritas')->nullable()->unsigned();;
            $table->Text('kegiatan_prioritas')->nullable();
            $table->Text('target')->nullable();
            $table->Text('lokus')->nullable();
            $table->Text('pelaksana')->nullable();
            $table->Text('indikator')->nullable();
            $table->Text('target_akumulatif')->nullable();
            $table->string('target_akumulatif_satuan')->nullable();
            $table->bigInteger('id_user')->unsigned();
            $table->timestamps();

            $table->foreign('id_urusan')
            ->references('id')
           ->on('master_urusan')
            ->onDelete('cascade');

            $table->foreign('prioritas_nasional')
            ->references('id')
            ->on('master_prioritas_nasional')
            ->onDelete('cascade');

            $table->foreign('program_prioritas')
            ->references('id')
            ->on('master_program_prioritas')
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
        Schema::dropIfExists('identifikasi_kebijakan_tahunan');
    }
}

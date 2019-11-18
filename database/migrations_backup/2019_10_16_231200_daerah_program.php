<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DaerahProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
       Schema::create('daerah_program', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_bidang_urusan')->unsigned();
            $table->string('kode',6);
            $table->string('kode_daerah',12);
            $table->string('kode_urusan',2)->unsigned();
            $table->string('kode_bidang_urusan',4)->unsigned();
            // $table->string('nama_program');
            $table->integer('tahun')->length(4);
            $table->timestamps();
            $table->unique(['kode','kode_urusan','kode_bidang_urusan','tahun','kode_daerah']);
             $table->foreign('id_bidang_urusan')
            ->references('id')
            ->on('tb_bidang_urusan')
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
        Schema::dropIfExists('daerah_program');

    }
}

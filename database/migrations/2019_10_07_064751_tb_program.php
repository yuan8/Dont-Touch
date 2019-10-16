<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_program', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode',20);
            $table->integer('kode_urusan')->unsigned();
            $table->integer('kode_bidang_urusan')->unsigned();
            $table->string('nama_program');
            $table->integer('tahun');
            $table->timestamps();
        });

        
        $table->foreign('kode_urusan')
        ->references('kode')
        ->on('tb_urusan')
        ->onDelete('cascade');
        
        $table->foreign('kode_bidang_urusan')
        ->references('kode')
        ->on('tb_bidang_urusan')
        ->onDelete('cascade');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('tb_program');

    }
}

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
            $table->string('kode',8);

            // $table->integer('kode_urusan');
            // $table->integer('kode_bidang_urusan');
            // $table->integer('kode_program');
            $table->string('nama_program');
            $table->timestamps();
        });
        // $table->foreign('kode_urusan')
        // ->references('kode_urusan')
        // ->on('tb_urusan')
        // ->onDelete('cascade');
        //
        // $table->foreign('kode_bidang_urusan')
        // ->references('kode_bidang_urusan')
        // ->on('tb_bidang_urusan')
        // ->onDelete('cascade');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbBidangUrusan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_bidang_urusan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode',4);
            // $table->integer('kode_bidang_urusan');
            $table->string('nama_bidang_urusan');
            $table->timestamps(6);
            // $table->foreign('kode_urusan')
            // ->references('kode_urusan')
            // ->on('tb_urusan')
            // ->onDelete('cascade');
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
        Schema::dropIfExists('tb_bidang_urusan');

    }
}

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
            $table->bigInteger('id_urusan')->unsigned();
            $table->string('kode',4);
            $table->string('kode_urusan',2);
            $table->string('nama_bidang_urusan');
            $table->integer('session');
            $table->timestamps(6);
            $table->unique(['kode','kode_urusan','session']);
            $table->foreign('id_urusan')
            ->references('id')
            ->on('tb_urusan')
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
        Schema::dropIfExists('tb_bidang_urusan');

    }
}

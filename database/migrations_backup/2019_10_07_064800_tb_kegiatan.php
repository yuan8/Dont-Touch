<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_kegiatan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_program')->unsigned();
            $table->string('kode',8);
            $table->string('kode_urusan',2)->unsigned();
            $table->string('kode_bidang_urusan',4)->unsigned();
            $table->string('kode_program',6)->unsigned();
            $table->string('nama_kegiatan');
            $table->integer('session');
            $table->unique(['kode','kode_urusan','kode_bidang_urusan','kode_program','session']);

            $table->timestamps();

               
            $table->foreign('id_program')
            ->references('id')
            ->on('tb_program')
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
        Schema::dropIfExists('tb_kegiatan');

    }
}

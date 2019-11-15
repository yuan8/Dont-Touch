<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbSubKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_sub_kegiatan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_kegiatan');
            
            $table->string('kode',10);
            $table->string('kode_urusan',2);
            $table->string('kode_bidang_urusan',4);
            $table->string('kode_program',6);
            $table->string('kode_kegiatan',8);
            $table->string('nama_sub_kegiatan');
            $table->integer('tahun')->length(4);

            $table->unique(['kode','kode_urusan','kode_bidang_urusan','kode_program','kode_kegiatan','tahun']);

            $table->timestamps();

            $table->foreign('id_kegiatan')
            ->references('id')
            ->on('tb_kegiatan')
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
        Schema::dropIfExists('tb_sub_kegiatan');

    }
}

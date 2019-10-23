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
            
            $table->char('kode',10);
            $table->char('kode_urusan',2);
            $table->char('kode_bidang_urusan',4);
            $table->char('kode_program',6);
            $table->char('kode_kegiatan',8);
            $table->char('nama_sub_kegiatan');
            $table->integer('tahun');

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

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
            $table->string('kode',9);

            // $table->integer('kode_urusan');
            // $table->integer('kode_bidang_urusan');
            // $table->integer('kode_program');
            // $table->integer('kode_kegiatan');
            // $table->integer('kode_sub_kegiatan');
            $table->string('nama_sub_kegiatan');
            $table->timestamps();
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

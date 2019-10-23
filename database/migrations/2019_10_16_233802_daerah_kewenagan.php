<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DaerahKewenagan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('daerah_kewenangan', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('id_program');
            $table->boolean('kewenagan_pusat')->default(0);
            $table->boolean('kewenagan_provinsi')->default(0);
            $table->boolean('kewenagan_kotakab')->default(0);
            $table->integer('tahun')->nullable();
            $table->timestamps();

            $table->foreign('id_program')
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
        Schema::dropIfExists('daerah_kewenangan');

    }
}

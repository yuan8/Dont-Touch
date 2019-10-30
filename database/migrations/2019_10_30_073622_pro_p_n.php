<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProPN extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::create('indetifikasi_kebijakan_tahunan_pro_pn', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('id_urusan')->unsigned();
            $table->bigInteger('id_indetifikasi_kebijakan_tahunan')->unsigned();

            $table->integer('tahun')->nullable();
            $table->Text('pro_pn');
          
            $table->bigInteger('id_user')->unsigned();

            $table->timestamps();

            $table->foreign('id_urusan')
            ->references('id')
            ->on('urusan_23')
            ->onDelete('cascade');

            $table->foreign('id_indetifikasi_kebijakan_tahunan')
            ->references('id')
            ->on('indetifikasi_kebijakan_tahunan')
            ->onDelete('cascade');

            $table->foreign('id_user')
            ->references('id')
            ->on('users');
          
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
        Schema::dropIfExists('indetifikasi_kebijakan_tahunan_pro_pn');
        
    }
}

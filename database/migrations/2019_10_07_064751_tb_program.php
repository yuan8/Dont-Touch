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
            $table->bigInteger('id_bidang_urusan')->unsigned();
            $table->char('kode',6);
            $table->char('kode_urusan',2)->unsigned();
            $table->char('kode_bidang_urusan',4)->unsigned();
            $table->string('nama_program');
            $table->integer('session');
            $table->timestamps();
            
            $table->unique(['kode','kode_urusan','kode_bidang_urusan','session']);

             $table->foreign('id_bidang_urusan')
            ->references('id')
            ->on('tb_bidang_urusan')
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
        Schema::dropIfExists('tb_program');

    }
}

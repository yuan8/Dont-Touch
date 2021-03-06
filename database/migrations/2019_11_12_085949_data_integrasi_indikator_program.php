<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DataIntegrasiIndikatorProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::connection('pgsql2')->create('indikator_program', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->integer('tahun')->length(4);
            $table->bigInteger('id_urusan')->unsigned();
            $table->bigInteger('id_program')->unsigned();
            $table->string('kode_indikator')->nullable();
            $table->text('indikator');

            $table->integer('target1')->nullable();
            $table->integer('target2')->nullable();
            $table->integer('target3')->nullable();
            $table->integer('target4')->nullable();
            $table->integer('target5')->nullable();
           
            $table->text('label')->nullable();

            $table->foreign('id_urusan')
            ->references('id')
           ->on('master_urusan')
            ->onDelete('cascade');
            

            $table->foreign('id_program')
            ->references('id')
            ->on('program')
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
        Schema::connection('pgsql2')->dropIfExists('indikator_program');
        
    }
}

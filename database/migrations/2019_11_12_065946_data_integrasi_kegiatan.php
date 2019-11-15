<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DataIntegrasiKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::connection('pgsql2')->create('kegiatan', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->integer('tahun')->length(4);
            
            $table->bigInteger('id_urusan')->unsigned();
            $table->bigInteger('id_program')->unsigned();

            $table->string('kode_daerah',20);
            $table->boolean('tag_provinsi')->default(0);

            $table->string('kode_program',20)->nullable();
            $table->string('label_program')->nullable();

            $table->string('kode_kegiatan',20);
            $table->string('label_kegiatan');
            $table->text('pelaksana')->nullable();


    

            $table->unique(['id_urusan','tahun','kode_daerah','kode_kegiatan','id_program']);


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
    
        Schema::connection('pgsql2')->dropIfExists('kegiatan');
    }
}

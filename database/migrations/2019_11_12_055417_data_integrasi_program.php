<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DataIntegrasiProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

         Schema::connection('pgsql2')->create('program', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tahun')->length(4);
            $table->bigInteger('id_urusan')->unsigned();
            $table->string('kode_daerah',20);
            $table->boolean('tag_provinsi')->default(0);
            $table->string('kode_program',20)->nullable();
            $table->string('label_program');
            $table->text('label')->nullable();

            $table->unique(['id_urusan','tahun','kode_daerah','kode_program']);

            $table->foreign('id_urusan')
            ->references('id')
           ->on('master_urusan')
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
        Schema::connection('pgsql2')->dropIfExists('program');

    }
}

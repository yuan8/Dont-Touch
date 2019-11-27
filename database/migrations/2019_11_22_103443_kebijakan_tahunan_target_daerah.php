<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KebijakanTahunanTargetDaerah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('kebijakan_pusat_tahunan_target_provinsi', function(Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->bigInteger('id_target_pusat')->unsigned();

            $table->string('kode_sub_kegiatan')->unsigned()->nullable();
            $table->string('kode_kegiatan')->unsigned()->nullable();;
            $table->string('kode_program')->unsigned()->nullable();;

            $table->bigInteger('id_user')->unsigned();
            
            $table->bigInteger('id_urusan')->unsigned();

            $table->integer('tahun')->length(4)->nullable();
            
            $table->text('target')->nullable();
            $table->string('satuan_target')->nullable();
            $table->string('kode_daerah');
            $table->text('indikator')->nullable();

            $table->timestamps();

            $table->unique(['id_target_pusat','kode_sub_kegiatan','tahun','kode_daerah']);

            $table->foreign('id_urusan')
            ->references('id')
            ->on('master_urusan')
            ->onDelete('cascade');

            $table->foreign('id_user')
            ->references('id')
            ->on('users');

            $table->foreign('id_target_pusat')
            ->references('id')
            ->on('kebijakan_pusat_tahunan_target')
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
        Schema::dropIfExists('kebijakan_pusat_tahunan_target_provinsi');

    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PKLSupd2IndikatorProvinsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

         Schema::create('program_kegiatan_lingkup_supd_2_indikator_provinsi', function(Blueprint $table) {

            $table->bigIncrements('id'); 
            $table->bigInteger('id_kegiatan_supd_2')->unsigned();
            $table->text('indikator')->nullable();
            $table->bigInteger('target_awal')->nullable();
            $table->bigInteger('target_ahir')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('tahun')->length(4)->nullable();
            $table->bigInteger('id_urusan')->unsigned();           
            $table->bigInteger('id_user')->unsigned();
            $table->timestamps();


            $table->foreign('id_urusan')
            ->references('id')
            ->on('master_urusan')
            ->onDelete('cascade');

            $table->foreign('id_kegiatan_supd_2')
            ->references('id')
            ->on('program_kegiatan_lingkup_supd_2')
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
        Schema::dropIfExists('program_kegiatan_lingkup_supd_2_indikator_provinsi');
        
    }
}

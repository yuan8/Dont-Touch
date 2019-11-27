<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProgramKegiatanLingkupSipd2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
           Schema::create('program_kegiatan_lingkup_supd_2', function(Blueprint $table) {

            $table->bigIncrements('id'); 
            $table->boolean('nspk')->default(0);
            $table->boolean('spm')->default(0);
            $table->boolean('pn')->default(0);
            $table->boolean('sdgs')->default(0);
            $table->string('kode_daerah')->nullable();
            $table->string('kode_program')->nullable();
            $table->string('kode_kegiatan')->nullable();
            $table->bigInteger('anggaran')->nullable();
            $table->integer('tahun')->length(4)->nullable();
            $table->integer('tahun_ahir')->length(4)->nullable();
            $table->text('pelaksana')->nullable();
            $table->bigInteger('id_urusan')->unsigned();           
            $table->bigInteger('id_user')->unsigned();
            $table->unique(['id_urusan','kode_daerah','kode_program','kode_kegiatan','tahun']);



            $table->timestamps();

         

            $table->foreign('id_urusan')
            ->references('id')
           ->on('master_urusan')
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
        Schema::dropIfExists('program_kegiatan_lingkup_supd_2');
        
    }
}

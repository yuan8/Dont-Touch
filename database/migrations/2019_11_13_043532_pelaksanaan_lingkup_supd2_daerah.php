<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PelaksanaanLingkupSupd2Daerah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('pelaksanaan_lingkup_supd_2_daerah', function(Blueprint $table) {

            $table->bigIncrements('id');    
            $table->bigInteger('id_urusan')->unsigned();
            $table->bigInteger('id_sub_urusan')->unsigned();
            $table->string('kode_daerah');
            $table->boolean('tag_provinsi')->default(0);
            $table->integer('tahun')->length(4)->nullable();
            $table->text('indikator');
            $table->text('data')->default('[]');
        
            $table->bigInteger('id_user')->unsigned();

            $table->timestamps();
            
            $table->foreign('id_sub_urusan')
            ->references('id')
            ->on('master_sub_urusan')
            ->onDelete('cascade');

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
        Schema::dropIfExists('pelaksanaan_lingkup_supd_2_daerah');

    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KebijakanPusatTahunan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

          Schema::create('n_kebijakan_pusat_tahunan', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('id_urusan')->unsigned();
            $table->integer('tahun')->length(4)->nullable();
            $table->bigInteger('id_master_pn')->unsigned();
            $table->Text('target')->nullable();
            $table->Text('lokus')->nullable();
            $table->Text('pelaksana')->nullable();
            $table->Text('indikator')->nullable();
            $table->Text('target_akumulatif')->nullable();
            $table->string('target_akumulatif_satuan')->nullable();
            $table->bigInteger('id_user')->unsigned();
            $table->timestamps();

            $table->foreign('id_urusan')
            ->references('id')
            ->on('master_urusan')
            ->onDelete('cascade');


            // $table->foreign('id_master_pn')
            // ->references('id')
            // ->on('master_pn')
            // ->onDelete('cascade');


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
        Schema::dropIfExists('n_kebijakan_pusat_tahunan');

    }
}

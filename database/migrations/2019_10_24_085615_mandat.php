<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Mandat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        //
        Schema::create('mandat', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->mediumText('uu')->nullable();
            $table->mediumText('pp')->nullable();
            $table->mediumText('perpres')->nullable();
            $table->mediumText('permen')->nullable();
            $table->mediumText('mandat')->nullable();
            $table->bigInteger('id_sub_urusan')->unsigned();
            $table->bigInteger('id_urusan')->unsigned();
            $table->boolean('jenis')->default(0);
            $table->integer('tahun')->length(4)->nullable();

            $table->Text('target')->nullable();
            $table->Text('lokus')->nullable();
            $table->Text('pelaksana')->nullable();
            $table->Text('indikator')->nullable();
            $table->Text('target_akumulatif')->nullable();
            $table->string('target_akumulatif_satuan')->nullable();



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
        Schema::dropIfExists('mandat');

    }
}

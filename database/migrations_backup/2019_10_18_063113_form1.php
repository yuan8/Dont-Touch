<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Form1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('form_1_main', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('id_bidang')->unsigned()->unique();
            $table->mediumText('uu')->nullable();
            $table->mediumText('pp')->nullable();
            $table->mediumText('permen')->nullable();
            $table->mediumText('perpres')->nullable();
            $table->mediumText('mandat')->nullable();
            
            $table->timestamps();
            $table->foreign('id_bidang')
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
        Schema::dropIfExists('form_1_main');

    }
}

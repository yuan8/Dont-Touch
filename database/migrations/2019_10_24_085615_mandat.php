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
            $table->integer('tahun')->nullable();
            

            $table->bigInteger('id_user')->unsigned();
            $table->timestamps();
            $table->foreign('id_sub_urusan')
            ->references('id')
            ->on('sub_urusan_23')
            ->onDelete('cascade');

            $table->foreign('id_urusan')
            ->references('id')
            ->on('urusan_23')
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

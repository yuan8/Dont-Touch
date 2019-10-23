<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserBidangUrusan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_bidang_urusan', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('id_bidang')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->unique(['id_bidang','id_user']);

            $table->foreign('id_bidang')
            ->references('id')
            ->on('tb_bidang_urusan')
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
        Schema::dropIfExists('user_bidang_urusan');

    }
}

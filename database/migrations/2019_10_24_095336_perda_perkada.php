<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PerdaPerkada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        //
        Schema::create('perda_perkada', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('id_mandat')->unsigned();
            $table->integer('tahun')->nullable();
            $table->char('provinsi',2)->nullable();
            $table->char('kota_kabupaten',6)->nullable();
            $table->mediumText('perda')->nullable();
            $table->mediumText('perkada')->nullable();

            $table->integer('kesesuaian')->default(0);
            $table->mediumText('keterangan')->nullable();
            $table->bigInteger('id_user')->unsigned();


            $table->timestamps();
            $table->foreign('id_mandat')
            ->references('id')
            ->on('mandat')
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
        Schema::dropIfExists('perda_perkada');

    }
}

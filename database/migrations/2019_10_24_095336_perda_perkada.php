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
            $table->bigInteger('id_urusan')->unsigned();
            $table->integer('tahun')->length(4)->nullable();
            $table->string('provinsi',2)->nullable();
            $table->string('kota_kabupaten',6)->nullable();
            $table->mediumText('perda')->nullable();
            $table->mediumText('perkada')->nullable();

            $table->boolean('jenis')->default(0);
            
            $table->boolean('penilaian')->default(0)->comment('jika mandat kegiatan maka berubah menjadi dilaksanakan atau belum');

            $table->boolean('telah_dinilai')->default(0);

            $table->mediumText('keterangan')->nullable();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_user_penilai')->unsigned()->nullable();



            $table->timestamps();
            $table->foreign('id_mandat')
            ->references('id')
            ->on('mandat')
            ->onDelete('cascade');

            $table->foreign('id_urusan')
            ->references('id')
           ->on('master_urusan')
            ->onDelete('cascade');

            $table->foreign('id_user')
            ->references('id')
            ->on('users');

             $table->foreign('id_user_penilai')
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

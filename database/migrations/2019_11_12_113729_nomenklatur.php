<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Nomenklatur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('master_nomenklatur_kabkota',function(Blueprint $table){
                $table->bigIncrements('id');
                $table->string('urusan',1)->nullable();
                $table->string('bidang_urusan',4)->nullable();
                $table->string('program',8)->nullable();
                $table->string('kegiatan',12)->nullable();
                $table->string('sub_kegiatan',14)->nullable();
                $table->text('nomenklatur')->nullable();
                $table->string('kode')->nullable();
                $table->string('jenis',14)->nullable();
                $table->timestamps();
        });

        Schema::connection('pgsql2')->create('master_nomenklatur_kabkota',function(Blueprint $table){
                $table->bigIncrements('id');
                $table->string('urusan',1)->nullable();
                $table->string('bidang_urusan',4)->nullable();
                $table->string('program',8)->nullable();
                $table->string('kegiatan',12)->nullable();
                $table->string('sub_kegiatan',14)->nullable();
                $table->text('nomenklatur')->nullable();
                $table->string('kode')->nullable();
                $table->string('jenis',14)->nullable();
                $table->timestamps();
        });


          Schema::create('master_nomenklatur_provinsi',function(Blueprint $table){
                $table->bigIncrements('id');
                $table->string('urusan',1)->nullable();
                $table->string('bidang_urusan',4)->nullable();
                $table->string('program',8)->nullable();
                $table->string('kegiatan',12)->nullable();
                $table->string('sub_kegiatan',14)->nullable();
                $table->text('nomenklatur')->nullable();
                $table->string('kode')->nullable();
                $table->string('jenis',14)->nullable();
                $table->timestamps();
        });

        Schema::connection('pgsql2')->create('master_nomenklatur_provinsi',function(Blueprint $table){
                $table->bigIncrements('id');
                $table->string('urusan',1)->nullable();
                $table->string('bidang_urusan',4)->nullable();
                $table->string('program',8)->nullable();
                $table->string('kegiatan',12)->nullable();
                $table->string('sub_kegiatan',14)->nullable();
                $table->text('nomenklatur')->nullable();
                $table->string('kode')->nullable();
                $table->string('jenis',14)->nullable();
                $table->timestamps();
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
        Schema::connection('pgsql2')->dropIfExists('master_nomenklatur_kabkota');
        Schema::dropIfExists('master_nomenklatur_kabkota');

         Schema::connection('pgsql2')->dropIfExists('master_nomenklatur_provinsi');
        Schema::dropIfExists('master_nomenklatur_provinsi');
        
    }
}

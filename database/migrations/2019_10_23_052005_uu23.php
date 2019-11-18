<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Uu23 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

         Schema::create('kewenangan', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('nomer_bidang_urusan');
            $table->string('nomer_program');
            $table->string('nama_bidang_urusan');
            $table->string('nama_program');
            $table->mediumText('kewenangan_pusat')->nullable();
            $table->mediumText('kewenangan_provinsi')->nullable();
            $table->mediumText('kewenangan_kota_kab')->nullable();
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
        Schema::dropIfExists('kewenangan');
        
    }
}

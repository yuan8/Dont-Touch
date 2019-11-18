<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MasterSatuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::connection('pgsql2')->create('master_satuan', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->string('label')->unique();
            $table->string('kode',5)->unique();
           
        });

        Schema::create('master_satuan', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->string('label')->unique();
            $table->string('kode',5)->unique();
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
        Schema::connection('pgsql2')->dropIfExists('master_satuan');
        Schema::dropIfExists('master_satuan');
        


    }
}

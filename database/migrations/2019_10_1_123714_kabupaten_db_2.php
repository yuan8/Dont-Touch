<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



class KabupatenDb2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::connection('pgsql2')->create('kabupaten',function(Blueprint $table){
            $table->string('id_kota',6)->unique()->primay()->index();
            $table->string('nama');
            $table->boolean('status_kabupaten');
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
        Schema::connection('pgsql2')->dropIfExists('kabupaten');
        
    }
}


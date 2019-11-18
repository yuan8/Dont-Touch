<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProvinsiDb2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::connection('pgsql2')->create('provinsi',function(Blueprint $table){
            $table->string('id_provinsi',2)->unique()->primary()->index();
            $table->string('nama');
            $table->string('pulau');
            $table->string('nama_singkat');
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
        Schema::connection('pgsql2')->dropIfExists('provinsi');

    }
}

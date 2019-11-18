<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbElementData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_element_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_element');
            $table->string('satuan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('tag_provinsi')->default(0);
            $table->integer('tag_kab_kota')->default(0);
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
        Schema::dropIfExists('tb_element_data');

    }
}

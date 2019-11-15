<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableSubUrusan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection(env('DBC2'))->create('form_1_sub_urusan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nama_sub_urusan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::connection(env('DBC2'))->dropIfExists('form_1_sub_urusan');
    }

}

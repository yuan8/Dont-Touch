<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ViewForm1MainToUu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::connection(env('DBC2'))->statement("
        CREATE VIEW view_form_1_main_to_uu AS
          SELECT form_1_main_to_uu.id_form_1,
          form_1_main_to_uu.id_form_1_uu, form_1_uu.nama_uu
          FROM form_1_main_to_uu
          LEFT JOIN form_1_uu
          ON form_1_uu.id = form_1_main_to_uu.id_form_1_uu
      ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::connection(env('DBC2'))->statement("DROP VIEW view_form_1_main_to_uu");
    }
}

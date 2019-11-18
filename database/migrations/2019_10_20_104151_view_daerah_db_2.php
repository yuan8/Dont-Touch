<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ViewDaerahDb2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('pgsql2')->statement("
            CREATE VIEW view_daerah AS
            SELECT CONCAT(provinsi.id_provinsi,'00')  as id , CONCAT('PROVINSI ',provinsi.nama ) as nama, 1 AS pro  FROM provinsi
            UNION ALL
            SELECT kabupaten.id_kota  as id, CONCAT(kabupaten.nama ) as nama, 0 AS pro  FROM kabupaten
        ");
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection('pgsql2')->statement("DROP VIEW view_daerah");
    }
}

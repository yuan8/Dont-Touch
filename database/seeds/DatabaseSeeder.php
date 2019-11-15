<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Lokasi::class);
    	
        // $this->call(kewenangan::class);
        $this->call(UserRole::class);
        

        

    }
}

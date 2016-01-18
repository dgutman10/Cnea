<?php

use Illuminate\Database\Seeder;

class PrestamosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Prestamo::class, 30)->create();
    }
}

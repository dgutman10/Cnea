<?php

use Illuminate\Database\Seeder;

class InstrumentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Instrumento::class, 20)->create();
    }
}

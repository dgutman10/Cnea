<?php

use Illuminate\Database\Seeder;

class InstructivosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Instructivo::class, 5)->create();
    }
}

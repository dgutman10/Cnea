<?php

use Illuminate\Database\Seeder;

class InstrumentoTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\InstrumentoTag::class, 50)->create();
    }
}

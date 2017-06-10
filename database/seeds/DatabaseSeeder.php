<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(CursosTableSeeder::class);
        //$this->call(LaboratoriosTableSeeder::class);
        $this->call(UserTableSeeder::class);
        //$this->call(InstrumentosTableSeeder::class);
        //$this->call(TagsTableSeeder::class);
        //$this->call(InstructivosTableSeeder::class);
        //$this->call(PrestamosTableSeeder::class);
    }
}

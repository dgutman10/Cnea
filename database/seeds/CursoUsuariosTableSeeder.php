<?php

use Illuminate\Database\Seeder;

class CursoUsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\CursoUsuario::class, 5)->create();
    }
}

<?php

use Illuminate\Database\Seeder;

class LaboratorioUsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\LaboratorioUsuario::class, 10)->create();
    }
}

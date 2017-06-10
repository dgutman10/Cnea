<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'name'              => 'Admin',
            'email'             => 'admin@admin.com',
            'password'          => 'admin',
            'telephone'         => '12345678',
            'role'              => 'admin',
            'remember_token'    => str_random(10),
        ]);

        /*factory(App\User::class, 19)->create()->each(function($u) {
            for($i=0; $i<4; $i++){
                $u->cursos()->attach(rand($min = 1, $max = 12));
                $u->laboratorios()->attach(rand($min = 1, $max = 12));
            }
        });*/
    }
}

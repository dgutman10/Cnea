<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Tag::class, 50)->create()->each(function($u){
            for($i=0; $i < 2; $i++)
            {
                $u->instrumentos()->attach(rand($min = 1, $max = 50));
            }
        });
    }
}

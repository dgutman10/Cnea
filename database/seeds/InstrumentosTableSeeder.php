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
        factory(\App\Instrumento::class, 50)->create()->each(function($e) {
            $set = 1;
            for($i=0; $i<10; $i++){
                if($e->estado_prestamo == 'disponible')
                {
                    $prestamo = \App\Prestamo::create([
                        'usuario_presta' => rand($min = 1, $max = 20),
                        'usuario_recibe' => rand($min = 1, $max = 20),
                        'laboratorio_id' => rand($min = 1, $max = 12),
                        'curso_id' => rand($min = 1, $max = 12),
                        'instrumento_id' => rand($min = 1, $max = 50),
                        'estado_prestamo' => 'terminado',
                        'mail' => 'mail@mail.com',
                        'telefono' => '11111111',
                    ]);
                    $e->prestamos()->save($prestamo);
                }
                else
                {
                    if($set == 1)
                    {
                        $prestamo = \App\Prestamo::create([
                            'usuario_presta' => rand($min = 1, $max = 20),
                            'usuario_recibe' => rand($min = 1, $max = 20),
                            'laboratorio_id' => rand($min = 1, $max = 12),
                            'curso_id' => rand($min = 1, $max = 12),
                            'instrumento_id' => rand($min = 1, $max = 50),
                            'estado_prestamo' => 'abierto',
                            'mail' => 'mail@mail.com',
                            'telefono' => '11111111',
                        ]);
                        $e->prestamos()->save($prestamo);
                        $set = 0;
                    }

                    $prestamo = \App\Prestamo::create([
                        'usuario_presta' => rand($min = 1, $max = 20),
                        'usuario_recibe' => rand($min = 1, $max = 20),
                        'laboratorio_id' => rand($min = 1, $max = 12),
                        'curso_id' => rand($min = 1, $max = 12),
                        'instrumento_id' => rand($min = 1, $max = 50),
                        'estado_prestamo' => 'terminado',
                        'mail' => 'mail@mail.com',
                        'telefono' => '11111111',
                    ]);
                    $e->prestamos()->save($prestamo);
                }
            }
        });
    }

}

<?php

return [
    'permisos_search' => [
        'admin' => 'Administrador',
        'profesor' => 'Profesor',
        'alumno' => 'Alumno',
    ],

    'permisos_form' => [
        '' => '',
        'admin' => 'Administrador',
        'profesor' => 'Profesor',
        'alumno' => 'Alumno',
    ],

    'tipo_estados' => [
        '' => '',
        1 => 'Activo',
        2 => 'Inactivo',
    ],

    'prestamo' => [
        '' => '',
        'prestado' => 'Prestado',
        'disponible' => 'Instrumento disponible'
    ],

    'prestamo_estado' => [
        'abierto' => 'Prestamo vigente',
        'terminado' => 'Prestamo finalizado'

    ],
    'order' => [
        'nombre' => 'Nombre',
        'estado_prestamo' => 'Estado prestamo'
    ],
    'order_type' => [
        'ASC' => 'Ascendente',
        'DESC' => 'Descendente'
    ]
];
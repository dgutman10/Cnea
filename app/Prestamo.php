<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $fillable = [
        'usuario_presta',
        'usuario_recibe',
        'laboratorio_id',
        'curso_id',
        'instrumento_id',
        'estado_prestamo',
        'mail',
        'telefono'
    ];

    public function usuarioPresta()
    {
        return $this->belongsTo('App\User', 'usuario_presta');
    }

    public function usuarioRecibe()
    {
        return $this->belongsTo('App\User', 'usuario_recibe');
    }

    public function instrumento()
    {
        return $this->belongsTo('App\Instrumento', 'instrumento_id');
    }

    public function laboratorio()
    {
        return $this->belongsTo('App\Laboratorio', 'laboratorio_id');
    }

    public function curso()
    {
        return $this->belongsTo('App\Curso', 'curso_id');
    }

    public function scopeOfEstado($query, $estado)
    {
        if (!empty($estado) && $estado != '') {
            return $query->where('estado_prestamo', $estado);
        }
    }
}

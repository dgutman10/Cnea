<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    public function usuarioPresta()
    {
        return $this->belongsTo('App\User', 'usuario_presta');
    }

    public function usuarioRecibe()
    {
        return $this->belongsTo('App\User', 'usuario_recibe');
    }
}

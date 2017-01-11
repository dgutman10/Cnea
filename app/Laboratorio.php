<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    protected $fillable = ['nombre','tipo'];

    public function usuarios()
    {
        return $this->belongsToMany('App\User','laboratorio_usuarios');
    }

    public function scopeOfNombre($query, $value)
    {
        return $query->where('nombre','LIKE',"%$value%");
    }
}



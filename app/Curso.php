<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['nombre'];

    public function usuarios()
    {
        return $this->belongsToMany('App\User','curso_usuarios');
    }

    public function scopeOfNombre($query, $value)
    {
        return $query->where('nombre','LIKE',"%$value%");
    }
}

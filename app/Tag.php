<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['nombre'];

    public function instrumentos(){
        return $this->belongsToMany('App\Instrumento','instrumento_tags');
    }

    public function scopeOfNombre($query, $nombre)
    {
        return $query->where('nombre','LIKE',"%$nombre%");
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'telephone', 'doc_number'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    use SoftDeletes;
    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = bcrypt($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cursos()
    {
        return $this->belongsToMany('App\Curso','curso_usuarios');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function laboratorios()
    {
        return $this->belongsToMany('App\Laboratorio','laboratorio_usuarios');
    }

    public function prestar()
    {
        return $this->hasMany('App\Prestamo', 'usuario_presta');
    }

    public function recibir()
    {
        return $this->hasMany('App\Prestamo','usuario_recibe');
    }

    public function scopeOfName($query, $name)
    {
        if(! empty($name))
        {
            return $query->where('name','LIKE',"%$name%");
        }
    }

    public function scopeOfRoles($query, $roles)
    {
        if(count($roles) > 0)
        {
            return $query->whereIn('role',$roles);
        }

    }

    public function scopeOfCursos($query, $cursos)
    {
        if(count($cursos) > 0)
        {
            return $query->whereHas('cursos', function($q) use($cursos)
            {
                return $q->whereIn('curso_id',$cursos);
            });
        }
    }

    public function scopeOfLaboratorios($query, $laboratorios)
    {
        if( count($laboratorios) > 0)
        {
            return $query->whereHas('laboratorios', function($q) use($laboratorios)
            {
                return $q->whereIn('laboratorio_id',$laboratorios);
            });
        }
    }

    public function scopeOfEstado($query, $estado){
        if(empty($estado) OR $estado == '')
        {
            $query->withTrashed();
        }
        elseif($estado == 2)
        {
            $query->onlyTrashed();
        }
    }

    public static function obtenerCursos($cursos)
    {
        $res = array();

        foreach ($cursos as $curso) {
             $res[] = $curso->pivot->curso_id;
        }

        return $res;
    }

    public static function obtenerLaboratorios($laboratorios)
    {
        $res = array();

        foreach ($laboratorios as $laboratorio) {
            $res[] = $laboratorio->pivot->laboratorio_id;
        }

        return $res;
    }
}

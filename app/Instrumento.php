<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instrumento extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['nombre','img_url','inventario','observaciones','descripcion'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag','instrumento_tags');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamo()
    {
        return $this->hasMany('App\Prestamo','instrumento_id');
    }

    /**
     * @param $tags
     * @return array
     */
    public static function obtenerCursos($tags)
    {
        $res = array();

        foreach ($tags as $tag) {
            $res[] = $tag->pivot->tag_id;
        }

        return $res;
    }

    /**
     * @param $query
     * @param $nombre
     * @return mixed
     */
    public function scopeOfNombre($query, $nombre)
    {
        if(! empty($nombre) && $nombre != '')
        {
            return $query->where('nombre','LIKE',"%$nombre%");
        }
    }

    /**
     * @param $query
     * @param $prestamo
     * @return mixed
     */
    public function scopeOfPrestamo($query, $prestamo)
    {
        if(! empty($prestamo) && $prestamo != '')
        {
            return $query->where('estado_prestamo',$prestamo);
        }
    }

    /**
     * @param $query
     * @param $tags
     * @return mixed
     */
    public function scopeOfTags($query, $tags)
    {
        if(count($tags) > 0)
        {
            return $query->whereHas('tags', function($q) use($tags)
            {
                return $q->whereIn('tag_id',$tags);
            });
        }
    }

    /**
     * @param $query
     * @param $estado
     */
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

    public function scopeOfOrder($query, $order, $type)
    {
        if (empty($type)) {
            $type = "ASC";
        }

        if (!empty($order)) {
            return $query->orderBy($order, $type);
        }

    }

    public function scopeOfDescription($query, $desc)
    {
        if (!empty($desc)) {
            return $query->where('descripcion','like', "%$desc%");
        }
    }

    public function scopeOfInventario($query, $inv)
    {
        if (!empty($inv)) {
            return $query->where('inventario','like', "%$inv%");
        }
    }

    public static function obtenerTags($tags)
    {
        $res = array();

        foreach ($tags as $tag) {
            $res[] = $tag->pivot->tag_id;
        }

        return $res;
    }

    static public function cargarListaAdmin($request)
    {
        return Instrumento::with(['tags','prestamo'])
            ->ofNOmbre($request->nombre)
            ->ofTags($request->tags)
            ->ofPrestamo($request->prestamo)
            ->ofEstado($request->estado)
            ->ofDescription($request->descripcion)
            ->ofInventario($request->inventario)
            ->ofOrder($request->order, $request->order_type)
            ->paginate(12);
    }

    static public function cargarListaAlumno($request)
    {
        return Instrumento::with(['tags','prestamo'])
            ->ofNOmbre($request->nombre)
            ->ofTags($request->tags)
            ->ofPrestamo($request->prestamo)
            ->where('deleted_at', null)
            ->ofDescription($request->descripcion)
            ->ofInventario($request->inventario)
            ->ofOrder($request->order, $request->order_type)
            ->paginate(12);
    }

    static public function cargarLista($request)
    {
        if (auth()->check()) {
            if (auth()->user()->role != "alumno") {
                return self::cargarListaAdmin($request);
            }
        }

        return self::cargarListaAlumno($request);
    }

}

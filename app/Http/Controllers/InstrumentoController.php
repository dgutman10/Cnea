<?php

namespace App\Http\Controllers;

use App\Instrumento;
use App\Tag;
use File;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class InstrumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $instrumentos = Instrumento::with(['tags','prestamo'])
            ->ofNOmbre($request->nombre)
            ->ofTags($request->tags)
            ->ofPrestamo($request->prestamo)
            ->ofEstado($request->estado)
            ->paginate(12);

        $tags = Tag::lists('nombre','id');
        $usuarios = array_add(User::lists('name','id'),'','');
        return view('instrumentos.index',compact('instrumentos','tags','usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::lists('nombre','id');
        return view('instrumentos.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre'        => 'required|unique:instrumentos,nombre',
            'inventario'    => 'required|unique:instrumentos,inventario',
            'descripcion'   => 'string',
            'observaciones' => 'string',
            'img'           => 'required|image',
            'manual'        => ($request->file('manual'))? 'mimes:pdf,docx,pptx,pub,doc,ods,ppdf,ppt,odt,swd,txt,rtf,tif':''
        ]);

        $id = Instrumento::orderBy('id')->select('id')->get()->last()->id += 1;

        $img = $request->file('img');
        $image_url_save = '/Instrumentos/'.$id.'/img/img.'.$img->getClientOriginalExtension();

        $manual = $request->file('manual');
        $manual_url_save = '/Instrumentos/'.$id.'/manual/manual.'.$manual->getClientOriginalExtension();

        $instrumento = Instrumento::create([
            'nombre'            => $request->nombre,
            'inventario'        => $request->inventario,
            'img_url'           => $image_url_save,
            'manual_url'        => $manual_url_save,
            'descripcion'       => $request->descripcion,
            'observaciones'     => $request->observaciones,
            'estado'            => 'disponible'
        ]);

        $instrumento->save();

        Storage::put($image_url_save, File::get($img));
        Storage::put($manual_url_save, File::get($manual));

        $instrumento->tags()->attach($request->tags);

        Session::flash("message","Se han guardado los datos!");
        return redirect()->route('instrumentos.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instrumento = Instrumento::withTrashed()->findOrFail($id);
        return view('instrumentos.show', compact('instrumento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instrumento = Instrumento::with('tags')->findOrFail($id);
        $tags_instrumento = Instrumento::obtenerTags($instrumento->tags);
        $tags = Tag::lists('nombre','id');
        return view('instrumentos.edit', compact('instrumento','tags','tags_instrumento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $instrumento = Instrumento::find($id);

        $this->validate($request, [
            'nombre'        => 'required|unique:instrumentos,nombre,'.$id,
            'inventario'    => 'required|unique:instrumentos,inventario,'.$id,
            'descripcion'   => 'string',
            'observaciones' => 'string',
            'img'           => ($request->file('img'))? 'image':'',
            'manual'        => ($request->file('manual'))? 'mimes:pdf,docx,pptx,pub,doc,ods,ppdf,ppt,odt,swd,txt,rtf,tif':''
        ]);

        if($request->img)
        {
            $img = $request->file('img');
            $url_save = '/Instrumentos/'.$id.'/img/img.'.$img->getClientOriginalExtension();
            $instrumento->img_url = $url_save;
            Storage::put($url_save, File::get($img));
        }

        if($request->manual)
        {
            $manual = $request->file('manual');
            $url_save = '/Instrumentos/'.$id.'/manual/manual.'.$manual->getClientOriginalExtension();
            $instrumento->manual_url = $url_save;
            Storage::put($url_save, File::get($manual));
        }

        $instrumento->nombre = $request->nombre;
        $instrumento->inventario = $request->inventario;
        $instrumento->descripcion = $request->descripcion;
        $instrumento->observaciones = $request->observaciones;

        $instrumento->save();

        $instrumento->tags()->detach();
        $instrumento->tags()->attach($request->tags);

        Session::flash("message","Se han editado los datos!");
        return redirect()->route('instrumentos.show',$id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instrumento = Instrumento::findOrFail($id);
        $instrumento->delete();
        Session::flash('message','Se han eliminado los datos!');
        return redirect()->route('instrumentos.show', $instrumento->id);
    }

    public function restore($id)
    {
        Instrumento::withTrashed()->where('id',$id)->restore();
        Session::flash('message','Se han recuperado los datos!');
        return redirect()->route('instrumentos.show',$id);
    }
}

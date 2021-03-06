<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Instrumento;
use App\Laboratorio;
use App\Prestamo;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $prestamos = Prestamo::with(['usuarioPresta', 'usuarioRecibe', 'instrumento'])->ofEstado($request->get('estado'))->paginate();

        return view('prestamos.index', compact('prestamos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::lists('name','id');
        $laboratorios = Laboratorio::orderBy('nombre', 'asc')->lists('nombre','id');
        $cursos = Curso::orderBy('nombre', 'asc')->lists('nombre','id');
        $instrumentos = Instrumento::orderBy('nombre', 'asc')->where('estado_prestamo', 'disponible')->lists('nombre','id');

        return view('prestamos.create', compact('usuarios', 'laboratorios', 'cursos', 'instrumentos'));
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
            'usuario_presta'    => 'required',
            'usuario_recibe'    => 'required',
            'laboratorio_id'    => 'required',
            'curso_id'          => 'required',
            'instrumento_id'    => 'required',
            'telefono'          => 'required',
            'mail'             => 'required|email'
        ]);
        $instrumento = Instrumento::findOrFail($request->instrumento_id);
        $instrumento->estado_prestamo = 'prestado';
        $instrumento->save();

        Prestamo::create($request->all());
        return redirect()->route('prestamos.index', ['estado'=>'abierto']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prestamo = Prestamo::findOrFail($id);

        return view('prestamos.show', compact('prestamo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prestamo = Prestamo::findOrFail($id);
        $usuarios = User::lists('name','id');
        $laboratorios = Laboratorio::lists('nombre','id');
        $cursos = Curso::lists('nombre','id');
        $instrumentos = Instrumento::lists('nombre','id');


        return view('prestamos.edit', compact('prestamo', 'usuarios', 'laboratorios', 'cursos', 'instrumentos'));
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
        $prestamo = Prestamo::findOrFail($id);
        if(!isset($request->estado_prestamo)) {
            $this->validate($request, [
                'usuario_presta'    => 'required',
                'usuario_recibe'    => 'required',
                'laboratorio_id'    => 'required',
                'curso_id'          => 'required',
                'telefono'          => 'required',
                'mail'              => 'required|email'
            ]);
        } else {
            $instrumento = Instrumento::find($prestamo->instrumento_id);
            $instrumento->estado_prestamo = 'disponible';
            $instrumento->save();
        }


        $prestamo->update($request->all());

        return redirect()->route('prestamos.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

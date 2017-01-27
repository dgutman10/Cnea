<?php

namespace App\Http\Controllers;

use App\Curso;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cursos = Curso::with(['usuarios' =>function($q){
            $q->where('role','<>','admin');
            }])
            ->ofNombre($request->get('nombre'))
            ->orderBy('nombre')
            ->paginate(10);
        return view('cursos.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cursos.create');
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
            'nombre' => 'required|unique:cursos,nombre'
        ]);

        $curso = Curso::create($request->all());
        $curso->save();

        Session::flash("message","Se han guardado los datos!");
        return redirect()->route('cursos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = Curso::with(['usuarios' =>function($q){
            $q->where('role','<>','admin');
        }])->findOrFail($id);
        return view('cursos.show', compact('curso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curso = Curso::findOrFail($id);
        return view('cursos.edit', compact('curso'));
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
        $curso = Curso::findOrFail($id);

        $this->validate($request, [
            'nombre' => 'required|unique:cursos,nombre,'.$id
        ]);

        $curso->nombre = $request->nombre;
        $curso->save();

        Session::flash("message","Se han guardado los datos!");

        return redirect()->route('cursos.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->usuarios()->detach();
        $curso->delete();

        return redirect()->route('cursos.index');
    }
}

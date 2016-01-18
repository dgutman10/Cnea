<?php

namespace App\Http\Controllers;

use App\Laboratorio;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LaboratorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $laboratorios = Laboratorio::OfNombre($request->get('nombre'))
            ->paginate(10);
        return view('laboratorios.index', compact('laboratorios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laboratios.create');
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
            'nombre' => 'required|unique:laboratorios,nombre'
        ]);

        $laboratorio = Laboratorio::create($request->all());
        $laboratorio->save();
        Session::flash('message','Se han guardado los datos!');
        return redirect()->route('laboratorios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $laboratorio = Laboratorio::findOrFail($id);
        return view('laboratorios.show', compact('laboratorio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $laboratorio = Laboratorio::findOrFail($id);
        return view('laboratorios.edit', compact('laboratorio'));
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
        $laboratorio = Laboratorio::findOrFail($id);

        $this->validate($request, [
            'nombre' => 'required|unique:laboratorios,nombre,'.$id
        ]);

        $laboratorio->nombre = $request->nombre;
        $laboratorio->save();
        Session::flash('message','Se han eliminado los datos!');
        return redirect()->route('laboratorios.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $laboratorio = Laboratorio::findOrFail($id);
        $laboratorio->usuarios()->detach();
        $laboratorio->delete();
        Session::flash('message','Se han recuperado los datos!');
        return redirect()->route('laboratorios.index');
    }
}

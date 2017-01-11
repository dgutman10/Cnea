<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Laboratorio;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);

        $usuario_lab = User::obtenerLaboratorios($usuario->laboratorios);
        $usuario_cur = User::obtenerCursos($usuario->cursos);


        $laboratorios = Laboratorio::lists('nombre', 'id');
        $cursos = Curso::lists('nombre', 'id');

        return view('usuarios.perfil', compact(
            'usuario',
            'usuario_lab',
            'usuario_cur',
            'laboratorios',
            'cursos'
        ));
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
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => ($request->password) ? 'required|min:6|confirmed' : '',
            'telephone' => 'required',
        ]);


        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) $user->password = $request->password;
        $user->role = Auth::user()->role;
        $user->telephone = $request->telephone;
        $user->save();

        $user->laboratorios()->detach();
        $user->laboratorios()->attach($request->laboratorios);

        $user->cursos()->detach();
        $user->cursos()->attach($request->cursos);

        Session::flash('message','Los datos se actulizaron correctamente');
        return redirect()->route('perfil.edit', $user->id);
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

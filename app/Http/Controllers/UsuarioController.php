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

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuarios = User::ofName($request->get('name'))
            ->ofRoles($request->get('role'))
            ->ofCursos($request->get('curso'))
            ->ofLaboratorios($request->get('laboratorio'))
            ->ofEstado($request->estado)
            ->where('id','!=',Auth::user()->id)
            ->paginate(10);

        $cursos = Curso::lists('nombre', 'id');

        $laboratorios = Laboratorio::lists('nombre', 'id');
        return view('usuarios.index', compact('usuarios', 'cursos', 'laboratorios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cursos = Curso::lists('nombre','id');
        $laboratorios = Laboratorio::lists('nombre','id');
        return view('usuarios.create', compact('cursos','laboratorios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,profesor,alumno',
            'telephone' => 'required',
        ]);

        $user = User::create($request->all());

        $user->save();

        $user->laboratorios()->attach($request->laboratorios);

        $user->cursos()->attach($request->cursos);
        Session::flash('message','Se han guardado los datos!');
        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->id == $id)
        {
            return redirect()->route('perfil.edit',$id);
        }
        $usuario = User::with('cursos')
            ->with('laboratorios')
            ->withTrashed()
            ->findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->id == $id){
            return redirect()->route('perfil.edit',$id);
        }
        $usuario = User::findOrFail($id);

        if ($usuario->role == 'admin') {
            Session::flash("message","No puedes editar un usuario administrador!");
            return redirect()->back();
        }

        $usuario_lab = User::obtenerLaboratorios($usuario->laboratorios);
        $usuario_cur = User::obtenerCursos($usuario->cursos);


        $laboratorios = Laboratorio::lists('nombre', 'id');
        $cursos = Curso::lists('nombre', 'id');

        return view('usuarios.edit', compact(
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
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => ($request->password) ? 'required|min:6|confirmed' : '',
            'role' => 'required|in:admin,profesor,alumno',
            'telephone' => 'required',
        ]);


        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) $user->password = $request->password;
        $user->role = $request->role;
        $user->telephone = $request->telephone;
        $user->save();

        $user->laboratorios()->detach();
        $user->laboratorios()->attach($request->laboratorios);

        $user->cursos()->detach();
        $user->cursos()->attach($request->cursos);

        Session::flash("message","Se han editado los datos!");
        return redirect()->route('usuarios.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Session::flash('message','Se han eliminado los datos!');
        return redirect()->route('usuarios.show', $user->id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        User::withTrashed()->where('id',$id)->restore();
        Session::flash('message','Se han recuperado los datos!');
        return redirect()->route('usuarios.show',$id);
    }
}

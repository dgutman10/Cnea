@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li @if(Route::is('usuarios.show')) class="active" @endif>
                        <a href="{{ route('usuarios.show',$usuario) }}">Datos del Usuario</a>
                    </li>

                    @if($usuario->deleted_at == null)
                        <li @if(Route::is('usuarios.edit')) class="active" @endif>
                            <a href="{{ route('usuarios.edit',$usuario) }}">Editar Usuario</a>
                        </li>
                    @endif

                    @if(session()->get('index'))
                        <li>
                            <a href="{{ url(session()->get('index')) }}">Ir a la lista de Usuarios</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('usuarios.index') }}">Ir a la lista de Usuarios</a>
                        </li>
                    @endif
                </ul>
                <hr>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $usuario->name }}</div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            <dl>

                                <dt><span class="text-info">Nombre:</span></dt>
                                <dd>{{ $usuario->name }}</dd>

                                <dt><span class="text-info">Email:</span></dt>
                                <dd>{{ $usuario->email }}</dd>

                                <dt><span class="text-info">Teléfono:</span></dt>
                                <dd>{{ $usuario->telephone }}</dd>

                                <dt><span class="text-info">Permisos de Usuario:</span></dt>
                                <dd>{{ config('cnea.permisos_form')[$usuario->role] }}</dd>

                                <dt><span class="text-info">Fecha de Alta:</span></dt>
                                <dd>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $usuario->created_at)->format('d/m/Y') }}</dd>

                                @if($usuario->deleted_at == null)
                                    <dt><span class="text-info">Estado:</span></dt>
                                    <dd class="text-success"><strong>Activo</strong></dd>
                                @else
                                    <dt><span class="text-info">Estado:</span></dt>
                                    <dd><span class="text-danger"><strong>Inactivo</strong></span></dd>

                                    <dt><span class="text-info">Fecha de baja</span></dt>
                                    <dd>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $usuario->deleted_at)->format('d/m/Y') }}</dd>
                                @endif
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <p class="lead">
                                Cursando Actualmente:
                            </p>
                            @if(count($usuario->cursos) < 1)

                                <p class="text-danger">El usuario no se encuentra registrado en ningún Curso.</p>
                            @else
                                @foreach($usuario->cursos as $curso)
                                    <a class="label label-primary label-inline" href="{{ route('cursos.show',$curso->id) }}">{{ $curso->nombre }}</a>
                                @endforeach
                            @endif

                            <hr>

                            <p class="lead">
                                Pertenece a los Laboratorios:
                            </p>
                            @if(count($usuario->laboratorios) < 1)
                                <p class="text-danger">El usuario no se encuentra registrado en ningún Laboratorio</p>
                            @else
                                @foreach($usuario->laboratorios as $laboratorio)
                                    <a class="label label-primary label-inline" href="{{ route('cursos.show',$laboratorio->id) }}">{{ $laboratorio->nombre }}</a>
                                @endforeach
                            @endif

                            <hr>
                            @if($usuario->deleted_at == null)
                                {{ Form::open(['route'=>['usuarios.destroy',$usuario],'method'=>'delete']) }}
                                    {{ Form::submit('Eliminar Usuario',['class'=>'btn btn-danger pull-right']) }}
                                {{ Form::close() }}
                            @else
                                {{ Form::model($usuario,['route'=>['usuarios.restore',$usuario],'method'=>'post']) }}
                                    {{ Form::submit('Restaurar Usuario',['class'=>'btn btn-success pull-right']) }}
                                {{ Form::close() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
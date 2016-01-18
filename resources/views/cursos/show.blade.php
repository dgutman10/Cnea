@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">

                    <li @if(Route::is('cursos.show')) class="active" @endif>
                        <a href="{{ route('cursos.show',$curso) }}">Datos del Curso</a>
                    </li>

                    <li @if(Route::is('cursos.edit')) class="active" @endif>
                        <a href="{{ route('cursos.edit',$curso) }}">Editar Curso</a>
                    </li>

                    @if(session()->get('index'))
                        <li>
                            <a href="{{ url(session()->get('index')) }}">Ir a la lista de Cursos</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('cursos.index') }}">Ir a la lista de Cursos</a>
                        </li>
                    @endif

                </ul>
                <hr>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $curso->nombre }}</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <dl>

                                <dt><span class="text-info">Nombre:</span></dt>
                                <dd>{{ $curso->nombre }}</dd>

                                <dt><span class="text-info">Instrumentos asociados:</span></dt>
                                <dd>{{ count($curso->usuarios) }} en Total</dd>


                            </dl>
                            @if(Auth::check() and Auth::user()->role == 'admin')
                                {{ Form::open(['route'=>['cursos.destroy',$curso],'method'=>'delete']) }}
                                {{ Form::submit('Eliminar Curso',['class'=>'btn btn-danger']) }}
                                {{ Form::close() }}
                            @endif
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <h3 class="page-header">
                                Participantes
                            </h3>
                            @if(count($curso->usuarios) == 0)
                                <p class="text-danger">El Curso no tiene participantes asociados</p>
                            @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="lead">
                                            Profesores:
                                        </p>
                                        @foreach($curso->usuarios as $usuario)
                                            @if($usuario->role == 'profesor' )
                                                <label class="label label-primary label-inline">
                                                    {{ $usuario->name }}
                                                </label>
                                            @endif
                                        @endforeach
                                        <p class="lead">
                                            Alumnos:
                                        </p>
                                        @foreach($curso->usuarios as $usuario)
                                            @if($usuario->role == 'alumno' )
                                                <label class="label label-primary label-inline">
                                                    {{ $usuario->name }}
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
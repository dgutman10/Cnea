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
                        {{ Form::model($curso,['route'=>['cursos.update',$curso], 'method'=>'put']) }}
                        @include('cursos.partials.form')
                        {{ Form::close() }}
                    </div>
                </div><!-- Fin de panel-body -->
            </div>
        </div>
    </div>
@endsection
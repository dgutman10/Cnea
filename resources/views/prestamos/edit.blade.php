@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li @if(Route::is('prestamos.show')) class="active" @endif>
                        <a href="{{ route('prestamos.show',$prestamo) }}">Datos del prestamo</a>
                    </li>
                    <li @if(Route::is('prestamos.edit')) class="active" @endif>
                        <a href="{{ route('prestamos.edit',$prestamo) }}">Editar prestamo</a>
                    </li>

                    @if(session()->get('index'))
                        <li>
                            <a href="{{ url(session()->get('index')) }}">Ver todos los prestamos</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('prestamos.index') }}">Ver todos los prestamos</a>
                        </li>
                    @endif

                </ul>
                <hr>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $prestamo->instrumento->nombre }}</div>
                    <div class="panel-body">
                        {{ Form::model($prestamo,['route'=>['prestamos.update',$prestamo], 'method'=>'put']) }}
                        @include('prestamos.partials.form')
                        {{ Form::close() }}
                    </div>
                </div><!-- Fin de panel-body -->
            </div>
        </div>
    </div>
@endsection
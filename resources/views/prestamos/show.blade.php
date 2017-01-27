@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li @if(Route::is('prestamos.show')) class="active" @endif>
                        <a href="{{ route('prestamos.show',$prestamo) }}">Datos del Prestamo</a>
                    </li>
                    @if(Auth::check())
                        @if($prestamo->estado_prestamo == 'abierto')
                            <li @if(Route::is('prestamos.edit')) class="active" @endif>
                                <a href="{{ route('prestamos.edit',$prestamo) }}">Editar</a>
                            </li>
                        @endif
                    @endif

                    @if(session()->get('index'))
                        <li>
                            <a href="{{ url(session()->get('index')) }}">Ir a la lista de Prestamos</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('prestamos.index', ['estado'=>'abierto']) }}">Ver todos los prestamos</a>
                        </li>
                    @endif
                </ul>
                <hr>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $prestamo->instrumento->nombre }}</div>
                    <div class="panel-body">
                        <dl class="dl-horizontal">
                            <dt>Prestado por:</dt>
                            <dd>{{ $prestamo->usuarioPresta->name }}</dd>

                            <dt>Prestado a:</dt>
                            <dd> {{ $prestamo->usuarioRecibe->name }} </dd>

                            <dt>Laboratorio:</dt>
                            <dd> {{ $prestamo->laboratorio->nombre }} </dd>

                            <dt>Curso:</dt>
                            <dd> {{ $prestamo->curso->nombre }} </dd>

                            <dt>Teléfono de contacto:</dt>
                            <dd> {{ $prestamo->telefono }} </dd>

                            <dt>Mail de contacto:</dt>
                            <dd> <a target="_blank" href="mailto:{{ $prestamo->mail }}">{{ $prestamo->mail }}</a> </dd>

                            <dt>Fecha inicio:</dt>
                            <dd>{{ \Carbon\Carbon::parse($prestamo->created_at)->format("d/m/Y") }}</dd>

                            @if($prestamo->estado_prestamo == 'terminado')
                                <dt>Fecha de fin:</dt>
                                <dd>{{ $prestamo->updated_at }}</dd>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
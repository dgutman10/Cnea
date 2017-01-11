@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">

                    @if(session()->get('index'))
                        <li>
                            <a href="{{ url(session()->get('index')) }}">Ir a la lista de Laboratorios</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('laboratorios.index') }}">Ir a la lista de Laboratorios</a>
                        </li>
                    @endif

                </ul>
                <hr>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Nuevo Laboratorio</div>
                    <div class="panel-body">
                        {{ Form::open(['route'=>['laboratorios.store'], 'method'=>'post']) }}
                        @include('laboratorios.partials.form')
                        {{ Form::close() }}
                    </div>
                </div><!-- Fin de panel-body -->
            </div>
        </div>
    </div>
@endsection

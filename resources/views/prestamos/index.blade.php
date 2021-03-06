@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Buscador</div>

                    <div class="panel-body">
                        @include('prestamos/partials/search')
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Prestamos</div>

                    <div class="panel-body">
                        <div class="col-md-6">
                            <p class="text-info" style="margin-top: 6px;">Total de Prestamos Encontrados: {{ $prestamos->total() }}</p>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                            <a class="btn btn-primary btn-sm" href="{{ route('prestamos.create') }}"><i class="fa fa-share-alt"></i> Prestar un instrumento</a>
                        </div>
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <th>Instrumento</th>
                        <th>Recibió</th>
                        <th>Situación</th>
                        <th>Acciones</th>
                        </thead>
                        <tbody>
                        @foreach($prestamos as $prestamo)
                            <tr>
                                <td>{{ $prestamo->instrumento->nombre }}</td>
                                <td>{{ $prestamo->usuarioRecibe->name }}</td>
                                <td>{{ config('cnea.prestamo_estado')[$prestamo->estado_prestamo] }}</td>
                                <td>
                                    <a class="btn btn-default btn-xs" href="{{ route('prestamos.show',$prestamo) }}"><i class="fa fa-eye"></i> Ver</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $prestamos->appends(Request::only(['estado']))->render() }}
            </div>
        </div>
    </div>
    {{ session([
        'index' => url()->full()
       ])
    }}
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Buscador</div>

                    <div class="panel-body">
                        {{-- //@include('laboratorios/partials/search') --}}
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
                            <a class="btn btn-primary btn-sm" href="{{ route('prestamos.create') }}"><i class="fa fa-flask"> Nuevo Prestamo</i></a>
                        </div>
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <th>Nombre</th>
                        <th>Acciones</th>
                        </thead>
                        <tbody>
                        @foreach($prestamos as $prestamo)
                            <tr>
                                <td>{{ $prestamo->usuarioPresta->name }}</td>
                                <td>
                                    {{--<a class="btn btn-default btn-xs" href="{{ route('laboratorios.show',$laboratorio) }}"><i class="fa fa-eye"> Ver</i></a>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- $laboratorios->appends(Request::only(['nombre']))->render() --}}
            </div>
        </div>
    </div>
    {{ session([
        'index' => url()->full()
       ])
    }}
@endsection
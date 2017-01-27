@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Buscador</div>

                    <div class="panel-body">
                        @include('cursos/partials/search')
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Cursos</div>

                    <div class="panel-body">
                        <div class="col-md-6">
                            <p class="text-info" style="margin-top: 6px;">Total de Cursos Encontrados: {{ $cursos->total() }}</p>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                            <a class="btn btn-primary btn-sm" href="{{ route('cursos.create') }}"><i class="fa fa-graduation-cap"></i> Nuevo Curso</a>
                        </div>
                    </div>

                    <table class="table table-hover">
                        <thead>
                            <th>Nombre</th>
                            <th>Asistentes</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach($cursos as $curso)
                                <tr>
                                    <td>{{ $curso->nombre }}</td>
                                    <td title="@foreach($curso->usuarios as $usuario) {{ $usuario->name . ' ' }} @endforeach">{{ count($curso->usuarios) }}</td>
                                    <td>
                                        <a class="btn btn-default btn-xs" href="{{ route('cursos.show',$curso) }}"><i class="fa fa-eye"></i> Ver</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $cursos->appends(Request::only(['nombre']))->render() }}
            </div>
        </div>
    </div>
    {{ session([
        'index' => url()->full()
       ])
    }}
@endsection
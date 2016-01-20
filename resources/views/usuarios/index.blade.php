@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Buscador</div>

                    <div class="panel-body">
                        @include('usuarios/partials/search')
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Usuarios</div>

                    <div class="panel-body">
                        <div class="col-md-6">
                            <p class="text-info" style="margin-top: 6px;">Total de Usuarios Encontrados: {{ $usuarios->total() }}</p>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                            <a class="btn btn-primary btn-sm" href="{{ route('usuarios.create') }}"><i class="fa fa-user-plus"> Nuevo Usuario</i></a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <th>Nombre</th>
                            <th>Permisos</th>
                            <th>Actividad</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ config('cnea.permisos_form')[$usuario->role] }}</td>
                                    @if($usuario->deleted_at == null)
                                        <td>
                                            <span class="label label-success"> Activo</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="label label-danger"> Inactivo</span>
                                        </td>
                                    @endif
                                    <td>
                                        <a class="btn btn-default btn-xs" href="{{ route('usuarios.show',$usuario) }}"><i class="fa fa-eye"> Ver</i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                {{ $usuarios->appends(Request::only(['name','role','curso','laboratorio','estado']))->render() }}
            </div>
        </div>
    </div>
    {{ session([
        'index' => url()->full()
       ])
    }}
@endsection

@section('scripts')
    <script type="text/javascript">
        $('.select2').select2({
            placeholder: "Seleccione una opción",
            allowClear: true
        });
    </script>
@endsection
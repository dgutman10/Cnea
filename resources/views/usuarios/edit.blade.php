@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li @if(Route::is('usuarios.show')) class="active" @endif>
                        <a href="{{ route('usuarios.show',$usuario) }}">Datos del Usuario</a>
                    </li>
                    <li @if(Route::is('usuarios.edit')) class="active" @endif>
                        <a href="{{ route('usuarios.edit',$usuario) }}">Editar Usuario</a>
                    </li>

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
                        {{ Form::model($usuario,['route'=>['usuarios.update',$usuario], 'method'=>'put']) }}
                        @include('usuarios.partials.form')
                        {{ Form::close() }}
                    </div>
                </div><!-- Fin de panel-body -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('.select2').select2({
            placeholder: "Seleccione una opción",
            allowClear: true
        });
    </script>
@endsection
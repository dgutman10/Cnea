@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $usuario->name }}</div>
                    <div class="panel-body">
                        {{ Form::model($usuario,['route'=>['perfil.update',$usuario], 'method'=>'put']) }}
                        @include('usuarios.partials.form')
                        {{ Form::close() }}
                    </div>
                </div><!-- Fin de panel -->
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
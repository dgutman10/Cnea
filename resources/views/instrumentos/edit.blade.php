@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li @if(Route::is('usuarios.show')) class="active" @endif>
                        <a href="{{ route('instrumentos.show',$instrumento) }}">Datos del Instrumento</a>
                    </li>
                    <li @if(Route::is('instrumentos.edit')) class="active" @endif>
                        <a href="{{ route('instrumentos.edit',$instrumento) }}">Editar Instrumento</a>
                    </li>

                    @if(session()->get('index'))
                        <li>
                            <a href="{{ url(session()->get('index')) }}">Ir a la lista de Instrumentos</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('instrumentos.index') }}">Ir a la lista de Instrumentos</a>
                        </li>
                    @endif

                </ul>
                <hr>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $instrumento->nombre }}</div>
                    <div class="panel-body">
                        {{ Form::model($instrumento,['route'=>['instrumentos.update',$instrumento], 'method'=>'put', 'files'=>true]) }}
                        @include('instrumentos.partials.form')
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

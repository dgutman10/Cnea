@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">

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
                    <div class="panel-heading">Prestar instrumento</div>
                    <div class="panel-body">
                        {{ Form::open(['route'=>['prestamos.store'], 'method'=>'post']) }}
                        @include('prestamos.partials.form')
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

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li @if(Route::is('instrumentos.show')) class="active" @endif>
                        <a href="{{ route('instrumentos.show',$instrumento) }}">Datos del Instrumento</a>
                    </li>
                    @if(Auth::check())
                        @if($instrumento->deleted_at == null)
                            <li @if(Route::is('instrumentos.edit')) class="active" @endif>
                                <a href="{{ route('instrumentos.edit',$instrumento) }}">Editar Instrumento</a>
                            </li>
                        @endif
                    @endif

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
                            <div class="row">
                                <div class="col-md-6">
                                    <img class="img-responsive thumbnail" src="{{ $instrumento->img_url }}" alt="{{ $instrumento->nombre }}"/>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="lead"><a href="{{ route('instrumentos.show',$instrumento) }}">{{ $instrumento->nombre }}</a></h5>
                                    <div class="row">

                                        <div class="col-md-12">
                                            <dl>
                                                <dt>Nro. Inventario:</dt>
                                                <dd>#{{ $instrumento->inventario }}</dd>
                                                @if($instrumento->estado_prestamo == 'prestado')
                                                    <dt>Situación de prestamo:</dt>
                                                    <dd><span class="label label-danger">Prestado</span></dd>
                                                @else
                                                    <dt>Situación de prestamo:</dt>
                                                    <dd><span class="label label-success">Instrumento Disponible</span></dd>
                                                @endif
                                                @if($instrumento->deleted_at == null)
                                                    <dt>Estado del Instrumento:</dt>
                                                    <dd><span class="label label-success">Activo</span></dd>
                                                @else
                                                    <dt>Estado del Instrumento:</dt>
                                                    <dd><span class="label label-danger">Dado de Baja</span></dd>
                                                    <dt>Fecha de la baja:</dt>
                                                    <dd>{{ $instrumento->deleted_at }}</dd>
                                                @endif
                                            </dl>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <dl>
                                                <dt>Tags relacionados:</dt>
                                                <dd>
                                                    @foreach($instrumento->tags as $tag)
                                                        <span class="label label-primary">{{ $tag->nombre }}</span>
                                                    @endforeach
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="lead">Descripción</p>
                                    <p>
                                        {{ $instrumento->descripcion }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="lead">Observaciones</p>
                                    <p>{{ $instrumento->observaciones }}</p>
                                    <div class="text-center">
                                        <p>Codigo QR:</p>
                                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate(Request::fullUrl())) !!} ">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @if(Auth::check() and Auth::user()->role == 'admin')
                                @if($instrumento->deleted_at == null)
                                    {{ Form::open(['route'=>['instrumentos.destroy',$instrumento],'method'=>'delete']) }}
                                        {{ Form::submit('Eliminar Instrumento',['class'=>'btn btn-danger pull-right']) }}
                                    {{ Form::close() }}
                                @else
                                    {{ Form::open(['route'=>['instrumentos.restore',$instrumento],'method'=>'post']) }}
                                        {{ Form::submit('Restaurar Instrumento',['class'=>'btn btn-success pull-right']) }}
                                    {{ Form::close() }}
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
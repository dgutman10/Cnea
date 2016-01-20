@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">

                    <li @if(Route::is('tags.show')) class="active" @endif>
                        <a href="{{ route('tags.show',$tag) }}">Datos del Tag</a>
                    </li>

                    @if(Auth::check())
                    <li @if(Route::is('tags.edit')) class="active" @endif>
                        <a href="{{ route('tags.edit',$tag) }}">Editar Tag</a>
                    </li>
                    @endif

                    @if(session()->get('index'))
                        <li>
                            <a href="{{ url(session()->get('index')) }}">Ir a la lista de Tags</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('tags.index') }}">Ir a la lista de Tags</a>
                        </li>
                    @endif

                </ul>
                <hr>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $tag->nombre }}</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <dl>

                                <dt><span class="text-info">Nombre:</span></dt>
                                <dd>{{ $tag->nombre }}</dd>

                                <dt><span class="text-info">Instrumentos asociados:</span></dt>
                                <dd>{{ count($tag->instrumentos) }} en Total</dd>


                            </dl>
                            @if(Auth::check() and Auth::user()->role == 'admin')
                                {{ Form::open(['route'=>['tags.destroy',$tag],'method'=>'delete']) }}
                                {{ Form::submit('Eliminar Tag',['class'=>'btn btn-danger']) }}
                                {{ Form::close() }}
                            @endif
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <p class="lead">
                                Lista de Instrumentos
                            </p>
                            @if(count($tag->Instrumentos) < 1)
                                <p class="text-danger">El Tag no tiene Instrumentos asociados</p>
                            @else
                                <div class="row">
                                    @foreach($tag->instrumentos as $instrumento)
                                        <div class="col-md-4">
                                            <a style="text-decoration: none;" href="{{ route('instrumentos.show',$instrumento->id) }}">
                                                <div class="thumbnail">
                                                    <img src="{{ $instrumento->img_url }}" alt="{{ $instrumento->nombre }}" />
                                                    <div class="caption">
                                                        <h4 style="text-align: center;" class="text-primary">{{ $instrumento->nombre }}</h4>
                                                        <p style="overflow-y: auto; word-wrap: break-word; height: 100px;">{{ str_limit($instrumento->descripcion,140,'...') }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
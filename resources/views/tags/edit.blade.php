@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li @if(Route::is('tag.show')) class="active" @endif>
                        <a href="{{ route('tags.show',$tag) }}">Datos del Tag</a>
                    </li>
                    <li @if(Route::is('tag.edit')) class="active" @endif>
                        <a href="{{ route('tags.edit',$tag) }}">Editar Tag</a>
                    </li>

                    @if(session()->get('index'))
                        <li>
                            <a href="{{ url(session()->get('index')) }}">Ir a la lista de Tags</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('tag.index') }}">Ir a la lista de Tags</a>
                        </li>
                    @endif

                </ul>
                <hr>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $tag->nombre }}</div>
                    <div class="panel-body">
                        {{ Form::model($tag,['route'=>['tags.update',$tag], 'method'=>'put']) }}
                        @include('tags.partials.form')
                        {{ Form::close() }}
                    </div>
                </div><!-- Fin de panel-body -->
            </div>
        </div>
    </div>
@endsection
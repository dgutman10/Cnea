@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">

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
                    <div class="panel-heading">Nuevo Tag</div>
                    <div class="panel-body">
                        {{ Form::open(['route'=>['tags.store'], 'method'=>'post']) }}
                        @include('tags.partials.form')
                        {{ Form::close() }}
                    </div>
                </div><!-- Fin de panel-body -->
            </div>
        </div>
    </div>
@endsection

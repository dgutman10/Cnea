@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Buscador</div>

                    <div class="panel-body">
                        @include('instrumentos/partials/search')
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Instrumentos</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-info" style="margin-top: 6px;">Total de Instrumentos Encontrados: {{ $instrumentos->total() }}</p>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                @if(Auth::check())
                                    <a class="btn btn-primary btn-sm" href="{{ route('instrumentos.create') }}"><i class="fa fa-compass"></i> Nuevo Instrumento</a>
                                @endif
                            </div>
                        </div>

                        <br>

                        @foreach($instrumentos as $instrumento)
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-responsive img-rounded thumbnail" style="margin-top: 14px;" src="{!! $instrumento->img_url !!}" alt="{{ $instrumento->nombre }}"/>
                                </div>
                                <div class="col-md-9">
                                    <h4><a style="text-decoration: none;" href="{{ route('instrumentos.show',$instrumento) }}">{{ $instrumento->nombre }}</a></h4>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <dl>
                                                <dt>Nro. Inventario:</dt>
                                                <dd>#{{ $instrumento->inventario }}</dd>
                                                @if($instrumento->estado_prestamo == 'prestado')
                                                    <dt>Situación de prestamo:</dt>
                                                    <dd><span class="label label-danger"><b>Prestado por</b> {{ $instrumento->prestamo->last()->usuarioPresta->name }} ---> {{ $instrumento->prestamo->last()->usuarioRecibe->name }}  </span></dd>
                                                @else
                                                    <dt>Situación de prestamo:</dt>
                                                    <dd><span class="label label-success">Instrumento Disponible</span></dd>
                                                @endif
                                                @if($instrumento->deleted_at == null)
                                                    <dt>Estado del Instrumento:</dt>
                                                    <dd><span class="label label-success">En funcionamiento</span></dd>
                                                @else
                                                    <dt>Estado del Instrumento:</dt>
                                                    <dd><span class="label label-danger">Dado de Baja</span></dd>
                                                    <dt>Fecha de la baja:</dt>
                                                    <dd>{{ $instrumento->deleted_at }}</dd>
                                                @endif
                                            </dl>
                                        </div>

                                        <div class="col-md-6">
                                            <dl>
                                                <dt>Descripcion:</dt>
                                                <dd style="word-wrap: break-word">{{ str_limit($instrumento->descripcion,140,'...') }}</dd>
                                            </dl>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <dl>
                                                <dt>Tags relacionados:</dt>
                                                <dd>
                                                    @foreach($instrumento->tags as $tag)
                                                        <a style="text-decoration: none" href="{{ route('tags.show',$tag) }}"><span class="label label-primary">{{ $tag->nombre }}</span></a>
                                                    @endforeach
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr style="box-shadow: 1px 1px 3px silver;">
                        @endforeach
                    </div>

                </div>
                {{ $instrumentos->appends(Request::only(['nombre','estado','tags','prestamo']))->render() }}
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
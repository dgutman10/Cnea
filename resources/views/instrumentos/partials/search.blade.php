{{ Form::open(['route'=>['instrumentos.index'], 'method'=>'get']) }}
<div class="form-group">
    {{ Form::label('nombre','Nombre') }}
    {{ Form::text('nombre',Request::input('nombre'), ['class'=>'form-control input-sm', 'placeholder'=>'Escriba un Nombre']) }}
</div>

<div class="form-group">
    {{ Form::label('tags[]','Buscar por Tags') }}
    {{ Form::select('tags[]',$tags,Request::input('tags'), ['class'=>'form-control input-sm select2','multiple'=>true]) }}
</div>

@if(auth()->check())
    @if(auth()->user()->role != 'alumno')
        <div class="form-group">
            {{ Form::label('estado','Estado del instrumento') }}
            {{ Form::select('estado',config('cnea.tipo_estados'),Request::input('estado'), ['class'=>'form-control input-sm select2']) }}
        </div>
    @endif
@endif
<div class="form-group">
    {{ Form::label('prestamo','Situación de prestamo') }}
    {{ Form::select('prestamo',config('cnea.prestamo'),Request::input('prestamo'), ['class'=>'form-control input-sm select2']) }}
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success btn-block">Realizar Búsqueda</button>
</div>
{{ Form::close() }}
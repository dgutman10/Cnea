{{ Form::open(['route'=>['tags.index'], 'method'=>'get']) }}
<div class="form-group">
    {{ Form::label('nombre','Nombre') }}
    {{ Form::text('nombre',Request::input('nombre'), ['class'=>'form-control input-sm', 'placeholder'=>'Escriba un Nombre']) }}
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success btn-block">Realizar Búsqueda</button>
</div>
{{ Form::close() }}
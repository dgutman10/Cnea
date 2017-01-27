{{ Form::open(['route'=>['prestamos.index'], 'method'=>'get']) }}

<div class="form-group">
    {{ Form::label('estado','Estado de prestamo') }}
    {{ Form::select('estado',config('cnea.prestamo_estado'),Request::input('estado'), ['class'=>'form-control input-sm']) }}
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success btn-block">Realizar Búsqueda</button>
</div>
{{ Form::close() }}
{{ Form::open(['route'=>['usuarios.index'], 'method'=>'get']) }}
<div class="form-group">
    {{ Form::label('name','Nombre') }}
    {{ Form::text('name',Request::input('name'), ['class'=>'form-control input-sm', 'placeholder'=>'Escriba un Nombre']) }}
</div>
<div class="form-group">
    {{ Form::label('role[]','Permisos') }}
    {{ Form::select('role[]',config('cnea.permisos_search'),Request::input('role'), ['class'=>'form-control input-sm select2', 'multiple'=>true]) }}
</div>
<div class="form-group">
    {{ Form::label('curso[]','Pertenece al Curso') }}
    {{ Form::select('curso[]',$cursos,Request::input('curso'), ['class'=>'form-control input-sm select2','multiple'=>true]) }}
</div>
<div class="form-group">
    {{ Form::label('laboratorio[]','Pertenece al Laboratorio') }}
    {{ Form::select('laboratorio[]',$laboratorios,Request::input('laboratorio'), ['class'=>'form-control input-sm select2','multiple'=>true]) }}
</div>
<div class="form-group">
    {{ Form::label('estado','Estado del Usuario') }}
    {{ Form::select('estado',config('cnea.tipo_estados'),Request::input('estado'), ['class'=>'form-control input-sm select2']) }}
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success btn-block">Realizar Búsqueda</button>
</div>
{{ Form::close() }}
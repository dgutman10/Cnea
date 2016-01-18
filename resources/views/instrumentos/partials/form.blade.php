<div class="col-md-6">
    <div class="form-group">
        {{ Form::label('nombre','Nombre') }}
        {{ Form::text('nombre', null, ['class'=>'form-control input-sm']) }}
    </div>
    <div class="form-group">
        {{ Form::label('inventario','Nro. de Inventario') }}
        {{ Form::text('inventario', null, ['class'=>'form-control input-sm']) }}
    </div>
    <div class="form-group">
        {{ Form::label('img','Seleccione una imagen') }}
        {{ Form::file('img') }}
    </div>
    <div class="form-group">
        {{ Form::label('tags[]','Tags') }}
        {{ Form::select('tags[]',$tags, (isset($tags_instrumento))? $tags_instrumento : null, ['class'=>'form-control input-sm select2', 'multiple' => true]) }}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        {{ Form::label('descripcion','Descripción') }}
        {{ Form::textarea('descripcion', null, ['class'=>'form-control input-sm','rows'=>5]) }}
    </div>
    <div class="form-group">
        {{ Form::label('observaciones','Observaciones') }}
        {{ Form::textarea('observaciones', null, ['class'=>'form-control input-sm','rows'=>5]) }}
    </div>
    @if(count($errors) > 0)
        <h3>Hay algunos errores!</h3>
        <div class="row">
            <div class="col-md-12">
                <ul class="list-unstyled">
                    @foreach($errors->all() as $error)
                        <li><i class="fa fa-dot-circle-o"> <span class="text-danger">{{ $error }}</span></i></li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
<div class="col-md-12">
    <div class="form-group">
        {{ Form::submit((route::is('instrumentos.edit'))? 'Guardar Cambios':'Crear Instrumento', ['class'=>'btn btn-success']) }}
    </div>
</div>
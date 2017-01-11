<div class="col-md-6">
    <div class="form-group">
        {{ Form::label('nombre','Nombre') }}
        {{ Form::text('nombre', null, ['class'=>'form-control input-sm']) }}
    </div>

</div>
<div class="col-md-6">
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
        {{ Form::submit((route::is('tags.edit'))? 'Guardar Cambios':'Crear Tag', ['class'=>'btn btn-success']) }}
    </div>
</div>
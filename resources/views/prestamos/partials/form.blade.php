<div class="col-md-6">
    <div class="form-group">
        {{ Form::hidden('usuario_presta',(isset($prestamo->usuario_presta))? $prestamo->usuario_presta : Auth::user()->id) }}
    </div>
    <div class="form-group">
        {{ Form::label('usuario_recibe','Prestado a:') }}
        {{ Form::select('usuario_recibe',$usuarios, (isset($prestamo->usuario_recibe))? $prestamo->usuario_recibe : null, ['class'=>'form-control input-sm select2', 'placeholder'=>'Seleccione']) }}
    </div>
    <div class="form-group">
        {{ Form::label('laboratorio_id','Laboratorio:') }}
        {{ Form::select('laboratorio_id',$laboratorios, (isset($prestamo->laboratorio_id))? $prestamo->laboratorio_id : null, ['class'=>'form-control input-sm select2', 'placeholder'=>'Seleccione']) }}
    </div>
    <div class="form-group">
        {{ Form::label('curso_id','Curso:') }}
        {{ Form::select('curso_id',$cursos, (isset($prestamo->curso_id))? $prestamo->curso_id : null, ['class'=>'form-control input-sm select2', 'placeholder'=>'Seleccione']) }}
    </div>
    @if(!isset($prestamo))
        <div class="form-group">
            {{ Form::label('instrumento_id','Instrumento:') }}
            {{ Form::select('instrumento_id',$instrumentos, (isset($prestamo->instrumento_id))? $prestamo->instrumento_id : null, ['class'=>'form-control input-sm select2', 'placeholder'=>'Seleccione']) }}
        </div>
    @endif
    <div class="form-group">
        {{ Form::label('telefono','Teléfono:') }}
        {{ Form::text('telefono',(isset($prestamo->telefono))? $prestamo->telefono : null, ['class'=>'form-control input-sm']) }}
    </div>
    <div class="form-group">
        {{ Form::label('mail','Mail:') }}
        {{ Form::text('mail',(isset($prestamo->mail))? $prestamo->mail : null,['class'=>'form-control input-sm']) }}
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
        {{ Form::submit((route::is('prestamos.edit'))? 'Guardar Cambios':'Crear Instrumento', ['class'=>'btn btn-success']) }}
    </div>
</div>
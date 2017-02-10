<div class="col-md-6">
    <div class="form-group">
        {{ Form::label('name','Nombre Completo') }}
        {{ Form::text('name', null, ['class'=>'form-control input-sm']) }}
    </div>
    <div class="form-group">
        {{ Form::label('email','Email') }}
        {{ Form::email('email', null, ['class'=>'form-control input-sm']) }}
    </div>
    <div class="form-group">
        {{ Form::label('telephone','Teléfono') }}
        {{ Form::text('telephone', null, ['class'=>'form-control input-sm']) }}
    </div>

    <div class="well well-sm">
        <div class="form-group">
            {{ Form::label('password','Contraseña') }}
            {{ Form::password('password', ['class'=>'form-control input-sm']) }}
        </div>
        <div class="form-group">
            {{ Form::label('password_confirmation','Confirme Contraseña') }}
            {{ Form::password('password_confirmation', ['class'=>'form-control input-sm']) }}
            @if(route::is('usuarios.edit') OR route::is('perfil.edit'))<span class="help-block">Modifique estos campos solo si desea cambiar la contraseña</span>@endif
        </div>
    </div>
</div>
<div class="col-md-6">

    @if(Auth::user()->role == 'admin' && !Route::is('perfil.*'))
    <div class="form-group">
        {{ Form::label('role','Selecciones Permisos') }}
        {{ Form::select('role', config('cnea.permisos_form'),null, ['class'=>'form-control input-sm select2']) }}
    </div>
    @endif

    <div class="form-group">
        {{ Form::label('cursos[]','Pertenece a los Cursos') }}
        {{ Form::select('cursos[]', $cursos, (isset($usuario_cur))? $usuario_cur : null, ['class'=>'form-control input-sm select2', 'multiple'=>true]) }}
    </div>
    <div class="form-group">
        {{ Form::label('laboratorios[]','Pertenece a los Laboratorios') }}
        {{ Form::select('laboratorios[]', $laboratorios, (isset($usuario_lab))? $usuario_lab : null, ['class'=>'form-control input-sm select2', 'multiple'=>true]) }}
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
        {{ Form::submit((route::is('usuarios.edit') OR route::is('perfil.edit'))? 'Guardar Cambios':'Crear Usuario', ['class'=>'btn btn-success']) }}
    </div>
</div>
<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::get('/', function(){
        return redirect()->route('instrumentos.index');
    });
    Route::resource('/instrumentos','InstrumentoController',['only'=>['index','show']]);
    Route::resource('/tags','TagController',['only'=>['index','show']]);
});

Route::group(['middleware' => ['web','auth']], function () {

    Route::post('/usuarios/restore/{id}', ['as'=>'usuarios.restore', 'uses'=>'UsuarioController@restore']);
    Route::post('/instrumentos/restore/{id}', ['as'=>'instrumentos.restore', 'uses'=>'InstrumentoController@restore']);
    Route::resource('/perfil','PerfilController',['only'=>['edit','update']]);
    Route::resource('/usuarios', 'UsuarioController');
    Route::resource('/tags','TagController',['except'=>['index','show']]);
    Route::resource('/instrumentos','InstrumentoController',['except'=>['index','show']]);
    Route::resource('/cursos','CursoController');
    Route::resource('/laboratorios','LaboratorioController');
    Route::resource('/prestamos','PrestamoController');

});

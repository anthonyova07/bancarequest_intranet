<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Contiene las rutas para la autenticacion
Auth::routes();

//Esta corresponde con los usuarios que han iniciado sesion 
Route::get('/home', 'HomeController@index');
Route::get('/seleccionar/requerimiento/{id}', 'HomeController@selectRequirement');

//Crea la ruta de crear solicitudes

Route::get('/reportar', 'IncidentController@create');
Route::post('/reportar', 'IncidentController@store');

Route::get('/ver/{id}', 'IncidentController@show');


//Este grupo de rutas solo le brinda acceso a los usuarios con el rol de ADMIN
Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function () {
    //Usuarios
    Route::get('/usuarios', 'UserController@index');
    Route::post('/usuarios', 'UserController@store');

    Route::get('/usuario/{id}', 'UserController@edit');
    Route::post('/usuario/{id}', 'UserController@update');

    Route::get('/usuario/{id}/eliminar', 'UserController@delete');

    //Requerimientos
    Route::get('/requerimientos', 'ProjectController@index');
    Route::post('/requerimientos', 'ProjectController@store');

    Route::get('/requerimiento/{id}', 'ProjectController@edit');
    Route::post('/requerimiento/{id}', 'ProjectController@update');

    Route::get('/requerimiento/{id}/eliminar', 'ProjectController@delete');
    Route::get('/requerimiento/{id}/restaurar', 'ProjectController@restore');
    

    //Categorias
    Route::post('/categorias', 'CategoryController@store');    
    Route::post('/categoria/editar', 'CategoryController@update');
    Route::get('/categoria/{id}/eliminar', 'CategoryController@delete');
    
    //Niveles
    Route::post('/niveles', 'LevelController@store');
    Route::post('/nivel/editar', 'LevelController@update');
    Route::get('/nivel/{id}/eliminar', 'LevelController@delete');

    //Requirement-User
    Route::post('/requerimiento-usuario', 'RequirementUserController@store');
    Route::get('/requerimiento-usuario/{id}/eliminar', 'RequirementUserController@delete');

    Route::get('/config', 'ConfigController@index');
});
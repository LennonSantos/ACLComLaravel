<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::auth();

Auth::routes();

Route::group(['middleware' => ['auth']], function() {


	Route::get('/', function () {

	    return view('welcome');

	});

	Route::get('/home', 'HomeController@index');

	Route::resource('users','UserController');	

	Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
	Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
	Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
	Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);
	Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
	Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);
	
	Route::get('manage-bloco',['as'=>'bloco.index','uses'=>'BlocoController@managebloco','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('bloco',['uses'=>'BlocoController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('bloco/create',['uses'=>'BlocoController@create','middleware' => ['permission:role-create']]);
	Route::post('bloco/create',['uses'=>'BlocoController@store','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('bloco/{id}',['uses'=>'BlocoController@show']);
	Route::get('bloco/{id}/edit',['uses'=>'BlocoController@edit','middleware' => ['permission:role-edit']]);
	Route::put('bloco/{id}',['uses'=>'BlocoController@update','middleware' => ['permission:role-edit']]);
	Route::delete('bloco/{id}',['uses'=>'BlocoController@destroy','middleware' => ['permission:role-delete']]);

	Route::get('manage-unidade',['as'=>'unidade.index','uses'=>'UnidadeController@manageunidade','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('unidade',['uses'=>'UnidadeController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('unidade/create',['uses'=>'UnidadeController@create','middleware' => ['permission:role-create']]);
	Route::post('unidade/create',['uses'=>'UnidadeController@store','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('unidade/{id}',['uses'=>'UnidadeController@show']);
	Route::get('unidade/{id}/edit',['uses'=>'UnidadeController@edit','middleware' => ['permission:role-edit']]);
	Route::put('unidade/{id}',['uses'=>'UnidadeController@update','middleware' => ['permission:role-edit']]);
	Route::delete('unidade/{id}',['uses'=>'UnidadeController@destroy','middleware' => ['permission:role-delete']]);


});



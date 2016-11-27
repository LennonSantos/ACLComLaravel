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

	Route::get('manage-bloco', 'BlocoController@manageBloco');
	//Route::resource('bloco','BlocoController');
	Route::resource('users','UserController');
	//Route::resource('roles','RoleController');
	

	Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
	Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
	Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
	Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);
	Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
	Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);

	Route::get('bloco',['as'=>'bloco.index','uses'=>'BlocoController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('bloco/create',['as'=>'bloco.create','uses'=>'BlocoController@create','middleware' => ['permission:role-create']]);
	Route::post('bloco/create',['as'=>'bloco.index','uses'=>'BlocoController@store','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('bloco/{id}',['as'=>'bloco.show','uses'=>'BlocoController@show']);
	Route::get('bloco/{id}/edit',['as'=>'bloco.edit','uses'=>'BlocoController@edit','middleware' => ['permission:role-edit']]);
	Route::patch('bloco/{id}',['as'=>'bloco.update','uses'=>'BlocoController@update','middleware' => ['permission:role-edit']]);
	Route::delete('bloco/{id}',['as'=>'bloco.destroy','uses'=>'BlocoController@destroy','middleware' => ['permission:role-delete']]);

});



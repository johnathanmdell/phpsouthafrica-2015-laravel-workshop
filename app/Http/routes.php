<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'auth'], function() {
    # Default Route
    Route::get('/', function () {
        return redirect()->route('tasks.index');
    });

    # General task routes
    Route::get('/tasks', ['as' => 'tasks.index', 'uses' => 'TasksController@index']);
    Route::post('/tasks', ['as' => 'tasks.store', 'uses' => 'TasksController@store']);

    # Authorised routes
    Route::group(['middleware' => 'owner'], function() {
        Route::get('/tasks/{task}', ['as' => 'tasks.show', 'uses' => 'TasksController@show']);
        Route::get('/tasks/{task}/edit', ['as' => 'tasks.edit', 'uses' => 'TasksController@edit']);
        Route::get('/tasks/{task}/delete', ['as' => 'tasks.destroy', 'uses' => 'TasksController@destroy']);
        Route::get('/tasks/{task}/mark', ['as' => 'tasks.mark', 'uses' => 'TasksController@mark']);
        Route::post('/tasks/{task}', ['as' => 'tasks.update', 'uses' => 'TasksController@update']);
    });

    # Authentication routes
    Route::get('auth/logout', 'Auth\AuthController@getLogout');
});

Route::group(['middleware' => 'guest'], function() {
    # Authentication routes
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');

    # Registration routes
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');
});
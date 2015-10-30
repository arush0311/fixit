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


Route::get('login', 'clientController@login');
Route::post('login', 'clientController@authenticate');
Route::group(array('before' => 'loginsession'), function()
{
	Route::get('/', 'clientController@index');
	Route::get('home', 'clientController@home');
	Route::post('logout','clientController@logout');
	Route::post('add','clientController@add');
	Route::post('reset','clientController@reset');

	
});

Route::filter('loginsession', function()
{
    if(!Session::has('c_id'))
    {
        return Redirect::to('login');
    }
});


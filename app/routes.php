<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::resource('sessions','sessioncontroller');
Route::get('logout','sessioncontroller@destroy');
Route::resource('users','usercontroller');
Route::resource('materials','materialcontroller');
Route::resource('categories','categoriecontroller');
Route::get('/beheer', 'HomeCOntroller@beheer');

Route::get('/', function()
{
	return View::make('index');

});

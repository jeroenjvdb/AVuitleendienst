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

Route::get('/', function()
{
	return View::make('index');

});
Route::resource('sessions','sessioncontroller');
Route::group(array('before' => 'auth'),function(){
	Route::get('logout','sessioncontroller@destroy');
	Route::resource('users','usercontroller');
	Route::resource('materials','materialcontroller');
	Route::resource('categories','categoriecontroller');
	Route::resource('reservations','reservationcontroller');
	Route::resource('messages','messagecontroller');
	
	Route::get('/materials/{id}/cal', 'materialcontroller@calNext');
	Route::get('/reservations/create/{date}/{hour}/{materialId}', ['as' => 'reservation.create', 'uses' => 'reservationcontroller@create']);
	Route::get('/mail/check','messagecontroller@sendMails');	
	Route::get('/uitchecken', 'materialcontroller@checkOut');
	Route::get('/inchecken', 'materialcontroller@checkIn');


	Route::post('/uitcheckenMateriaal', 'materialcontroller@checkOutMaterial');
	Route::post('/incheckenMateriaal', 'materialcontroller@checkInMaterial');
	Route::post('/opmerking', 'materialcontroller@storeMessage');
	
	Route::group(array('before' => 'admin'),function(){
		Route::get('/logbook','materialcontroller@getLogbook');
		Route::get('/logbook/{id}','materialcontroller@getReservations');
		Route::post('/logbook/search','materialcontroller@filterLogbook');

		Route::get('/users/{id}/delete', 'usercontroller@destroy');
		Route::get('/beheer', 'HomeController@beheer');
		Route::get('/beheer/materiaal', 'HomeController@beheerMateriaal');
		Route::get('/beheer/gebruikers', 'HomeController@beheerGebruikers');
	});
});

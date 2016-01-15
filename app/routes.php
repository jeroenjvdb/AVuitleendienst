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

Route::group(array('before' => 'guest'), function()
{
	Route::get('/', 'HomeController@login');
	Route::get('/login', ['as' => 'login', 'uses' => 'HomeController@getlogin']);
});


Route::group(array('before' => 'baseLaptop'), function()
{
	Route::get('/card/login', ['as' => 'cardLogin', 'uses' => 'CardController@getLogin']);
	Route::post('/card/login', ['uses' => 'CardController@login']);
});

Route::resource('sessions','sessioncontroller');
Route::group(array('before' => 'auth'),function(){
	Route::post('/reservation/create', ['as' => 'reservation.create', 'uses' => 'reservationcontroller@store']);

	Route::get('logout','sessioncontroller@destroy');
	Route::resource('users','usercontroller');
	Route::resource('materials','materialcontroller');
	Route::resource('categories','categoriecontroller');
	Route::resource('reservations','reservationcontroller');
	Route::resource('messages','messagecontroller');
	
	Route::get('/materials/{id}/cal', 'materialcontroller@calNext');
	Route::get('/mail/check','messagecontroller@sendMails');	
	Route::get('/uitchecken', ['as' => 'checkout', 'uses' => 'materialcontroller@checkOut']);
	Route::get('/inchecken', ['as' => 'checkin', 'uses' => 'materialcontroller@checkIn']);

	Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

	Route::get('/reservations/delete/{id}',['as' => 'reservations.destroy','uses' => 'reservationcontroller@destroy']);
	Route::get('/myreservations',['as' => 'myreservations','uses' => 'reservationcontroller@index']);
	
	Route::post('/uitcheckenMateriaal',  'materialcontroller@checkOutMaterial');
	Route::post('/incheckenMateriaal', 'materialcontroller@checkInMaterial');
	Route::post('/opmerking', 'materialcontroller@storeMessage');
	
	Route::group(array('before' => 'admin'),function(){
		Route::get('card/baselaptop', ['as' => 'setBaseLaptop', 'uses' => 'CardController@createBaseLaptop']);

		Route::get('/logbook','materialcontroller@getLogbook');
		Route::get('/logbook/{id}','materialcontroller@getReservations');
		Route::post('/logbook/search','materialcontroller@filterLogbook');

		Route::get('/users/{id}/delete', 'usercontroller@destroy');
		Route::get('/beheer', 'HomeController@beheer');
		Route::get('/beheer/materiaal', 'HomeController@beheerMateriaal');
		Route::get('/beheer/gebruikers', 'HomeController@beheerGebruikers');

		Route::get('/categories/delete/{id}',['as' => 'categories.destroy','uses'=>'categoriecontroller@destroy']);
		Route::get('/beheer/notifications', ['as' => 'notifications.index', 'uses' => 'NotificationController@index']);
		Route::get('/beheer/notifications/create', ['as' => 'notifications.create', 'uses' => 'NotificationController@create']);
		Route::post('/beheer/notifications/create', ['uses' => 'NotificationController@store']);
		Route::get('/beheer/notifications/{id}/edit', ['as' => 'notifications.edit', 'uses' => 'NotificationController@edit']);
		Route::post('/beheer/notifications/{id}/edit', ['as' => 'notifications.update', 'uses' => 'NotificationController@update']);
		Route::get('/beheer/notifications/delete/{id}', ['as' => 'notifications.destroy', 'uses' => 'NotificationController@destroy']);
	});
});

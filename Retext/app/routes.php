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

/**
 * Controllers
 */
Route::controller('users', 'UserController');
Route::controller('keywords', 'KeywordController');


/**
 * SMS Acceptor
 */
Route::post('sms', 'IOController@smsReceiver');
Route::get('sms', function() {
    return Redirect::to('http://petsafe.net');
});


/**
 * Login Prompt
 */
Route::get('/login', 'LoginController@getLogin');
Route::post('/login', 'LoginController@postLogin');
Route::get('/logout', 'LoginController@getLogout');

/**
 * Root Redirections
 */

Route::get('/', function() {
	return Redirect::to('http://petsafe.net');
});

Route::get('/keywords', function() {
    return Redirect::action('KeywordController@getManage');
});

Route::get('/users', function() {
    return Redirect::action('UserController@getManage');
});
    
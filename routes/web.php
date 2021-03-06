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
	return redirect('/login');
});

Route::get('/users', 'UserController@index')->name('users');

Route::get('/profile', 'UserController@profile')->name('profile');
Route::post('/profile', 'UserController@update_avatar')->name('update_avatar');
Route::get('users/delete/{id}', 'UserController@destroy')->name('delete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

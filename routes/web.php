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
Auth::routes();
Route::get('/', '\App\Http\Controllers\HomeController@index');
Route::get('/email/verify/{token}' , ['as' => 'email.verify' , 'uses' => '\App\Http\Controllers\Auth\RegisterController@verify']);
Route::resource('discussion' , '\App\Http\Controllers\DiscussionsController');




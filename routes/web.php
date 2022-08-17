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
//для этого контроллера маршрутизацию
Route::get('/', function () {
    return view('welcome');
});
Route::resource('topic', 'TopicController');
Route::resource('block','BlockController');
Route::post('topic/search','TopicController@search');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

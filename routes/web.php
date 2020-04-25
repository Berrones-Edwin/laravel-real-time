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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// API Users
Route::view('/users','users.showAll')->name('users.all');
// Ruleta
Route::view('/game','game.show')->name('game.show');
// Chat
Route::get('/chat', 'ChatController@show')->name('chat.show');
Route::post('/chat', 'ChatController@messageReceived')->name('chat.message');
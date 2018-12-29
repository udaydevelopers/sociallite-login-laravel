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
Route::get('/privacy', 'HomeController@privacy')->name('privacy');
Route::get('user-lists','SearchController@search')->name('user-lists');
Route::get('post-lists','SearchController@postList')->name('post-lists');
//Route::get('login/github', 'Auth\LoginController@redirectToProvider')->name('loginGit');
//Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

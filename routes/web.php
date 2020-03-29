<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'SiteController@index');
Route::get('/timetable', 'SiteController@timetable');
Route::get('rank', 'SiteController@rank');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//правило: все урл админ лежат в группе админ, чтобы не писать префикс и все урл подчиняются одним правилам
Route::prefix('admin')->group(function(){
Route::get('/','admin\IndexController@index');

});

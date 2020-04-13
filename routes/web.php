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
Route::get('/timetable', 'SiteController@timetable')->name('Timetable');;
Route::get('/timetable/{name}/{id}', 'SiteController@showTimetable')->name('showTimetable');
Route::get('/rank', 'SiteController@rank');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin', 'prefix' =>'admin/users',],function ()
{
    Route::resource('types', 'AdminTypeUserController')->names('admin.types');
});

Route::group(['namespace' => 'Admin', 'prefix' =>'admin'],function ()
{
    Route::get('/','IndexController@index');
    Route::resource('groups', 'adminGroupsController')->except("show")->names('admin.groups');
    Route::resource('subjects', 'AdminSubjectController')->names('admin.subjects');
    Route::resource('users', 'AdminUserController')->names('admin.users');
    Route::resource('rooms', 'AdminRoomController')->names('admin.rooms');
    Route::resource('courses', 'AdminCourseController')->names('admin.courses');
    Route::resource('Lessons', 'AdminLessonsController')->except("show")->names('admin.lessons');
});

//Журнал на фронте
Route::resource('journals', 'JournalController')->names('front.journals');

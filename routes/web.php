<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/',"Home@index");
Route::post('/','Home@index');
Route::get('home',"Home@index");
Route::get('api',"Api@index");
Route::get('search',"Search@index");
Route::get('eclass',"Eclass@index");
Route::get('admin',"Admin@index");
Route::get('template',"Home@template");
Route::get('adminapi',"Adminapi@index");
Route::get('update',"Adminapi@update");
Route::get('company',"Company@index");

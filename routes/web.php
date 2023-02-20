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

Route::get('/', 'App\Http\Controllers\AppController@mainpage')->name('mainpage');
Route::post('/','App\Http\Controllers\AppController@markString')->name('string-send');
Route::post('/check','App\Http\Controllers\AppController@checkEdit')->name('check-edit');
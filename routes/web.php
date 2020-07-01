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

Route::get('task/index','TaskController@index')->name('task.index');
Route::get('task/create','TaskController@create')->name('task.create');
Route::post('task/store' ,'TaskController@store')->name('task.store');
Route::get('task/show/{id}' ,'TaskController@show')->name('task.show');
Route::get('task/edit/{id}','TaskController@edit')->name('task.edit');
Route::post('task/update/{id}','TaskController@update')->name('task.update');

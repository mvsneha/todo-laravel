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

Route::get('/todo', 'TodoController@index')->name('todo');
Route::post('/todo', 'TodoController@store')->name('add');
Route::delete('/todo/{id}', 'TodoController@destroy');
Route::post('/todo/{id}/edit', 'TodoController@edit');
Route::get('/todo/completed', 'TodoController@completed')->name('completed');
Route::post('/todo/complete', 'TodoController@markAsCompleted');

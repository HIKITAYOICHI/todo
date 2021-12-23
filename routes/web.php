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

Route::get('/', function () {
    return view('welcome');
    
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/tasks','TaskController@add');
Route::get('/tasks/create','TaskController@add');
Route::post('tasks/create','TaskController@store');
Route::get('tasks/edit', 'TaskController@edit');
Route::post('tasks/edit', 'TaskController@update');
Route::get('tasks/delete', 'TaskController@delete')->middleware('auth');

Route::get('/tasks', 'TaskController@index')->middleware('auth');



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

//
Auth::routes();

// ユーザー
Route::namespace('User')->prefix('user')->name('user.')->group(function () {
    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);
    // Mail
    Route::post('register', 'MailSendController@send');
    // ログイン認証後
    Route::middleware('auth:user')->group(function () {
        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);
        Route::get('home', 'HomeController@index')->name('home');
        Route::get('tasks','TaskController@add');
        Route::get('tasks/create','TaskController@add');
        Route::post('tasks/create','TaskController@store');
        Route::get('tasks/edit', 'TaskController@edit');
        Route::post('tasks/edit', 'TaskController@update');
        Route::get('tasks/delete', 'TaskController@delete');
        Route::get('tasks', 'TaskController@index');
    });
});

// 管理者
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    // ログイン認証関連
    Auth::routes([
        'register' => false,
        'reset'    => false,
        'verify'   => false
    ]);
    // ログイン認証後
    Route::middleware('auth:admin')->group(function () {
        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);
        Route::get('home', 'HomeController@index')->name('home');
        Route::get('tasks','TaskController@add');
        Route::get('tasks/create','TaskController@add');
        Route::post('tasks/create','TaskController@store');
        Route::get('tasks/edit', 'TaskController@edit');
        Route::post('tasks/edit', 'TaskController@update');
        Route::get('tasks/delete', 'TaskController@delete');
        Route::get('tasks', 'TaskController@index');
        // vendor/laravel/ui/auth-backend/RegistersUsers.php内のアクションから参照
        Route::get('register', 'Auth\RegisterController@register');
        Route::get('register', 'Auth\RegisterController@register');
        
    });
});
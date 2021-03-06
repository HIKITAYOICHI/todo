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

// Route::get('/', function () {
//     return view('welcome');
Route::get('/', function () {
    return redirect('user/tasks/');
    
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

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {
        
        Route::get('tasks/create','TaskController@create');
        Route::post('tasks/create','TaskController@store');
        Route::get('tasks/edit', 'TaskController@edit');
        Route::post('tasks/edit', 'TaskController@update');
        Route::get('tasks/delete', 'TaskController@delete');
        Route::get('tasks', 'TaskController@index');
        Route::get('tasks/show/{id}', 'TaskController@show');
        Route::get('tasks/comment/store', 'CommentController@store');
        Route::post('tasks/comment/store','CommentController@store');
        Route::get('tasks/comment/delete/{id}', 'CommentController@delete');
        Route::get('tasks/image/delete/{id}', 'ImageController@delete');
        
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
        Route::get('tasks', 'TaskController@index');
        Route::get('tasks/edit', 'TaskController@edit');
        Route::post('tasks/edit', 'TaskController@update');
        Route::get('tasks/delete', 'TaskController@delete');
        Route::get('tasks/show/{id}', 'TaskController@show');
        Route::get('tasks/comment/store', 'CommentController@store');
        Route::post('tasks/comment/store','CommentController@store');
        Route::get('tasks/comment/delete/{id}', 'CommentController@delete');
        // vendor/laravel/ui/auth-backend/RegistersUsers.php内のアクションから参照
        Route::get('register', 'Auth\RegisterController@register')->name('register');
        Route::post('register', 'Auth\RegisterController@register');
        
    });
});
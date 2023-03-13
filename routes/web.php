<?php

use App\Http\Controllers\EditController;
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
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/edit/{uid}', 'EditController@index')->name('home.edit');
    Route::get('/create', 'EditController@create')->name('home.create');
    Route::post('/create', [EditController::class, 'create_attendance'])->name('create.post');
    Route::post('/delete', [EditController::class, 'delete'])->name('delete.post');
    Route::post('/attend', [EditController::class, 'attend']);
    Route::post('/email_send', [EditController::class, 'email_send'])->name('email.send');
    Route::group(['middleware' => ['guest']], function () {
        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });
    Route::group(['middleware' => ['auth']], function () {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});

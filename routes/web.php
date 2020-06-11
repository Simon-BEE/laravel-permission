<?php

use Illuminate\Support\Facades\Auth;
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

Route::view('ui', 'ui.index');
Auth::routes();
Route::get('/', function () {
    return Auth::check() ? redirect()->route('home') : redirect()->route('login');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('home', 'HomeController@index')->name('home');

    Route::get('users', 'User\IndexController')->name('users.index');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('roles', 'Role\IndexController')->name('roles.index');
        Route::get('roles/create', 'Role\CreateController@create')->name('roles.create');
        Route::post('roles', 'Role\CreateController@store')->name('roles.store');

        Route::get('permissions', 'Permission\IndexController')->name('permissions.index');
    });

});



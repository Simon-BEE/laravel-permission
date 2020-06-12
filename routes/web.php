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
    Route::get('users/{user}', 'User\ShowController')->name('users.show');
    Route::group(['middleware' => ['can:update,user']], function () {
        Route::get('users/{user}/edit', 'User\EditController@edit')->name('users.edit');
        Route::patch('users/{user}', 'User\EditController@update')->name('users.update');
        Route::delete('users/{user}', 'User\DestroyController')->name('users.destroy');
    });

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('roles', 'Role\IndexController')->name('roles.index');
        Route::get('roles/create', 'Role\CreateController@create')->name('roles.create');
        Route::get('roles/edit/{role:slug}', 'Role\EditController@edit')->name('roles.edit');
        Route::patch('roles/{role:slug}', 'Role\EditController@update')->name('roles.update');
        Route::post('roles', 'Role\CreateController@store')->name('roles.store');
        Route::delete('roles/{role:slug}', 'Role\DestroyController')->name('roles.destroy');

        Route::get('permissions', 'Permission\IndexController')->name('permissions.index');
        Route::get('permissions/create', 'Permission\CreateController@create')->name('permissions.create');
        Route::get('permissions/edit/{permission:slug}', 'Permission\EditController@edit')->name('permissions.edit');
        Route::patch('permissions/{permission:slug}', 'Permission\EditController@update')->name('permissions.update');
        Route::post('permissions', 'Permission\CreateController@store')->name('permissions.store');
        Route::delete('permissions/{permission:slug}', 'Permission\DestroyController')->name('permissions.destroy');

        Route::get('users/create', 'User\CreateController@create')->name('users.create');
        Route::post('users', 'User\CreateController@store')->name('users.store');
    });

});



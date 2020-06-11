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

// Route::view('/ui', 'ui.index');
Auth::routes();
Route::get('/', function () {
    return Auth::check() ? redirect()->route('home') : redirect()->route('login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('permissions', 'RolePermission\IndexController')->name('permissions.index');
});



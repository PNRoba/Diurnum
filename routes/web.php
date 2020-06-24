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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return redirect('/tasks');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/tasks','taskControler');

Route::get('/addtaskurl','taskControler@display');

Route::get('/show','taskControler@show');

Route::get('/deletetaskurl','taskControler@show');

Route::any('/search','taskControler@search');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');



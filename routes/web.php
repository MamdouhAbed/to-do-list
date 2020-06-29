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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();
Route::get('/reset', 'HomeController@reset')->name('reset');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('tasks/store', 'TaskController@store');
Route::resource('tasks', 'TaskController');
Route::get('tasks/complete/{id}', 'TaskController@complete');
Route::get('completed', 'TaskController@completed')->name('completed');
Route::get('uncompleted', 'TaskController@uncompleted')->name('uncompleted');



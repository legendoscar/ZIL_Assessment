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


Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/show', 'UserController@show')->name('users.show');
Route::get('/users/create', 'UserController@create')->name('users.create');
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::patch('/users/{user}/update', 'UserController@update')->name('users.update');

Route::delete('/users/delete/{id}', 'UserController@destroy')->name('users.destroy');

Route::get('users/trashed', 'UserController@trashed')->name('users.trashed');
Route::patch('users/{user}/restore', 'UserController@restore')->name('users.restore');
Route::delete('users/{user}/forcedelete', 'UserController@forcedelete')->name('users.forcedelete');





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

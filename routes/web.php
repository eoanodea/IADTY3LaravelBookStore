<?php

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

Route::get('/', 'PageController@welcome')->name('welcome');
Route::get('/about', 'PageController@about')->name('about');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/home', 'Admin\HomeController@index')->name('admin.home');
Route::get('/user/home', 'User\HomeController@index')->name('user.home');

Route::get('/admin/books', 'Admin\BookController@index')->name('admin.books.index');
Route::get('/admin/books/create', 'Admin\BookController@create')->name('admin.books.create');
Route::get('/admin/books/{id}', 'Admin\BookController@show')->name('admin.books.show');
Route::post('/admin/books/store', 'Admin\BookController@store')->name('admin.books.store');
Route::get('/admin/books/{id}/edit', 'Admin\BookController@edit')->name('admin.books.edit');
Route::put('/admin/books/{id}', 'Admin\BookController@update')->name('admin.books.update');
Route::delete('/admin/books/{id}', 'Admin\BookController@destroy')->name('admin.books.destroy');

Route::get('/user/books', 'user\BookController@index')->name('user.books.index');
Route::get('/user/books/{id}', 'user\BookController@show')->name('user.books.show');


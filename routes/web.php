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

Route::group(['prefix' => '/admin', 'as' => 'admin.'], function() {
    Route::get('/home', 'Admin\HomeController@index')->name('home');
    Route::get('/books', 'Admin\BookController@index')->name('books.index');
    Route::get('/books/create', 'Admin\BookController@create')->name('books.create');
    Route::get('/books/{id}', 'Admin\BookController@show')->name('books.show');
    Route::post('/books/store', 'Admin\BookController@store')->name('books.store');
    Route::get('/books/{id}/edit', 'Admin\BookController@edit')->name('books.edit');
    Route::put('/books/{id}', 'Admin\BookController@update')->name('books.update');
    Route::delete('/books/{id}', 'Admin\BookController@destroy')->name('books.destroy');
    Route::delete('/books/{id}/reviews/{rid}', 'Admin\ReviewController@destroy')->name('reviews.destroy');
});

Route::group(['prefix' => '/user', 'as' => 'user.'], function() {
    Route::get('/home', 'User\HomeController@index')->name('home');
    Route::get('/books', 'User\BookController@index')->name('books.index');
    Route::get('/books/{id}', 'User\BookController@show')->name('books.show');
    Route::get('/books/{id}/reviews/create', 'User\ReviewController@create')->name('reviews.create');
    Route::post('/books/{id}/reviews/store', 'User\ReviewController@store')->name('reviews.store');
});



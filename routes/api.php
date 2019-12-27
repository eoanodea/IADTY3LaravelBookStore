<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('api')->group(function() {
    Route::get('/books', 'API\BookController@index');
    Route::get('/books/{$id}', 'API\BookController@show');
    Route::post('/books', 'API\BookController@create');
    Route::put('/books', 'API\BookController@create');
});

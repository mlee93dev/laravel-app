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

Route::get('/', 'BooksController@show');

Route::post('/book', function (Request $request) {
  //
});

Route::get('/book', function (Request $request) {
  //
});

/**
* Delete Task
*/
Route::delete('/book/{book}', function (Task $task) {
  //
});
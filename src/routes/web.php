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

Route::get('/?sort={sort}', 'BooksController@show')->name('books.getSorted');

// Route::get('/books', 'BooksController@showFiltered');

Route::post('/book', 'BooksController@add');

Route::patch('/book/{id}', 'BooksController@update')->name('book.update');

Route::delete('/book/{id}', 'BooksController@delete');
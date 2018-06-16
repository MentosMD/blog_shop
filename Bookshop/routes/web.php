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

Route::get('/api/books', 'BookController@getALl')->name('books');
Route::get('/api/book/detail/{id}', 'BookController@getDetailBook')->name('detail-book');
Route::post('/api/book/search', 'BookController@searchBook')->name('search-book');
Route::post('/api/book/genre/search', 'BookController@getByGenre')->name('filter-genre');

Route::get('/api/genre/{id}', 'BookController@getGenreById')->name('genre_single');
Route::get('/api/genres', 'BookController@getAllGenres')->name('genres');
Route::post('/api/order/add', 'OrderController@addOrder')->name('add-order');

/* Admin's routers */
Route::get('/api/admin/book/all', 'AdminController@getAllBook');
Route::post('/api/admin/book/add', 'AdminController@addBook');
Route::put('/api/admin/book/edit', 'AdminController@editBook');
Route::get('/api/admin/book/delete/{id}', 'AdminController@deleteBook');
Route::get('/api/admin/orders', 'AdminController@getAllOrders');
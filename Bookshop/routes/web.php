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

Route::post('/api/order/add', 'OrderController@addOrder')->name('add-order');
Route::post('/api/book/search/by/price', 'BookController@getByPrice')->name('search-book-price');
Route::get('/api/book/price/min/max', 'BookController@getMinPriceMax');
Route::post('/api/book/comment/add', 'CommentController@add');

/* Admin's routers */
Route::prefix('api/admin')->group(function (){
    Route::get('books', 'AdminController@getAllBook');
    Route::get('book/detail/{id}', 'AdminController@getDetailBook');
    Route::post('book/add', 'AdminController@addBook');
    Route::post('book/update', 'AdminController@updateBook');
    Route::get('book/delete/{id}', 'AdminController@deleteBook');
    Route::get('orders', 'AdminController@getAllOrders');
    Route::get('order/{id}', 'AdminController@getDetailOrder');
    Route::get('order/delete/{id}', 'AdminController@deleteOrder');
});

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

Route::get('/api/v1/blog/all', 'BlogController@getAll')->name('blogs');
Route::get('/api/v1/blog/get/{id}', 'BlogController@getById')->name('get_blog');
Route::post('/api/v1/blog/search', 'BlogController@searchById')->name('blog_search');

Route::get('/api/v1/comments', 'CommentController@index');
Route::get('/api/v1/comment/get/{id}', 'CommentController@getId');

/* Admin's routers */
Route::prefix('api/admin')->group(function () {

});
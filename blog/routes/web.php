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

Route::post('/api/v1/comment/add', 'CommentController@create');
Route::get('/api/v1/comments', 'CommentController@index');

Route::post('/api/v1/user/register', 'AuthController@register');
Route::post('/api/v1/user/login', 'AuthController@login');

Route::post('/api/v1/profile', 'ProfileController@index');
Route::post('/api/v1/profile/update', 'ProfileController@update');

/* Admin's routers */
Route::prefix('api/v1')->group(function () {
    Route::get('admin/blog/all', 'AdminController@getAll');
    Route::get('admin/blog/get/{id}', 'AdminController@getById');
    Route::post('admin/blog/add', 'AdminController@addBlog');
    Route::get('admin/blog/delete/{id}', 'AdminController@delete');
    Route::post('admin/blog/update', 'AdminController@update');
    Route::get('admin/comment/all', 'AdminController@getAllComments');
    Route::get('admin/comment/delete/{id}', 'AdminController@deleteComment');
});
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
Route::post('/api/v1/blog/rating', 'BlogRatingController@add');
Route::post('/api/v1/blog/like/add', 'BlogController@addLike');

Route::post('/api/v1/comment/add', 'CommentController@create');
Route::get('/api/v1/comments', 'CommentController@index');

Route::post('/api/v1/user/register', 'AuthController@register');
Route::post('/api/v1/user/login', 'AuthController@login');
Route::post('/api/v1/user/password/update', 'AuthController@updatePassword');

Route::post('/api/v1/profile', 'ProfileController@index');
Route::post('/api/v1/profile/update', 'ProfileController@update');
Route::post('/api/v1/user/blogs', 'ProfileController@getBlogsUser');
Route::post('/api/v1/profile/blog/add', 'ProfileController@addBlog');
Route::get('/api/v1/profile/blog/delete/{id}', 'ProfileController@deleteBlog');
Route::post('/api/v1/profile/delete', 'ProfileController@deleteProfile');
Route::get('/api/v1/profile/detail/{id}', 'ProfileController@profileDetail');

/* Admin's routers */
Route::prefix('api/v1')->group(function () {
    Route::get('admin/blog/all', 'AdminController@getAll');
    Route::get('admin/blog/get/{id}', 'AdminController@getById');
    Route::post('admin/blog/add', 'AdminController@addBlog');
    Route::get('admin/blog/delete/{id}', 'AdminController@delete');
    Route::get('admin/user/all', 'AdminController@users');
    Route::get('admin/user/delete/{id}', 'AdminController@deleteUser');
    Route::get('admin/user/detail/{id}', 'AdminController@detailUser');
    Route::get('admin/user/block/{id}', 'AdminController@blockUser');
    Route::get('admin/user/unblock/{id}', 'AdminController@unblockUser');
});
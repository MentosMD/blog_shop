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

Route::get('/api/books', 'BookController@getAll')->name('books');
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
    Route::post('order/status', 'OrderController@status');
});

/* Blog api */ 
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
Route::post('/api/v1/user/orders', 'ProfileController@getOrdersUser');
Route::post('/api/v1/profile/blog/add', 'ProfileController@addBlog');
Route::get('/api/v1/profile/blog/delete/{id}', 'ProfileController@deleteBlog');
Route::post('/api/v1/profile/delete', 'ProfileController@deleteProfile');
Route::get('/api/v1/profile/detail/{id}', 'ProfileController@profileDetail');

/* Admin's routers */
Route::prefix('api/v1')->group(function () {
    Route::get('admin/blog/all', 'AdminController@getAllBlogs');
    Route::get('admin/blog/get/{id}', 'AdminController@getByIdBlog');
    Route::post('admin/blog/add', 'AdminController@addBlog');
    Route::get('admin/blog/delete/{id}', 'AdminController@delete');
    Route::get('admin/user/all', 'AdminController@users');
    Route::get('admin/user/delete/{id}', 'AdminController@deleteUser');
    Route::get('admin/user/detail/{id}', 'AdminController@detailUser');
    Route::get('admin/user/block/{id}', 'AdminController@blockUser');
    Route::get('admin/user/unblock/{id}', 'AdminController@unblockUser');
});
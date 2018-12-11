<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/api/admin/book/add',
        '/api/book/search',
        '/api/book/genre/search',
        '/api/order/add',
        '/api/book/search/by/price',
        '/api/admin/image/upload',
        '/api/admin/book/update',
        '/api/book/comment/add',
        '/api/admin/order/status',
        '/api/v1/user/register',
        '/api/v1/user/login',
        '/api/v1/user/password/update',
        '/api/v1/profile',
        '/api/v1/profile/update',
        '/api/v1/user/blogs',
        '/api/v1/user/orders',
        '/api/v1/profile/blog/add',
        '/api/v1/profile/delete',
        '/api/v1/blog/search',
        '/api/v1/blog/rating',    
        '/api/v1/blog/like/add',
        '/api/v1/admin/blog/add'
    ];
}

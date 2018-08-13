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
        '/api/v1/blog/search',
        '/api/v1/comment/add',
        '/api/v1/admin/blog/update',
        'api/v1/admin/blog/add',
        '/api/v1/user/register',
        '/api/v1/user/login',
        '/api/v1/profile',
        '/api/v1/profile/update',
        '/api/v1/user/blogs',
        '/api/v1/user/password/update',
        '/api/v1/blog/rating',
        '/api/v1/profile/blog/add'
    ];
}

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
        '/api/admin/book/update'
    ];
}

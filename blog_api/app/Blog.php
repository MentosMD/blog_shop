<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    private $fillable = [
        'blog_title', 'blog_body', 'blog_author', 'created_date'
    ];
}

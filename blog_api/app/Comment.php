<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    private $fillable = [
        'name', 'comment_body', 'email',
        'created_date', 'blog_id'
    ];
}

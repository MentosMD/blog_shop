<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name', 'comment_body', 'email',
        'created_date', 'blog_id'
    ];

    protected $table = "comments";
}

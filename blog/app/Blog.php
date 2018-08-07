<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'blog_title', 'blog_body', 'user_id', 'created_date'
    ];

    protected $table = "blog";

    public function comments()
    {
        return $this->hasMany(Comment::class, 'blog_id', 'id');
    }
}

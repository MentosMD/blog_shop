<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
       'id', 'blog_title', 'blog_body', 'user_id', 'created_date'
    ];

    protected $table = "blog";

    public function comments()
    {
        return $this->hasMany(Comment::class, 'blog_id', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'blog_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'blog_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function profile()
    {
        return $this->hasMany(Profile::class, 'user_id', 'user_id');
    }
}

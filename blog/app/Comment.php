<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment', 'user_id',
        'created_date', 'blog_id'
    ];

    protected $table = "comments";

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'id', 'blog_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}

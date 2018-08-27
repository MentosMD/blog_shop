<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'id', 'count', 'blog_id', 'user_id'
    ];
    protected $table = "blog_like";

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'id', 'blog_id');
    }
}

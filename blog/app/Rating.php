<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'id', 'score', 'user_id', 'blog_id'
    ];

    protected $table = "blog_rating";
}

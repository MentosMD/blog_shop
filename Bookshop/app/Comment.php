<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'id', 'name', 'email', 'book_id', 'comment', 'created_date'
    ];

    protected $table = 'book_comment';

    public function book()
    {
        return $this->belongsTo(Book::class, 'id', 'book_id');
    }
}

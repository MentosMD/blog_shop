<?php
/**
 * Created by PhpStorm.
 * User: mentos
 * Date: 5/31/18
 * Time: 11:39 PM
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'price', 'pages', 'author', 'description', 'image'
    ];
    protected $table = "books";

    public function genre()
    {
        return $this->hasMany(Genre::class);
    }
}
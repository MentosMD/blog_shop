<?php
namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Blog;

class BlogRepository
{
    function __construct() {}

    public function getAll()
    {
        return Blog::all();
    }

    public function getBlog($id)
    {
        return Blog::findOrFail($id);
    }

    public function searchBlog($title)
    {
        return DB::table('blog')
                ->where('title', $title);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: mentos
 * Date: 7/20/18
 * Time: 9:16 PM
 */

namespace App\Repository;

use App\Comment;

class CommentRepository
{
    public function all()
    {
        return Comment::all();
    }

    public function create($resp)
    {
        $comment = new Comment();
        $comment->insert($resp);
    }
}
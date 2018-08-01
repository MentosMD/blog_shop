<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Repository\BlogRepository;
use App\Repository\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = Comment::all();
        return response()->json(['success' => 'OK', 'response' => $comments], 200);
    }

    public function create(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $comment_body = $request->input('comment_body');
        $created_date = date("Y-m-d");
        $blog_id = $request->input('blog_id');

        $validator = \Validator::make($request->all(), [
             'name' => 'required|max:100',
             'email' => 'required|email|max:100',
             'comment_body' => 'required|max|1000',
             'blog_id' => 'required'
        ]);
        if($validator->fails())
        {
            return response()->json(['success' => 'false', 'response' => $validator->errors()], 400);
        }
        $resp = [
            'name' => $name,
            'email' => $email,
            'comment_body' => $comment_body,
            'created_date' => $created_date,
            'blog_id' => $blog_id
        ];
        $comment = new Comment();
        $comment->insert($resp);
        return response()->json(['success' => 'OK', 'response' => 'Successfully added!'], 200);
    }
}

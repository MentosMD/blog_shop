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
        $comment = $request->input('comment_body');
        $created_date = date("Y-m-d");
        $blog_id = $request->input('blog_id');
        $token = $request->input('token');

        $validator = \Validator::make($request->all(), [
             'comment' => 'required|max|1000',
             'blog_id' => 'required'
        ]);
        if($validator->fails())
        {
            return response()->json(['success' => 'false', 'response' => $validator->errors()], 400);
        }
        $user = DB::table('blog_user')
                ->where('token', '=', $token)->get();
        $user_id = null;
        foreach ($user as $u) {
            $user_id = $u->id;
        }
        $resp = [
            'comment' => $comment,
            'created_date' => $created_date,
            'blog_id' => $blog_id,
            'user_id' => $user_id
        ];
        $comment = new Comment();
        $comment->insert($resp);
        return response()->json(['success' => 'OK', 'response' => 'Successfully added!'], 200);
    }
}

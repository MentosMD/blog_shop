<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function getAll()
    {
        $blogs = Blog::all();
        return response()->json(['success' => 'OK', 'response' => $blogs], 200);
    }

    public function getById(Request $request, $id)
    {
        $find = \DB::table('blog')->find($id);
        if($find == null) {
            return response()->json(['success' => 'error', 'response' => 'There is not '.$id], 400);
        }
        return response()->json(['success' => 'OK', 'response' => $find], 200);
    }

    public function delete(Request $request, $id)
    {
        \DB::table('blog')->where('id', $id);
        return response()->json(['succes' => 'OK'], 200);
    }

    public function update(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'blog_title' => 'max:255',
            'blog_body' => 'max:1000',
            'blog_author' => 'max:100',
        ]);
        [$id, $blog_title, $blog_body, $blog_author, $created_date] = $request->all();
        if($valid->fails()) {
            return response()->json(['success' => 'OK', 'response' => $valid->errors()], 200);
        }
        \DB::table('blog')->where('id', $id)
                ->update(['blog_title' => $blog_title, 'blog_body' => $blog_body,
                        'blog_author' => $blog_author, 'created_date' => $created_date]);
        return response()->json(['success' => 'OK'], 200);
    }

    public function addBlog(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'blog_title' => 'required|max:255',
            'blog_body' => 'required|max:1000'
        ]);
        if($valid->fails()) {
            return response()->json(['success' => 'OK', 'response' => $valid->errors()], 200);
        }
        $blog_title = $request->input('blog_title');
        $blog_body = $request->input('blog_body');
        $resp = [
            'blog_title' => $blog_title,
            'blog_body' => $blog_body,
            'blog_author' => 'Admin',
            'created_date' => date("Y-m-d")
        ];
        $blog = new Blog();
        $blog->insert($resp);
        return response()->json(['success' => 'OK'], 200);
    }

    public function getAllComments()
    {
        $comments = Comment::all();
        return response()->json(['success' => 'OK', 'response' => $comments], 200);
    }

    public function deleteComment(Request $request, $id)
    {
        \DB::table('comments')->delete($id);
        return response()->json(['success' => 'OK']);
    }
}

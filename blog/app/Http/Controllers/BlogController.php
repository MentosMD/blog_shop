<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Comment;
use App\Like;
use App\Profile;
use App\Rating;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Repository;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{

    public function getAll(Request $request)
    {
       $blogs = Blog::all();
       if(count($blogs) == 0) {
           return response()->json(['success' => 'OK', 'response' => 'Blogs is empty'], 200);
       }
       return response()->
            json(['success' => 'OK', 'response' => $blogs], 200);
    }

    public function getById(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $comments = Comment::where('blog_id', '=', $id)->get();
        $arr = array();
        foreach ($comments as $comment) {
            $profile = Profile::findOrFail($comment->user_id);
            array_push($arr, array(
                'firstname' => $profile->firstname,
                'lastname' => $profile->lastname,
                'comment' => $comment->comment,
                'created_date' => $comment->created_date
            ));
        }
        $blog->ratings;
        $blog->likes;
        return response()->json(['success' => 'OK',
            'response' => array(
                'blog' => $blog,
                'comments' => $arr,
                'profile' => $blog->profile
            )], 200);
    }

    public function searchById(Request $request)
    {
        $title = $request->input('title');
        $result = DB::table('blog')
            ->where('blog_title', 'like', '%%'.$title.'%%')
            ->get();
        return response()->json(['success' => 'OK', 'response' => $result]);
    }

    public function addLike(Request $request)
    {
        $token = $request->input('token');
        $count = $request->input('count');
        $blog_id = $request->input('blog_id');
        $user = DB::table('blog_user')
            ->where('token', '=', $token)
            ->get();
        $user_id = $user->pluck('id')[0];
        $likes = DB::table('blog_like')
                    ->where([
                        ['user_id', '=', $user_id],
                        ['blog_id', '=', $blog_id]
                    ])->get();
        if (!count($likes)) {
            $resp = [
                'count' => $count,
                'blog_id' => $blog_id,
                'user_id' => $user_id
            ];
            $Like = new Like();
            $Like->insert($resp);
            return response()->json(['success' => 'ok'], 200);
        } else {
            return response()->json(['error', 'message' => 'You have put like!'], 400);
        }
    }
}

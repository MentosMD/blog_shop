<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Comment;
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
        $user_id = $blog->pluck('user_id');
        $user = User::where('id', '=', $user_id)->first();
        $profile = $user->profile;
        $blog->comments;
        $blog->ratings;
        return response()->json(['success' => 'OK', 'response' => ['blog' => $blog, 'user' => $profile]], 200);
    }

    public function searchById(Request $request)
    {
        $title = $request->input('title');
        $result = DB::table('blog')
            ->where('blog_title', 'like', '%%'.$title.'%%')
            ->get();
        return response()->json(['success' => 'OK', 'response' => $result]);
    }
}

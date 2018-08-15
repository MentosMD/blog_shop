<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Profile;
use App\Rating;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->input('token');
        $user = DB::table('blog_user')
                  ->where('token', '=', $token)
                  ->get();
        $user_id = 0;
        foreach ($user as $u) {
            $user_id = $u->id;
        }
        $profile = DB::table('user_profile')
                    ->where('user_id', '=', $user_id)
                    ->get();
        return response()->json(['success' => 'OK', 'response' => $profile], 200);
    }

    public function update(Request $request)
    {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $age = $request->input('age');
        $about = $request->input('about');
        $country = $request->input('country');
        $valid = Validator::make($request->all(), [
            'first_name' => 'max:100',
            'last_name' => 'max:100',
        ]);
        if($valid->fails()) {
            return response()->json(['success' => 'error', 'response' => $valid->errors()], 400);
        }
        $user = DB::table('blog_user')
            ->where('token', '=', $request->input('token'))
            ->get();
        $user_id = 0;
        foreach ($user as $u) {
            $user_id = $u->id;
        }
        DB::table('user_profile')->where('user_id', '=', $user_id)
                ->update([
                    'firstname' => $first_name,
                    'lastname' => $last_name,
                    'age' => $age,
                    'about' => $about,
                    'country' => $country
                ]);
        return response()->json(['success' => 'ok'], 200);
    }

    public function getBlogsUser(Request $request)
    {
       $token = $request->input('token');
       $user = DB::table('blog_user')->where('token', '=', $token)
                ->get();
       $user_id = null;
       foreach ($user as $u) {
           $user_id = $u->id;
       }

       $blogs = Blog::where('user_id', '=', $user_id)
                ->get();
       $ratings = array();
       foreach ($blogs as $blog) {
           $rate = Rating::where('blog_id', '=', $blog->id)->get();
           array_push($ratings, $rate);
       }
       return response()->json(['success' => 'OK', 'response' => array('blogs' => $blogs,'ratings' => $ratings)], 200);
    }

    public function addBlog(Request $request)
    {
        $token = $request->input('token');
        $user_id = null;
        $valid = Validator::make($request->all(), [
            'blog_title' => 'required|max:255',
            'blog_body' => 'required|max:1000'
        ]);
        if($valid->fails()) {
            return response()->json(['_error', 'response' => $valid->errors()], 400);
        }
        $user = DB::table('blog_user')->where('token', '=', $token)
            ->get();
        foreach ($user as $u) {
            $user_id = $u->id;
        }
        $blog_title = $request->input('blog_title');
        $blog_body = $request->input('blog_body');
        $resp = [
            'blog_title' => $blog_title,
            'blog_body' => $blog_body,
            'user_id' => $user_id,
            'created_date' => date("Y-m-d")
        ];
        $blog = new Blog();
        $blog->insert($resp);
        return response()->json(['success' => 'OK'], 200);
    }

    public function deleteBlog(Request $request, $id)
    {
        Blog::destroy($id);
        return response()->json(['success' => 'OK']);
    }

    public function deleteProfile(Request $request)
    {
        $token = $request->input('token');
        $user = User::where('token', '=', $token);
        $profile = Profile::findOrFail($user->id);
        $blogs = Blog::where('user_id', '=', $user->id);
        try {
           $user->delete();
           $profile->delete();
           $blogs->delete();
            return response()->json(['success' => 'OK'], 200);
        } catch (\Exception $e) {
            return response()->json(['err' => $e->getMessage()], 400);
        }
    }

    public function profileDetail(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return response()->json(['success' => 'ok',
                'response' =>
                    array(
                        'profile' => $user->profile,
                        'blogs' => $user->blogs
                    )], 200);
    }
}

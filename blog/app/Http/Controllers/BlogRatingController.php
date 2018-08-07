<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogRatingController extends Controller
{
    public function add(Request $request)
    {
        $score = $request->input('score');
        $token = $request->input('token');
        $blog_id = $request->input('blog_id');
        $user = DB::table('blog_user')
                    ->where('token', '=', $token)
                    ->get();
        $user_id = null;
        foreach ($user as $u) { $user_id = $u->id; }
        $rating = DB::table('blog_rating')
                    ->where([
                        ['user_id', '=', $user_id],
                        ['blog_id', '=', $blog_id]
                    ])
                    ->get();
        if (!count($rating))
        {
            $resp = [
                'score' => $score,
                'user_id' => $user_id,
                'blog_id' => $blog_id
            ];
            $Rate = new Rating();
            $Rate->insert($resp);
            return response()->json(['success' => 'OK'], 200);
        } else {
            return response()->json(['error', 'message' => 'You have voted!'], 400);
        }
    }
}

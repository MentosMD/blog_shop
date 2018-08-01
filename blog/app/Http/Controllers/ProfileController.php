<?php

namespace App\Http\Controllers;

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
                ->update(['firstname' => $first_name, 'lastname' => $last_name, 'age' => $age]);
        return response()->json(['success' => 'OK'], 200);
    }
}

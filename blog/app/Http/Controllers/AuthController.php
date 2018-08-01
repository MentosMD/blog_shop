<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $login = $request->input('login');
        $email = $request->input('email');
        $password = $request->input('password');
        $token = str_random(50);
        $valid = \Validator::make($request->all(), [
            'login' => 'required|max:100',
            'email' => 'required|email|max:100',
            'password' => 'required|max:255'
        ]);
        if($valid->fails()) {
            return response()->json(['success' => 'error', 'response' => $valid->errors()],400);
        }
        $resp = [
            'login' => $login,
            'email' => $email,
            'password' => $password,
            'token' => $token
        ];
        $user = new User();
        $user->insert($resp);
        return response()->json(['success' => 'OK'], 200);
    }

    public function login(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');
        $user = DB::table('blog_user')
                    ->where([
                        ['login', '=', $login],
                        ['password', '=', $password],
                    ])->get();
        if(!$user->count()) {
            return response()->json(['error' => 'OK', 'response' => 'Invalid login or password'], 400);
        }
        $token = "";
        foreach ($user as $u) {
            $token = $u->token;
        }
        return response()->json(['success' => 'OK', 'response' => $token], 200);
    }
}

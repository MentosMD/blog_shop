<?php

namespace App\Http\Controllers;

use App\Profile;
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
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $token = str_random(50);
        $valid = \Validator::make($request->all(), [
            'login' => 'required|max:100',
            'email' => 'required|email|max:100',
            'password' => 'required|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255'
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
        $profile = new Profile();
        $user = new User;
        $user->login = $login;
        $user->email = $email;
        $user->password = $password;
        $user->token = $token;
        $user->save();
        $profile->insert([
            'firstname' => $first_name,
            'lastname' => $last_name,
            'age' => 0,
            'user_id' => $user->id
        ]);
        return response()->json(['success' => 'OK', 'response' => $user->token], 200);
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

    public function updatePassword(Request $request)
    {
        $password = $request->input('password');
        $repeat_password = $request->input('repeat_password');
        $token = $request->input('token');
        if ($password != $repeat_password) {
            return response()->json(['error', 'response' => 'Passwords does not match!'], 400);
        }
        DB::table('blog_user')
            ->where('token', '=', $token)
            ->update(['password' => $password]);
        return response()->json(['success' => 'OK'], 200);
    }
}
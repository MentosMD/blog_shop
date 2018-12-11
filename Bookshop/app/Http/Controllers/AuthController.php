<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $login = $request->input('login');
        $email = $request->input('email');
        $password = $request->input('password');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $token = uniqid(base64_encode(str_random(60)));
        $valid = \Validator::make($request->all(), [
            'login' => 'required|max:100',
            'email' => 'required|email|max:100',
            'password' => 'required|max:255',
            'first_name' => 'max:255',
            'last_name' => 'max:255'
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
        $user->block = false;
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
            return response()->json(['error', 'message' => 'Invalid login or password'], 400);
        }
        $token = "";
        foreach ($user as $u) {
            $token = $u->token;
        }
        if ($user->pluck('block')[0] == 1) {
            return response()->json(['err' => 'true', 'message' => 'You are blocked'], 402);
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

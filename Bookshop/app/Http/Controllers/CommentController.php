<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function add(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $comment = $request->input('comment');
        $book_id = $request->input('book_id');
        $created_date = date('Y-m-d');

        $valid = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required',
            'book_id' => 'required'
        ]);
        if ($valid->fails()) {
            return response()->json(['error', 'response' => $valid->errors()], 400);
        }

        $Comment = new Comment();
        $Comment->insert([
           'name' => $name,
           'email' => $email,
           'comment' => $comment,
           'book_id' => $book_id,
           'created_date' => $created_date
        ]);
        return response()->json(['success' => 'ok']);
    }
}

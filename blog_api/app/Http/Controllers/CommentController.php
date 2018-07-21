<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Repository\BlogRepository;
use App\Repository\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $repository;

    function __construct()
    { $this->repository = new CommentRepository(); }

    public function index(Request $request)
    {
        $comments = $this->repository->all();
        return response()->json(['success' => 'OK', 'response' => $comments], 200);
    }

    public function create(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $comment_body = $request->input('comment');
        $created_date = date("d/m/Y");

        $validator = \Validator::make($request->all(), [
             'name' => 'required|max:100',
             'email' => 'required|email|max:100',
             'comment_body' => 'required|max|1000'
        ]);
        if($validator->fails())
        {
            return response()->json(['success' => 'false', 'response' => $validator->errors()], 400);
        }
        $resp = [
            'name' => $name,
            'email' => $email,
            'comment_body' => $comment_body,
            'created_date' => $created_date
        ];
        $this->repository->create($resp);
        return response()->json(['success' => 'OK', 'response' => 'Successfully added!'], 200);
    }
}

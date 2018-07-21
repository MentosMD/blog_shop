<?php

namespace App\Http\Controllers;

use App\Repository\BlogRepository;
use Illuminate\Http\Request;
use App\Repository;

class BlogController extends Controller
{
    private $repository;

    function __construct()
    { $this->repository = new BlogRepository(); }

    public function index(Request $request)
    {
        $blogs = $this->repository->getAll();
        if(count($blogs) == 0)
        {
            return response()->json(['success' => 'OK', 'response' => 'Have not blogs'], 200);
        }
        return response()->
              json(['success' => 'OK', 'response' => $blogs], 200);
    }

    public function getById(Request $request, $id)
    {
        $find = $this->repository->getBlog($id);
        return response()->json(['success' => 'OK', 'response' => $find], 200);
    }

    public function searchById(Request $request)
    {
        $title = $request->input('title');
        $result = $this->repository->searchBlog($title);
        return response()->json(['success' => 'OK', 'response' => $result]);
    }
}

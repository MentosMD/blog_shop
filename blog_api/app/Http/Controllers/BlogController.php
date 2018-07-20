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

    public function index()
    {
        $this->repository->getAll();
        return response()->json("Hello", 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Repository\BlogRepository;
use App\Repository\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $repository;

    function __construct()
    { $this->repository = new CommentRepository(); }

    public function index()
    {

    }
}

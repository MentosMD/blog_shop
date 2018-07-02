<?php

namespace App\Http\Controllers;

use App\Book;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function getAllBook()
    {
        $books = Book::all();
        return response()->json(['Success' => 'OK', 'response' => $books], 200);
    }

    public function getDetailBook(Request $request, $id)
    {
        $book = DB::table('books')->find($id);
        if($book == null)
        {
            return response()->json(['error' => true], 404);
        }
        return response()->json(['success' => 'OK', 'response' => $book], 200);
    }

    public function editBook(Request $request)
    {
        return response()->json(['Success' => 'OK'], 200);
    }

    public function deleteBook(Request $request, $id)
    {
        Book::where('id', $id)->delete();
        return response()->json(['Success' => 'OK'], 200);
    }

    public function addBook(Request $request)
    {
        $title = $request->input('title');
        $description = $request->input('description');
        $author = $request->input('author');
        $price = $request->input('price');
        $pages = $request->input('pages');

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:500',
            'author' => 'required|max:100',
            'price' => 'required',
            'pages' => 'required'
        ]);

        if($validator->fails())
        {
            $msg = $validator->errors();
            return response()->json([$msg], 404);
        }
        $resp = [
           'title' => $title,
           'description' => $description,
           'author' => $author,
           'price' => $price,
           'pages' => $pages
        ];
        $book = new Book();
        $book->insert($resp);
        return response()->json(['Success' => 'OK'], 200);
    }

    public function getAllOrders()
    {
        $orders = Order::all();
        return response()->json(['Success' => 'OK', 'response' => $orders], 200);
    }
}

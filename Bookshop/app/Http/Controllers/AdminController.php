<?php

namespace App\Http\Controllers;

use App\Book;
use App\Order;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

    public function getDetailOrder(Request $request, $id)
    {
        $order = DB::table('orders')->select()
                ->where('OrderId', '=', $id)
                ->get();
        if($order == null){
            return response()->json(['error' => true], 404);
        }
        return response()->json(['success' => 'OK', 'response' => $order], 200);
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
        $image = $request->input('image');

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
           'pages' => $pages,
           'image' => $image
        ];
        $book = new Book();
        $book->insert($resp);
        return response()->json(['Success' => 'OK'], 200);
    }

    public function updateBook(Request $request){
        $valid = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:500',
            'author' => 'required|max:100',
            'price' => 'required',
            'pages' => 'required'
        ]);
        $title = $request->input('title');
        $description = $request->input('description');
        $author = $request->input('author');
        $price = $request->input('price');
        $pages = $request->input('pages');
        $image = $request->input('image');
        if($valid->fails()){
            return response()->json(['errors' => $valid->errors()]);
        }
        DB::table('books')
            ->where('id', $request->input('id'))
            ->update(['title' => $title, 'description' => $description, 'author' => $author,
                    'price' => $price, 'pages' => $pages, 'image' => $image]);
        return response()->json(['Success' => 'OK'], 200);
    }

    public function getAllOrders()
    {
        $orders = Order::all();
        return response()->json(['Success' => 'OK', 'response' => $orders], 200);
    }

    public function deleteOrder(Request $request, $id)
    {
        Order::where('id', $id)->delete();
        return response()->json(['Success' => 'OK'], 200);
    }

    public function addImageBook(Request $request)
    {
        if($request->hasFile('image')){
            return response()->json('True');
        }
        return response()->json('False');
    }
}

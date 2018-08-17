<?php

namespace App\Http\Controllers;

use App\Book;
use App\Genre;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function  getAll()
    {
        $books = Book::all();
        return response()->json(['success' => 'OK', 'response' => $books],200);
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

    public function searchBook(Request $request)
    {
        $resp = $request->input('title');
        $book = DB::table('books')
                ->where('title', 'like', '%%'.$resp.'%%')
                ->get();
        return response()->json(['success' => 'OK', 'response' => $book], 200);
    }

    public function getByPrice(Request $request)
    {
        $min = $request->input('min');
        $max = $request->input('max');
        $res = DB::table('books')
                   ->select()->where('price', '>=', $min)
                   ->where('price', '<=', $max)->get();
        return response()->json(['success' => 'OK', 'response' => $res], 200);
    }

    public function getMinPriceMax()
    {
        $books = Book::all();
        $min = Book::where('price', $books->min('price'))->first();
        $max = Book::where('price', $books->max('price'))->first();
        return response()->json(['success' => 'ok',
            'response' => array(
                'min' => $min->price,
                'max' => $max->price
            )
        ], 200);

    }
}

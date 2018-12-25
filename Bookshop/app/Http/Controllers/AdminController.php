<?php

namespace App\Http\Controllers;

use App\Book;
use App\Customer;
use App\Order;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function getAllBook(Request $request)
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
        $order = Order::findOrFail($id);
        if($order == null){
            return response()->json(['error' => true], 404);
        }
        $customer = Customer::findOrFail($order->pluck('customer_id')[0]);
        return response()->json([
            'success' => 'OK',
            'response' => array(
                'order' => $order,
                'customer' => $customer
            )
        ], 200);
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
            return response()->json([$msg], 400);
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
            return response()->json(['errors' => $valid->errors()], 400);
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



    //Blog
    public function getAllBlogs(Request $request)
    {
        $blogs = Blog::all();
        return response()->json(['success' => 'OK', 'response' => $blogs], 200);
    }

    public function getByIdBlog(Request $request, $id)
    {
        $find = \DB::table('blog')->find($id);
        if($find == null) {
            return response()->json(['success' => 'error', 'response' => 'There is not '.$id], 400);
        }
        return response()->json(['success' => 'OK', 'response' => $find], 200);
    }

    public function deleteBlog(Request $request, $id)
    {
        \DB::table('blog')->where('id', $id);
        return response()->json(['succes' => 'OK'], 200);
    }

    public function addBlog(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'blog_title' => 'required|max:255',
            'blog_body' => 'required|max:1000'
        ]);
        if($valid->fails()) {
            return response()->json(['success' => 'OK', 'response' => $valid->errors()], 200);
        }
        $blog_title = $request->input('blog_title');
        $blog_body = $request->input('blog_body');
        $resp = [
            'blog_title' => $blog_title,
            'blog_body' => $blog_body,
            'blog_author' => 'Admin',
            'created_date' => date("Y-m-d")
        ];
        $blog = new Blog();
        $blog->insert($resp);
        return response()->json(['success' => 'OK'], 200);
    }

    public function users(Request $request)
    {
        $users = Profile::all();
        return response()->json(['success' => 'ok', 'response' => $users]);
    }

    public function deleteUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $profile = Profile::findOrFail($id);
        $blogs = Blog::where('user_id', '=', $id);
        try {
            $user->delete();
            $profile->delete();
            $blogs->delete();
            return response()->json(['success' => 'ok'], 200);
        } catch (\Exception $e) {
            return response()->json(['err' => $e->getMessage()], 400);
        }
    }

    public function detailUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->profile;
        return response()->json(['success' => 'ok', 'response' => $user]);
    }

    public function blockUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->block == 0) {
            $user->block = 1;
            $user->save();
            return response()->json(['success' => 'ok', 'message' => 'You have blocked this user!'], 200);
        }
        return response()->json(['err' => 'true', 'message' => 'User is blocked'], 200);
    }

    public function unblockUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->block == 1) {
            $user->block = 0;
            $user->save();
            return response()->json(['success' => 'ok', 'message' => 'You have unblocked this user!'], 200);
        }
        return response()->json(['err' => 'true', 'message' => 'User is unblocked'], 200);
    }
}

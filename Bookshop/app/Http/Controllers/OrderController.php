<?php

namespace App\Http\Controllers;


use App\Customer;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function addOrder(Request $request)
    {
        $total = $request->input('OrderTotal');
        $quantity = $request->input('OrderQuantity');
        $cart = $request->input('cart');
        $token = $request->input('token');

        $validator = Validator::make($request->all(), [
            'OrderTotal' => 'required',
            'OrderQuantity' => 'required',
            'cart' => 'required'
        ]);
        if($validator->fails())
        {
            $msg = $validator->errors();
            return response()->json($msg, 404);
        }
        $user= DB::table('blog_user')->where('token', '=', $token)
                ->get();
        $order = new Order();
        $order->insert([
            'OrderTotal' => $total,
            'OrderQuantity' => $quantity,
            'OrderDate' => date("Y-m-d H:i"),
            'user_id' => $user->pluck('id')[0],
            'cart' => $cart
        ]);
        return response()->json(['success' => 'OK'], 200);
    }

    public function status(Request $request)
    {
        $req = $request->all();
        if ($req['status'] == 'done' || $req['status'] == 'refused') {
            DB::table('orders')->where('id', '=', $req['order_id'])
                    ->update([
                        'status' => $req['status']
                    ]);
            return response()->json(['message' => 'Successfully added status of order'], 200);
        } else {
            return response()->json(['message' => 'No valid status'],400);
        }
    }
}

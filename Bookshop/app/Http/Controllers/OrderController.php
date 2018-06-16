<?php

namespace App\Http\Controllers;


use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function addOrder(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $city = $request->input('city');
        $total = $request->input('OrderTotal');
        $quantity = $request->input('OrderQuantity');
        $cart = $request->input('cart');

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:5',
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'address' => 'required|max:255',
            'city' => 'required|max:20',
            'OrderTotal' => 'required',
            'OrderQuantity' => 'required',
            'cart' => 'required'
        ]);
        if($validator->fails())
        {
            $msg = $validator->errors();
            return response()->json($msg, 404);
        }
        $resp = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'city' => $city,
            'OrderTotal' => $total,
            'OrderQuantity' => $quantity,
            'OrderDate' => date("Y-m-d H:i"),
            'cart' => $cart
        ];
        $order = new Order();
        $order->insert($resp);
        return response()->json(['success' => 'OK'], 200);
    }
}

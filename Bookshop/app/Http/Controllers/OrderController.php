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
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $city = $request->input('city');
        $total = $request->input('OrderTotal');
        $quantity = $request->input('OrderQuantity');
        $cart = $request->input('cart');

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
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
        $order = new Order();
        $customer = new Customer;
        $customer->name = $name;
        $customer->email = $email;
        $customer->phone = $phone;
        $customer->address = $address;
        $customer->city = $city;
        $customer->save();
        $order->insert([
            'OrderTotal' => $total,
            'OrderQuantity' => $quantity,
            'OrderDate' => date("Y-m-d H:i"),
            'customer_id' => $customer->id,
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

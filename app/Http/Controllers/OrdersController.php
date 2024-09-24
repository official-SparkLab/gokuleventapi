<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
class OrdersController extends Controller
{
    public function store(Request $request)
    {
        $order=new Orders;
        $order->user_id=$request->user_id;
        $order->product_id=$request->product_id;
        $order->price=$request->price;
        $order->quantity=$request->quantity;
        $order->total_amount=$request->total_amount;
        $order->payment_method=$request->payment_method;
        $order->shipping_address=$request->shipping_address;
        $order->pincode=$request->pincode;
        $order->save();

        return response()->json([
            'message' =>"Order Successfully",
            'status' =>'success',
            'data' =>Orders::where("user_id",$request->user_id)->get()
         ]);
    }

    public function index($user_id)
    {
        return response()->json([
            'message' =>"Order Successfully",
            'status' =>'success',
            'data' =>Orders::where("user_id",$user_id)->get()
         ]);
    }
}

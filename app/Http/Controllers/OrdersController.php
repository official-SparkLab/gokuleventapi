<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use Illuminate\Support\Facades\DB;
class OrdersController extends Controller
{
    public function store(Request $request)
    {
        $order=new Orders;
        $order->user_id=$request->user_id;
        $order->product_id=$request->product_id;
        $order->customer_name=$request->customer_name;
        $order->customer_contact=$request->customer_contact;
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
        $myorder = DB::table('orders')
        ->join('Product', 'orders.product_id', '=', 'Product.pid')
        ->where('orders.user_id', $user_id)
        ->select('orders.*', 'Product.heading', 'Product.image', 'Product.description')
        ->get();
    
        return response()->json([
            'message' =>"Order Successfully",
            'status' =>'success',
            'data' =>$myorder
         ]);
    }

    public function allOrders()
    {
        $allorder = DB::table('orders')
        ->join('Product', 'orders.product_id', '=', 'Product.pid')
       
        ->select('orders.*', 'Product.heading', 'Product.image', 'Product.description')
        ->get();
    
        return response()->json([
            'message' =>"Order Successfully",
            'status' =>'success',
            'data' =>$allorder
         ]);
    }
}

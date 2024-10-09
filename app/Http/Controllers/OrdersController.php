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


    public function allOrdersById($order_id)
    {
        $myorder = DB::table('orders')
        ->join('Product', 'orders.product_id', '=', 'Product.pid')
        ->where('orders.order_id', $order_id)
        ->select('orders.*', 'Product.heading', 'Product.image', 'Product.description')
        ->get();
    
        return response()->json([
            'message' =>"Order Successfully",
            'status' =>'success',
            'data' =>$myorder
         ]);
    }

    public function orderStatus(Request $request)
    {
        $orderStatus=Orders::where("order_id",$request->order_id)->first();
        $orderStatus->status=$request->status;
        $orderStatus->save();
        return response()->json([
            'message' =>"Order Status Updated",
            'status' =>'success',
           
         ]);
    }

    public function dashboardSummery()
    {
        // Query to get the sum of total_amount and count of orders from the orders table
$orderSummary = DB::table('orders')
->select(
    DB::raw('SUM(total_amount) as total_amount_sum'),
    DB::raw('COUNT(order_id) as total_order_count')
)
->first();

// Query to get the count of unique users from the userregister table
$userCount = DB::table('userregister')
->select(DB::raw('COUNT(DISTINCT id) as total_user_count'))
->first();

// Query to get the count of unique products from the Product table
$productCount = DB::table('Product')
->select(DB::raw('COUNT(DISTINCT pid) as total_product_count'))
->first();

// Combine the results in the response
return response()->json([
'message' => "Summary Retrieved Successfully",
'status' => 'success',
'data' => [
    'total_amount_sum' => $orderSummary->total_amount_sum,
    'total_order_count' => $orderSummary->total_order_count,
    'total_user_count' => $userCount->total_user_count,
    'total_product_count' => $productCount->total_product_count
]
]);

    }

}

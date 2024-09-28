<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CancelOrder;
use Illuminate\Support\Facades\DB;
class CancelOrderController extends Controller
{
    public function store(Request $request)
    {
        $save=new CancelOrder();
        $save->order_id=$request->order_id;
        $save->product_id=$request->product_id;
        $save->user_id=$request->user_id;
        $save->reason=$request->reason;
        $save->cancelled_by=$request->cancelled_by;

        $save->save();

        return response()->json([
            'message' =>"Order Cancelled Successfully",
            'status'=>'success'
        ]);

    }


    public function getCancelOrderUser($user_id)
    {

        $cancelOrders = DB::table('cancel_order')
    ->join('Product', 'cancel_order.product_id', '=', 'Product.pid')
    ->join('userregister', 'cancel_order.user_id', '=', 'userregister.id')
    ->select(
        'cancel_order.*', 
        'Product.*', 
         
        'userregister.fullname', 
        'userregister.contact'
    )
    ->where('cancel_order.user_id', $user_id)  // Optional condition to filter by user
    ->get();


       return response()->json([
        'message' =>"Data Fetched Successfully",
        'status'=>'success',
        'data'=>$cancelOrders

       ]);
        
    }

    public function getAllCancelOrders()
    {
        $cancelOrders = DB::table('cancel_order')
        ->join('Product', 'cancel_order.product_id', '=', 'Product.pid')
        ->join('userregister', 'cancel_order.user_id', '=', 'userregister.id')
        ->select(
            'cancel_order.*', 
            'Product.*', 
             
            'userregister.fullname', 
            'userregister.contact'
        )
        
        ->get();
    
    
           return response()->json([
            'message' =>"Data Fetched Successfully",
            'status'=>'success',
            'data'=>$cancelOrders
    
           ]);
        
    }


}

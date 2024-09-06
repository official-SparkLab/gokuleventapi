<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
class CartController extends Controller
{
    public function store(Request $request)
    {
         $cart=new Cart;
         $cart->user_id=$request->user_id;
         $cart->product_id=$request->product_id;
         $cart->quantity=$request->quantity;
         $cart->price=$request->price;
         $cart->total_price=$request->total_price;
         $cart->status=$request->status;
         $cart->save();
         
         
         return response()->json([
            'message' =>"Added to cart",
            'status' =>'success',
            'data' =>Cart::where("user_id",$request->user_id)->get()
         ]);
    }
}

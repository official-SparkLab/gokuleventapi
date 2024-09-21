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

    public function index($id)
    {

       $cart = Cart::where("user_id", $id)->get();

if ($cart->isEmpty()) {
    return response()->json([
        'message' => "Cart is empty",
        'status' => 'error',
        'data' => []
    ]);
}

return response()->json([
    'message' => "My cart",
    'status' => 'success',
    'data' => $cart
]);

    }

    public function deleteCart(Request $request)
    {
        $cartItem = Cart::where('cart_id', $request->cart_item_id) // Assuming 'id' is the correct column for cart item
    ->where('user_id', $request->user_id)
    ->first();

if ($cartItem) {
    $cartItem->delete();
    return response()->json([
        'message' => 'Item removed from cart',
        'status' => 'success',
        'data' => Cart::where("user_id", $request->user_id)->get() // Return updated cart data
    ]);
}

return response()->json([
    'message' => 'Item not found in cart',
    'status' => 'error',
    'data' => Cart::where("user_id", $request->user_id)->get() // Return the cart data
]);


    }

}

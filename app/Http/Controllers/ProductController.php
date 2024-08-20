<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function store(Request $request)
    {
        $save=new Product;
        $save->category=$request->category;
        $save->subcategory=$request->subCategory;
        $save->heading=$request->heading;
        $save->image=$request->image;
        $save->price=$request->price;
        $save->offer_price=$request->offer_price;
        $save->description=$request->description;
        $save->status="1";
       
        $save->save();

        return response()->json([
            'message' =>'Product Added Successfully',
            'status' =>'Success',
            'data' =>$save::get()
        ]);

    }
    public function index()
    {
        $product=Product::all();
        return response()->json([
            'message' =>'Product details fetched successfully',
            'status' =>'Success',
            'data' =>$product
        ]);
    }

    public function updateProduct(Request $request,$id)
    {
        $product=Product::where("pid",$id)->first();

if ($product) {
    // Update the product fields
    $product->category = $request->input('category');
    $product->subcategory = $request->input('subCategory');
    $product->heading = $request->input('heading');
    $product->image = $request->input('image');
    $product->price = $request->input('price');
    $product->offer_price = $request->input('offer_price');
    $product->description = $request->input('description');
    
    $product->save();
    return response()->json([
        'message' =>'Product Updated Successfully',
        'status'=>'Successful',
        'data'=>Product::all()
    ]);
}
else
{
    // Save the changes
  

        return response()->json([
            'message' =>'Product not Updated',
            'status'=>'Failure',
           
        ]);
    }
}

    public function deleteProduct(Request $request,$id)
    {
        $product=Product::where("pid",$id)->first();
        if($product)
        {
            $product->status = $request->input('status');
    
             $product->save();

             return response()->json([
                'message' =>'Product Deleted',
                'status'=>'Successful',
                'data'=>Product::all()
            ]);
        }
    }

    public function updateTopSales(Request $request,$id)
    {
        $product=Product::where("pid",$id)->first();
        if($product)
        {
            $product->top_sale = $request->input('top_sale');
    
             $product->save();

             return response()->json([
                'message' =>'Product Added To Top-Sales',
                'status'=>'Successful',
                'data'=>Product::all()
            ]);
        }
    }
    
}

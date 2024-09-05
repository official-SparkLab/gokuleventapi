<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function store(Request $request)
    {
        $save = new Product;

// Save other product fields
$save->category = $request->category;
$save->subcategory = $request->subCategory;
$save->heading = $request->heading;
$save->price = $request->price;
$save->offer_price = $request->offer_price;
$save->description = $request->description;
$save->color = $request->color;
$save->prod_size = $request->prod_size;
$save->prod_description = $request->prod_description;
$save->customization = $request->customization;
$save->material = $request->material;
$save->model_no = $request->model_no;
$save->status = "1";
$save->top_sale = "No";

// Handle main image upload
if ($request->hasFile('image')) {
    $image = $request->file('image');
    $imageName = time() . '_' . $image->getClientOriginalName();
    $image->move(public_path('images/products'), $imageName);
    $save->image = 'images/products/' . $imageName;
}


if ($request->hasFile('prod_img1')) {
    $prod_img1 = $request->file('prod_img1');
    $prod_img1Name = time() . '_1_' . $prod_img1->getClientOriginalName();
    $prod_img1->move(public_path('images/products'), $prod_img1Name);
    $save->prod_img1 = 'images/products/' . $prod_img1Name;
}

if ($request->hasFile('prod_img2')) {
    $prod_img2 = $request->file('prod_img2');
    $prod_img2Name = time() . '_2_' . $prod_img2->getClientOriginalName();
    $prod_img2->move(public_path('images/products'), $prod_img2Name);
    $save->prod_img2 = 'images/products/' . $prod_img2Name;
}

if ($request->hasFile('prod_img3')) {
    $prod_img3 = $request->file('prod_img3');
    $prod_img3Name = time() . '_3_' . $prod_img3->getClientOriginalName();
    $prod_img3->move(public_path('images/products'), $prod_img3Name);
    $save->prod_img3 = 'images/products/' . $prod_img3Name;
}

// Save the product
$save->save();

// Return response
return response()->json([
    'message' => 'Product Added Successfully',
    'status' => 'Success',
    'data' => Product::where('status', '1')->get()
]);


    }
    public function index()
    {
        $product = Product::where('status', '1')->get();

    return response()->json([
    'message' => 'Product details fetched successfully',
    'status' => 'Success',
    'data' => $product
    ]);

    }

    public function updateProduct(Request $request,$id)
    {
        $product=Product::where("pid",$id)->first();

if ($product) {
    // Update the product fields
    $product->category = $request->input('category');
    $product->subcategory = $request->input('subcategory');
    $product->heading = $request->input('heading');
    $product->image = $request->input('image');
    $product->price = $request->input('price');
    $product->offer_price = $request->input('offer_price');
    $product->description = $request->input('description');
    $product->prod_img1 = $request->input('prod_img1');
    $product->prod_img2 = $request->input('prod_img2');
    $product->prod_img3 = $request->input('prod_img3');
    $product->color = $request->input('color');
    $product->prod_size = $request->input('prod_size');
    $product->prod_description = $request->input('prod_description');
    $product->customization = $request->input('customization');
    $product->material = $request->input('material');
    $product->model_no = $request->input('model_no');

    // Handle main image upload
if ($request->hasFile('image')) {
    $image = $request->file('image');
    $imageName = time() . '_' . $image->getClientOriginalName();
    $image->move(public_path('images/products'), $imageName);
    $product->image = 'images/products/' . $imageName;
}


if ($request->hasFile('prod_img1')) {
    $prod_img1 = $request->file('prod_img1');
    $prod_img1Name = time() . '_1_' . $prod_img1->getClientOriginalName();
    $prod_img1->move(public_path('images/products'), $prod_img1Name);
    $product->prod_img1 = 'images/products/' . $prod_img1Name;
}

if ($request->hasFile('prod_img2')) {
    $prod_img2 = $request->file('prod_img2');
    $prod_img2Name = time() . '_2_' . $prod_img2->getClientOriginalName();
    $prod_img2->move(public_path('images/products'), $prod_img2Name);
    $product->prod_img2 = 'images/products/' . $prod_img2Name;
}

if ($request->hasFile('prod_img3')) {
    $prod_img3 = $request->file('prod_img3');
    $prod_img3Name = time() . '_3_' . $prod_img3->getClientOriginalName();
    $prod_img3->move(public_path('images/products'), $prod_img3Name);
    $product->prod_img3 = 'images/products/' . $prod_img3Name;
}

    $product->save();
    return response()->json([
        'message' =>'Product Updated Successfully',
        'status'=>'Successful',
        'data'=>Product::where('status','1')->get()
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
                'data'=>Product::where('status','1')->all()
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
                'data'=>Product::where('status','1')->get()
            ]);
        }
    }
    public function getProductByID($id)
{
    $product = Product::where("pid", $id)->first();

    return response()->json([
        'message' => 'Product Fetched',
        'status' => 'Successful',
        'data' => $product
    ]);
}

    
}

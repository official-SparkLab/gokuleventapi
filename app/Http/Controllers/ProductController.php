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
$save->cat_id = $request->cat_id;
$save->subcat_id = $request->subcat_id;
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

    public function updateProduct(Request $request, $id)
{
    // Retrieve the product by its id
    $product = Product::where("pid", $id)->first();

    if ($product) {
        // Update the product fields directly from the request object
        $product->category = $request->category;
        $product->subcategory = $request->subcategory;
        $product->cat_id = $request->cat_id;
        $product->subcat_id = $request->subcat_id;
        $product->heading = $request->heading;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->description = $request->description;
        $product->color = $request->color;
        $product->prod_size = $request->prod_size;
        $product->prod_description = $request->prod_description;
        $product->customization = $request->customization;
        $product->material = $request->material;
        $product->model_no = $request->model_no;

        // Handle image upload for main image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/products'), $imageName);
            $product->image = 'images/products/' . $imageName;
        }

        // Handle prod_img1
        if ($request->hasFile('prod_img1')) {
            $prod_img1 = $request->file('prod_img1');
            $prod_img1Name = time() . '_1_' . $prod_img1->getClientOriginalName();
            $prod_img1->move(public_path('images/products'), $prod_img1Name);
            $product->prod_img1 = 'images/products/' . $prod_img1Name;
        }

        // Handle prod_img2
        if ($request->hasFile('prod_img2')) {
            $prod_img2 = $request->file('prod_img2');
            $prod_img2Name = time() . '_2_' . $prod_img2->getClientOriginalName();
            $prod_img2->move(public_path('images/products'), $prod_img2Name);
            $product->prod_img2 = 'images/products/' . $prod_img2Name;
        }

        // Handle prod_img3
        if ($request->hasFile('prod_img3')) {
            $prod_img3 = $request->file('prod_img3');
            $prod_img3Name = time() . '_3_' . $prod_img3->getClientOriginalName();
            $prod_img3->move(public_path('images/products'), $prod_img3Name);
            $product->prod_img3 = 'images/products/' . $prod_img3Name;
        }

        // Save the updated product
        $product->save();

        return response()->json([
            'message' => 'Product Updated Successfully',
            'status' => 'Success',
            'data' => Product::where('status', '1')->get()
        ]);
    } else {
        return response()->json([
            'message' => 'Product not found',
            'status' => 'Failure'
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

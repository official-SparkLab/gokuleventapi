<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $category=new Category;
        $category->category=$request->category;
        $category->save();

        return response()->json([
            'message' =>'Category Added successfully',
            'status' =>'success',
            'data' =>Category::where("status","1")->get()
        ]);

    }

    public function index()
    {
        return response()->json([
            'message' =>'Category Fetch successfully',
            'status' =>'success',
            'data' =>Category::where("status","1")->get()
        ]);
    }

    public function singleCategory($id)
    {
        $category=Category::where("cat_id",$id)->first();

        return response()->json([
            'message' =>'Category Fetch successfully',
            'status' =>'success',
            'data' =>$category
        ]);
    }

    public function deleteCategory(Request $request, $id)
    {
        $cat=Category::where("cat_id",$id)->first();
        $cat->status="0";
        $cat->save();

        return response()->json([
            'message' =>'Category Deleted successfully',
            'status' =>'success',
            'data' =>Category::where("status","1")->get()
        ]);
        
    }

    public function updateCategory(Request $request, $id)
    {
        $cat=Category::where("cat_id",$id)->first();
       $cat->category=$request->input("category");
        $cat->save();

        return response()->json([
            'message' =>'Category Updated successfully',
            'status' =>'success',
            'data' =>Category::where("status","1")->get()
        ]);
    }

}

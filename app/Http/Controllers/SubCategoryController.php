<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function store(Request $request)
    {
        $subcat=new SubCategory;
        $subcat->cat_id=$request->cat_id;
        $subcat->subcat_name=$request->subcat_name;
        $subcat->save();

        return response()->json([
            'message' =>'Sub-category Added successfully',
            'status' =>'success',
            'data' =>SubCategory::where("status","1")->get()
        ]);
    }

    public function index()
    {
        return response()->json([
            'message' =>'Data Fetch successfully',
            'status' =>'success',
            'data' =>SubCategory::where("status","1")->get()
        ]);
    }

    public function singleSubCategory($id)
    {
        $subcategory=SubCategory::where("subcat_id",$id)->first();

        return response()->json([
            'message' =>'Data Fetch successfully',
            'status' =>'success',
            'data' =>$subcategory
        ]);
    }

    public function deleteSubCategory(Request $request, $id)
    {
        $cat=SubCategory::where("subcat_id",$id)->first();
        $cat->status="0";
        $cat->save();

        return response()->json([
            'message' =>'Data Deleted successfully',
            'status' =>'success',
            'data' =>SubCategory::where("status","1")->get()
        ]);
        
    }

    public function updateSubCategory(Request $request, $id)
    {
        $cat=SubCategory::where("subcat_id",$id)->first();
        $cat->cat_id=$request->input("cat_id");
       $cat->subcat_name=$request->input("subcat_name");
        $cat->save();

        return response()->json([
            'message' =>'Data Updated successfully',
            'status' =>'success',
            'data' =>SubCategory::where("status","1")->get()
        ]);
    }
}

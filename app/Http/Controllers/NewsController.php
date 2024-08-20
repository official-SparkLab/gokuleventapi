<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
class NewsController extends Controller
{
    public function store(Request $request)
    {
        $news=new News;
        $news->headline = $request->headline;
        $news->image=$request->image;
        $news->date = $request->date;
        $news->newsby = $request->newsby;
        $news->category=$request->category;
        $news->tags=$request->tags;
        $news->description=$request->description;
        $news->save();

        return response()->json([
            'message' => 'News Added Successfully',
            'status' => 'success',
            'data' => $news::get()
        ]);
    }

    public function index()
    {
        $news=News::all();

        return response()->json([
            'message'=>'News Fetch Successfully',
            'status' => 'success',
            'data' => $news
        ]);
    }


}

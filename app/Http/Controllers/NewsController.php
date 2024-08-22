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
        $news->status="1";
        $news->save();

        return response()->json([
            'message' => 'News Added Successfully',
            'status' => 'success',
            'data' => $news::where("status","1")->get()
        ]);
    }

    public function index()
    {
        $news=News::where('status','1')->all();

        return response()->json([
            'message'=>'News Fetch Successfully',
            'status' => 'success',
            'data' => $news
        ]);
    }

    public function UpdateNews(Request $request,$id)
{
        $news=News::where('nid',$id)->first();
        $news->headline = $request->input('headline');
        $news->image = $request->input('image');
        $news->date = $request->input('date');
        $news->newsby = $request->input('newsby');
        $news->category = $request->input('category');
        $news->tags = $request->input('tags');
        $news->description = $request->input('description');
        $news->save();

        return response()->json([
            'message' => 'News Updated Successfully',
            'status' => 'success',
            'data' => $news::where("status","1")->get()
        ]);
}

public function deleteNews(Request $request,$id)
{
    $news=News::where("nid",$id)->first();
    if($news)
    {
    $news->status="0";
    $news->save();

    return response()->json([
        'message' => 'News Deleted Successfully',
        'status' => 'success',
        'data' => $news::where("status","1")->get()
    ]);
}

}

public function getNews($id) {
    $news=News::where("nid",$id)->where('status','1')->first();

    if($news)
    {
    return response()->json([
        'message' => 'Data Search Successfully',
        'status' => 'success',
        'data' => $news
    ]);
}
else
{
    return response()->json([
        'message' => 'Data not found...',
        'status' => 'Failure',
       
    ]);
}
}





}

<?php

namespace App\Http\Controllers;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function store(Request $request)
    {
        $save=new Enquiry;
        $save->fullname=$request->fullname;
        $save->phone=$request->phone;
        $save->email=$request->email;
        $save->message=$request->message;
        $save->save();

        return response()->json([
            'message' => "Enquiry Submited",
            'status' => 'success',
            'data' => $save::get()
        ]);
    }
    public function updateEnquiry(Request $request,$id)
    {
        $save=Enquiry::where("enq_id",$id)->first();
        if($save)
        {
            $save->status="Completed";
            $save->save();

        }
        return response()->json([
            'message' =>'Enquiry Updated Successfully',
            'status'=>'Successful',
            'data'=>Enquiry::get()
        ]);
    }

    public function index()
    {
        return response()->json([
            'message' =>'Enquiry Fetched Successfully',
            'status'=>'Successful',
            'data'=>Enquiry::get()
        ]);
    }

    public function getEnquiry($id)
    {
        return response()->json([
            'message' =>'Enquiry Fetched Successfully',
            'status'=>'Successful',
            'data'=>Enquiry::where("enq_id",$id)->first()
        ]);
    }
}

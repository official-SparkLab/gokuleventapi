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
}

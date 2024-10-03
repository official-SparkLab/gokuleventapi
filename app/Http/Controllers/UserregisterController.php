<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userregister;
use Illuminate\Support\Facades\Hash;
class UserregisterController extends Controller
{
    public function store(Request $request)
    {
        
        try {
            // Save the data
            $signup = new UserRegister();
            $signup->fullname = $request->fullname;
            $signup->email = $request->email;
            $signup->contact = $request->contact;
            $signup->address = $request->address;
            $signup->pincode = $request->pincode;
            $signup->pass = $request->pass;  // Encrypting the password
            $signup->save();
    
            return response()->json([
                'message' => 'User registered successfully',
                'status' => 'success'
            ], 201);
    
        } catch (Exception $e) {
            // Catch any exception and return an error message
            return response()->json([
                'message' => 'Failed to register user',
                'status' => 'error',
                'error' => $e->getMessage()
            ], 500);
        }
    } 

    public function update(Request $request, $id)
{
    try {
        // Find the user by ID
        $signup = UserRegister::findOrFail($id);

        // Update the user details
        $signup->fullname = $request->fullname;
        $signup->email = $request->email;
        $signup->contact = $request->contact;
        $signup->address = $request->address;
        $signup->pincode = $request->pincode;

        // Only update password if it's provided in the request
        if ($request->has('pass')) {
            $signup->pass = $request->pass;
        }

        // Save the changes
        $signup->save();

        return response()->json([
            'message' => 'User updated successfully',
            'status' => 'success'
        ], 200);

    } catch (Exception $e) {
        // Catch any exception and return an error message
        return response()->json([
            'message' => 'Failed to update user',
            'status' => 'error',
            'error' => $e->getMessage()
        ], 500);
    }
}


    public function index()
    {
        return response()->json([
            'message' =>"Data Fetch Successfully",
            'status' =>'success',
            'data' =>UserRegister::get()
         ]);
    }

    public function userById($reg_id)
    {
        return response()->json([
            'message' => "Data Fetch Successfully",
            'status' => 'success',
            'data' => UserRegister::where("id", $reg_id)->get()
        ]);
    }
    

    public function Login(Request $request)
    {
        $user = UserRegister::where('email', $request->email)->first();

        // Check if user exists and password matches
        if ($user && $user->pass === $request->pass) {
            // Successful login
            return response()->json([
                'message' => 'Login successful',
                'status' => 'success',
                'data' => [
                    'id' => $user->id,
                    'fullname' => $user->fullname,
                    'email' => $user->email,
                    'contact' => $user->contact,
                    'address' => $user->address,
                    'pincode' => $user->pincode,
                ]
            ], 200);
        } else {
            // Invalid credentials
            return response()->json([
                'message' => 'Invalid credentials',
                'status' => 'error',
                'data' => null
            ], 401);
        }
    }
}

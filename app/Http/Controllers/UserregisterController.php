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

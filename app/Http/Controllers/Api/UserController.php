<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\loginUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Hash;

class UserController extends Controller
{
    public function createUser(CreateUserRequest $request)
    {
        // create user 
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'confirmpassword'=>$request->confirmpassword,
        ]);
        return response()->json([
            'status'=>true,
            'message'=> 'user created successfully',
        ],200);
    }
    public function loginUser(loginUserRequest $request)
    {
        // login user 
        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => false,
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }
        $user = User::where('email', $request->email)->first();
        return response()->json([
            'status' => true,
            'message' => 'User Logged In Successfully',
            'token' => $user->createToken('api token')->plainTextToken,
        ], 200);
    }
}

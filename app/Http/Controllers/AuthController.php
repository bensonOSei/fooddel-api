<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // attempt login
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        // generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        // return user with token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 200);
    }

    public function register(StoreUserRequest $request)
    {

        // hash password
        $request->merge([
            'password' => bcrypt($request->password)
        ]);
        
        // sign up user
        $user = User::create($request->validated());

        // generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        // return user with token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => UserResource::make($user),
        ], 201);
    }

    public function logout()
    {
        // delete token
        auth()->user()->tokens()->delete();

        // return message
        return response()->json([
            'message' => 'Logged out'
        ], 200);
    }


}

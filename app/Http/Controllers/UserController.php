<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Database\Eloquent\Collection<User>
     */
    public function index()
    {
        // check if user is admin
        if(auth()->user()->role !== 'admin') {
            return response()->json([
                'message' => 'You are not authorized to view this resource'
            ], 403);
        }
        
        return User::all();
    }



    /**
     * Store a newly created resource in storage.
     * 
     * @param \App\Http\Requests\StoreUserRequest $request
     */
    public function store(StoreUserRequest $request)
    {
        // sign up user
        $user = User::create($request->validated());
        
        // generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        // return user with token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

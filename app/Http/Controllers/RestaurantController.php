<?php

namespace App\Http\Controllers;

use App\Filters\RestaurantFilter;
use App\Http\Resources\RestaurantCollection;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new RestaurantFilter();
        $queryItems = $filter->transform($request);

        $addMenu = $request->query('addMenu');
        $restaurants = Restaurant::where($queryItems);
        if ($addMenu) {
            $restaurants->with('menus');
        }

        return new RestaurantCollection($restaurants->paginate()
            ->appends($request->query()));
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function create(StoreRestaurantRequest $request)
    {
        // check if user is logged in
        if (!auth()->user()) {
            return response()->json([
                'message' => 'You are not logged in'
            ], 403);
        }

        // check if user is admin
        if (auth()->user()->role !== 'admin') {
            return response()->json([
                'message' => 'You are not authorized to perform this action'
            ], 403);
        }

        $userId = auth()->user()->id;

        // dd($userId);
        // check if user already has a restaurant
        if (auth()->user()->restaurant_id) {
            return response()->json([
                'message' => 'You already have a restaurant'
            ], 403);
        }

        // create restaurant and add user as owner
        $restaurant = Restaurant::create([
            'name' => $request->input('name'),
            'city' => $request->input('city'),
            'region' => $request->input('region'),
            'contact' => $request->input('contact'),
            'user_id' => $userId,
        ]);
        

        // assign restaurant to user
        User::where('id', auth()->user()->id)
            ->update(['restaurant_id' => $restaurant->id]);
        
        return new RestaurantResource($restaurant);

    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $Restaurant)
    {
        $addMenu = request()->query('addMenu');
        $owner = request()->query('owner');

        if ($addMenu) {
            return new RestaurantResource($Restaurant->loadMissing('menus'));
        }

        if ($owner) {
            return new RestaurantResource($Restaurant->loadMissing('owner'));
        }

        return new RestaurantResource($Restaurant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $Restaurant)
    {
        // check if user is logged in
        if (!auth()->user()) {
            return response()->json([
                'message' => 'You are not logged in'
            ], 403);
        }

        // check if user is admin
        if (auth()->user()->role !== 'admin') {
            return response()->json([
                'message' => 'You are not authorized to perform this action'
            ], 403);
        }

        // check if user is updating their own restaurant
        if (auth()->user()->restaurant_id !== $Restaurant->id) {
            return response()->json([
                'message' => 'You are not authorized to perform this action'
            ], 403);
        }
        
        $Restaurant->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $Restaurant)
    {
        //
    }
}

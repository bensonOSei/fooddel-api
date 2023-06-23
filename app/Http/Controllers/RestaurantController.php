<?php

namespace App\Http\Controllers;

use App\Filters\RestaurantFilter;
use App\Http\Resources\RestaurantCollection;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
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
        // dd($queryItems);
        if(count($queryItems)) {
            $restaurants = Restaurant::where($queryItems)->paginate('10');
            return new RestaurantCollection($restaurants->appends($request->query()));
        }

        return new RestaurantCollection(Restaurant::paginate());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $Restaurant)
    {
        return new RestaurantResource($Restaurant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $Restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $Restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $Restaurant)
    {
        //
    }
}

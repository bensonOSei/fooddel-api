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

        $addMenus = $request->query('addMenus');
        $restaurants = Restaurant::where($queryItems);
        if ($addMenus) {
            $restaurants->with('menus');
        }

        return new RestaurantCollection($restaurants->paginate()
            ->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {
        return new RestaurantResource(Restaurant::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $Restaurant)
    {
        return new RestaurantResource($Restaurant);
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

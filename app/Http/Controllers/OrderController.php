<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\MenuItems;
use App\Models\OrderItems;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Restaurant $restaurant, Request $request)
    {
        $orders = $restaurant->orders;

        return new OrderCollection($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(StoreOrderRequest $request)
    {
        $items = $request->input('items');
        $orderItems = [];
        $total = 0;
        foreach ($items as $item) {
            $orderItems[] = [
                'menu_id' => $item['menu_item_id'],
                'quantity' => $item['quantity'],
                'price' => MenuItems::find($item['menu_item_id'])->price,
            ];
            $total += MenuItems::find($item['menu_item_id'])->price * $item['quantity'];
        }

        $order = Order::create([
            'restaurant_id' => $request->input('restaurant_id'),
            'user_id' => $request->input('user_id'),
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($orderItems as $orderItem) {
            OrderItems::create([
                'order_id' => $order->id,
                'menu_id' => $orderItem['menu_id'],
                'quantity' => $orderItem['quantity'],
                'price' => $orderItem['price'],
            ]);
        }

        return new OrderResource(Order::find($order->id));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    public function fulfill(Order $order)
    {
        $order->status = 'fulfilled';
        $order->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}

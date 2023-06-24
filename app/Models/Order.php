<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    
    /**
     * Order belong to a user.
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Order belongs to a restaurant.
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * Order has many order items.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    /**
     * Order has one delivery.
     */
    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    /**
     * Order has one payment.
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }


}

<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public function menuItems()
    {
        return $this->hasMany(MenuItems::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}

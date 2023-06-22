<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    public function menuItems()
    {
        return $this->hasMany(MenuItems::class);
    }

    public function orders()
    {
        return $this->hasMany(Orders::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function Restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function users()
    {
        return $this->belongsTo(Users::class);
    }
    

}
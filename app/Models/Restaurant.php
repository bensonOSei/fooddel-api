<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'region',
        'contact',
    ];

    public function menuItems()
    {
        return $this->hasMany(MenuItems::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function users()
    {
        return $this->belongsTo(Users::class);
    }
    

}

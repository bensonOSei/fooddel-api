<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Restaurant::factory()
            ->count(20)
            ->hasOrders(4)
            ->hasMenus(10)
            ->hasMenuItems(20)
            ->create();
    }
}

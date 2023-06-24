<?php

namespace App\Http\Resources;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'restaurant' => Restaurant::find($this->restaurant_id)->name,
            'name' => $this->name,
            'description' => $this->description,
            'menu_items' => MenuItemsCollection::make($this->whenLoaded('menuItems')),
        ];
    }
}

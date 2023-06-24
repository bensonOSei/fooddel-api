<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $userFirstName = User::find($this->user_id)->first_name;
        $userLastName = User::find($this->user_id)->last_name;
        $userFullName = "$userFirstName $userLastName";

        return [
            'id' => $this->id,
            'user_id' => $userFullName,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'total' => $this->total,
        ];
    }
}

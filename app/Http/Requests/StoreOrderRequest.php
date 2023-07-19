<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'restaurant_id' => 'required|exists:restaurants,id',
            'user_id' => 'required|exists:users,id',
            'items' => 'required|array',
            'items.*.menu_item_id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'restaurant_id.required' => 'A restaurant is required',
            'restaurant_id.exists' => 'The selected restaurant does not exist',
            'user_id.required' => 'A user is required',
            'user_id.exists' => 'The selected user does not exist',
            'items.required' => 'Items are required',
            'items.array' => 'Items must be an array',
            'items.*.menu_item_id.required' => 'A menu item is required',
            'items.*.menu_item_id.exists' => 'The selected menu item does not exist',
            'items.*.quantity.required' => 'A quantity is required',
            'items.*.quantity.integer' => 'Quantity must be an integer',
            'items.*.quantity.min' => 'Quantity must be at least 1',
        ];
    }

}

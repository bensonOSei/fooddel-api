<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
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
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                'name' => 'required|string',
                'city' => 'required|string',
                'region' => 'required|string',
                'contact' => 'required|string',
            ];
        }

        return [
            'name' => 'sometimes|required|string',
            'city' => 'sometimes|required|string',
            'region' => 'sometimes|required|string',
            'contact' => 'sometimes|required|string | unique:restaurants',
        ];
    }
}

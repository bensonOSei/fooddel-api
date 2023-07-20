<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['nullable', 'string', 'max:20', 'in:customer,admin'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'restaurant_id' => ['nullable', 'integer', 'exists:restaurants,id'],
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
            'first_name.required' => 'A first name is required',
            'last_name.required' => 'A last name is required',
            'email.required' => 'An email is required',
            'password.required' => 'A password is required',
            'password.min' => 'Password must be at least 8 characters long',
            'password.confirmed' => 'Passwords do not match',
            'email.unique' => 'Email already exists',
            'email.email' => 'Email must be a valid email address',
            'role.in' => 'Role must be either customer or admin',
            'restaurant_id.integer' => 'Restaurant ID must be an integer',
            'restaurant_id.exists' => 'Restaurant ID must exist in the restaurants table',
            'phone_number.max' => 'Phone number must be less than 20 characters long',
        ];
    }
}

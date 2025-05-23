<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:8|confirmed',
            'zipcode' => 'required|string',
            'addressone' => 'required|string',
            'addresstwo' => 'nullable|string',
            'phone_number' => 'required|string',
            'role_id' => 'required|integer|exists:roles,id'
        ];

        if (request('role_id') == 3) { // Assuming 2 is the doctor role_id
            $rules['category_id'] = 'required|integer|exists:categories,id';
        }

        return $rules;

    }
}

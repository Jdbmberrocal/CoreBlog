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
            "name" => "required|string|min:3|max:150",
            "lastname" => "required|string|min:2|max:150",
            "username" => "required|min:5|max:15|alpha_num",
            "imagen" => "sometimes|image|size:5120",
            "email" => "required|email|max:255|unique:users,email",
            "password" => "required|string|min:8",
            "estado" => "required|in:activo,inactivo",
        ];
    }

    public function messages(): array
{
    return [
        'email.unique' => 'El correo ya está en uso',
    ];
}
}

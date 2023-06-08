<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            "name" => "sometimes|string|min:3|max:150",
            "lastname" => "sometimes|string|min:2|max:150",
            "username" => "sometimes|min:5|max:15|alpha_num",
            "imagen" => "sometimes|image|size:5120",
            "email" => "sometimes|email|max:255|unique:users,email,".$this->id,
            "password" => "sometimes|string|min:8",
            "estado" => "sometimes|in:activo,inactivo",
        ];
    }
}

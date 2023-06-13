<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description'=> 'string|max:255',
            'meta_tags'=> 'string|max:255',
            'meta_description'=>'string|max:255',
            'image'=> 'size:2048|image|mimes:png,jpg',
            'content' => 'required',
            'status' =>'required|in:publicado,borrador,inactivo',
            'user_id' => 'required|exists:users,id|numeric',
            'category_id' => 'required|exists:category,id|numeric'
        ];
    }
}

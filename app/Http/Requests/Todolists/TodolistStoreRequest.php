<?php

namespace App\Http\Requests\Todolists;

use Illuminate\Foundation\Http\FormRequest;

class TodolistStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:5',
            'description' => 'required|string|min:20',
            // 'user_id' => 'number|exists:users,id'  will be the authenticated person so no need for it.
        ];
    }
}

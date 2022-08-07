<?php

namespace App\Http\Requests\Tokens;

use Illuminate\Foundation\Http\FormRequest;

class UserTokenRequest extends FormRequest
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
            'token_name' => 'required|string|min:2'
        ];
    }
}
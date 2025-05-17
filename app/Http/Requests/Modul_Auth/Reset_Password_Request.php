<?php

namespace App\Http\Requests\Modul_Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class Reset_Password_Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Changed to true to allow requests
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'token' => ['required'],
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}

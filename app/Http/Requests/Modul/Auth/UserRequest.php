<?php

namespace App\Http\Requests\Modul\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Changed to true to allow the request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required', 
                'string', 
                'max:255',
                'alpha_dash',
                Rule::unique('users')->ignore($this->user)
            ],
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255',
                Rule::unique('users')->ignore($this->user)
            ],
            'usertype' => ['required', 'in:user,dev'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
        
        // Add password rules for create or if password is being updated
        if ($this->isMethod('post') || $this->filled('password')) {
            $rules['password'] = [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase() 
                    ->numbers()
                    ->symbols(),
                'confirmed'
            ];
        }
        
        return $rules;
    }
}

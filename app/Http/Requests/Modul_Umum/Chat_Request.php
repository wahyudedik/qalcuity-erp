<?php

namespace App\Http\Requests\Modul_Umum;

use Illuminate\Foundation\Http\FormRequest;

class Chat_Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool 
    {
        return true; // Changed to true to allow authorized users
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [];
        
        // Rules for different actions
        switch ($this->route()->getName()) {
            case 'chat.send':
                $rules = [
                    'content' => 'required_without:file|string|max:10000',
                    'file' => 'nullable|file|max:10240', // 10MB max
                ];
                break;
                
            case 'chat.create-group':
                $rules = [
                    'name' => 'required|string|max:255',
                    'participants' => 'required|array|min:1',
                    'participants.*' => 'required|uuid|exists:users,id'
                ];
                break;
                
            case 'chat.add-participants':
                $rules = [
                    'user_ids' => 'required|array|min:1',
                    'user_ids.*' => 'exists:users,id',
                ];
                break;
        }
        
        return $rules;
    }
    
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'content.required_without' => 'Please enter a message or attach a file.',
            'file.max' => 'The file size must not exceed 10MB.',
        ];
    }
}

<?php

namespace App\Http\Requests\Modul\Branch;

use Illuminate\Foundation\Http\FormRequest;

class UserAssignmentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_ids' => ['required', 'array', 'min:1'],
            'user_ids.*' => ['exists:users,id'],
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
            'user_ids.required' => 'Pilih minimal satu pengguna untuk ditugaskan.',
            'user_ids.array' => 'Format data pengguna tidak valid.',
            'user_ids.min' => 'Pilih minimal satu pengguna untuk ditugaskan.',
            'user_ids.*.exists' => 'Pengguna yang dipilih tidak valid.',
        ];
    }
}

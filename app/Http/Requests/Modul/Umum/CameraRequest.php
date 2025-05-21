<?php

namespace App\Http\Requests\Modul\Umum;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CameraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Check if user has permission to manage cameras
        // return $this->user()->can('manage-cameras');
        return true;
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
            'ip_address' => ['required', 'string', 'ip'],
            'port' => ['required', 'integer', 'between:1,65535'],
            'rtsp_url' => ['nullable', 'string', 'url'],
            'http_url' => ['nullable', 'string', 'url'],
            'username' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'branch_id' => ['nullable', 'exists:branches,id'],
        ];

        // If this is an update request, ensure unique validation includes the current record
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['ip_address'][] = Rule::unique('cameras')->ignore($this->route('camera'));
        } else {
            $rules['ip_address'][] = 'unique:cameras,ip_address';
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'Camera Name',
            'ip_address' => 'IP Address',
            'port' => 'Port',
            'rtsp_url' => 'RTSP URL',
            'http_url' => 'HTTP URL',
            'username' => 'Username',
            'password' => 'Password',
            'location' => 'Location',
            'description' => 'Description',
            'is_active' => 'Active Status',
            'branch_id' => 'Branch',
        ];
    }
}

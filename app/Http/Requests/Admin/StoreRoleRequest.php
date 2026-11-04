<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('manage-rbac') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:100', 'unique:roles,slug'],
            'description' => ['nullable', 'string'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,id'],
            'status' => ['nullable', 'string', 'in:published,draft'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama peran wajib diisi.',
            'name.max' => 'Nama peran tidak boleh lebih dari 255 karakter.',
            'slug.unique' => 'Slug peran sudah digunakan, silakan pilih yang lain.',
            'permissions.*.exists' => 'Hak akses yang dipilih tidak valid atau tidak ditemukan.',
            'status.in' => 'Status hanya boleh bernilai published atau draft.',
        ];
    }
}

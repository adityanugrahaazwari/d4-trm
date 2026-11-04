<?php

namespace App\Http\Requests\Admin;

use App\Models\Permission;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends FormRequest
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
        /** @var Permission|null $permission */
        $permission = $this->route('permission');

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:100', Rule::unique('permissions', 'slug')->ignore($permission?->id)],
            'module' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
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
            'name.required' => 'Nama hak akses wajib diisi.',
            'name.max' => 'Nama hak akses tidak boleh lebih dari 255 karakter.',
            'slug.unique' => 'Slug hak akses sudah terdaftar, silakan gunakan yang lain.',
            'module.required' => 'Modul wajib ditentukan.',
            'status.in' => 'Status hanya boleh bernilai published atau draft.',
        ];
    }
}

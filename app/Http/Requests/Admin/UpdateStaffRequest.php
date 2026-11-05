<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:dosen,tendik'],
            'nip' => ['nullable', 'string', 'max:100'],
            'nidn' => ['nullable', 'string', 'max:100'],
            'nip_nidn' => ['nullable', 'string', 'max:100'],
            'position' => ['nullable', 'string', 'max:255'],
            'academic_degree' => ['nullable', 'string', 'max:100'],
            'expertise' => ['nullable', 'string', 'max:255'],
            'education' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'bio' => ['nullable', 'string'],
            'photo' => ['nullable', 'string', 'max:255'],
            'photo_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama dosen atau tenaga kependidikan wajib diisi.',
            'type.required' => 'Jenis staf (dosen/tendik) wajib dipilih.',
            'email.email' => 'Format alamat email tidak valid.',
        ];
    }
}

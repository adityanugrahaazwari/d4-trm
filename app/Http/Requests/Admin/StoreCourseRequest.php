<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'curriculum_id' => ['required', 'exists:curricula,id'],
            'code' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:255'],
            'theory_credits' => ['required', 'integer', 'min:0'],
            'practice_credits' => ['required', 'integer', 'min:0'],
            'semester' => ['required', 'integer', 'min:1', 'max:8'],
            'is_mandatory' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string'],
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCurriculumRequest extends FormRequest
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
            'year' => ['required', 'string', 'max:10'],
            'description' => ['nullable', 'string'],
            'total_credits' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'in:0,1,true,false,published,draft'],
        ];
    }
}

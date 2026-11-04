<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCplRequest extends FormRequest
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
            'code' => ['required', 'string', 'max:50'],
            'category' => ['required', 'in:Sikap,Keterampilan Umum,Keterampilan Khusus,Pengetahuan'],
            'description' => ['required', 'string'],
            'order' => ['nullable', 'integer'],
        ];
    }
}

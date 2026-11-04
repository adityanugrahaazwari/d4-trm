<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEventRequest extends FormRequest
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
        $eventId = $this->route('event')?->id ?? $this->route('event');

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('events', 'slug')->ignore($eventId)],
            'description' => ['nullable', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'start_time' => ['nullable', 'string', 'max:50'],
            'end_time' => ['nullable', 'string', 'max:50'],
            'speaker' => ['nullable', 'string', 'max:255'],
            'registration_url' => ['nullable', 'url', 'max:255'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul agenda wajib diisi.',
            'location.required' => 'Lokasi kegiatan wajib diisi.',
            'event_date.required' => 'Tanggal pelaksanaan wajib diisi.',
        ];
    }
}

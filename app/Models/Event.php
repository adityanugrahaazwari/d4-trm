<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'event_date',
        'start_time',
        'end_time',
        'speaker',
        'registration_url',
        'image',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
        ];
    }

    public function getDayAttribute(): string
    {
        return $this->event_date ? $this->event_date->format('d') : '01';
    }

    public function getMonthAttribute(): string
    {
        return $this->event_date ? $this->event_date->format('M') : 'BLN';
    }

    public function getTimeAttribute(): string
    {
        return ($this->start_time ?? '09:00').' - '.($this->end_time ?? 'Selesai');
    }

    public function getLocAttribute(): string
    {
        return (string) $this->location;
    }

    public function getTagAttribute(): string
    {
        return 'Agenda';
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->whereIn('status', ['published', 'Pendaftaran Dibuka', 'Segera Dibuka'])
            ->where('event_date', '>=', now()->toDateString())
            ->orderBy('event_date', 'asc');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereIn('status', ['published', 'Pendaftaran Dibuka', 'Segera Dibuka']);
    }
}

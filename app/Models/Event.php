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
        return $this->event_date ? strtoupper($this->event_date->translatedFormat('M')) : 'BLN';
    }

    public function getDateFormattedAttribute(): string
    {
        return $this->event_date ? $this->event_date->translatedFormat('l, d F Y') : 'Jadwal Resmi';
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

    public function getIsUpcomingAttribute(): bool
    {
        return $this->event_date ? $this->event_date->isFuture() || $this->event_date->isToday() : false;
    }

    public function getGoogleCalendarUrlAttribute(): string
    {
        $title = urlencode($this->title);
        $details = urlencode(strip_tags((string) ($this->description ?? 'Agenda Kegiatan Program Studi D-IV TRM POLITALA')));
        $location = urlencode((string) $this->location);
        $date = $this->event_date ? $this->event_date->format('Ymd') : date('Ymd');
        $startTime = str_replace([':', ' ', 'WITA', 'WIB', 'WIT', '.'], '', $this->start_time ?? '0900');
        $startTime = str_pad(substr($startTime, 0, 4), 4, '0').'00';
        $endTime = str_replace([':', ' ', 'WITA', 'WIB', 'WIT', '.'], '', $this->end_time ?? '1500');
        $endTime = str_pad(substr($endTime, 0, 4), 4, '0').'00';
        $dates = "{$date}T{$startTime}/{$date}T{$endTime}";

        return "https://calendar.google.com/calendar/render?action=TEMPLATE&text={$title}&dates={$dates}&details={$details}&location={$location}";
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('status', '!=', 'draft')
            ->where('event_date', '>=', now()->toDateString())
            ->orderBy('event_date', 'asc');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', '!=', 'draft');
    }
}

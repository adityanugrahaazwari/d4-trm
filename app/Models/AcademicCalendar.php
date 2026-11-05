<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicCalendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'academic_year',
        'semester',
        'start_date',
        'end_date',
        'file_url',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('start_date', 'asc');
    }

    public function scopeSemester(Builder $query, ?string $semester): Builder
    {
        if (empty($semester) || $semester === 'semua' || $semester === 'all') {
            return $query;
        }

        return $query->where(function (Builder $q) use ($semester) {
            $q->where('semester', $semester)->orWhere('semester', 'semua');
        });
    }

    public function scopeAcademicYear(Builder $query, ?string $year): Builder
    {
        if (empty($year)) {
            return $query;
        }

        return $query->where('academic_year', $year);
    }

    public function getFormattedPeriodAttribute(): string
    {
        if (! $this->start_date) {
            return 'Jadwal segera diumumkan';
        }

        $startStr = $this->start_date->translatedFormat('d M Y');

        if (! $this->end_date || $this->start_date->equalTo($this->end_date)) {
            return $startStr;
        }

        $endStr = $this->end_date->translatedFormat('d M Y');

        return "{$startStr} – {$endStr}";
    }

    public function getIsOngoingAttribute(): bool
    {
        if (! $this->start_date) {
            return false;
        }

        $today = now()->startOfDay();
        $start = $this->start_date->startOfDay();
        $end = ($this->end_date ?? $this->start_date)->endOfDay();

        return $today->between($start, $end);
    }
}

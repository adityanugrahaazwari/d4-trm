<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'curriculum_id',
        'code',
        'name',
        'semester',
        'sks',
        'theory_sks',
        'practical_sks',
        'type',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'semester' => 'integer',
            'sks' => 'integer',
            'theory_sks' => 'integer',
            'practical_sks' => 'integer',
        ];
    }

    public function curriculum(): BelongsTo
    {
        return $this->belongsTo(Curriculum::class);
    }

    public function scopeSemester(Builder $query, int $semester): Builder
    {
        return $query->where('semester', $semester);
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if (empty($search)) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhere('code', 'like', "%{$search}%")
                ->orWhere('type', 'like', "%{$search}%");
        });
    }

    public function getTotalSksAttribute(): int
    {
        if ($this->sks > 0) {
            return $this->sks;
        }

        return (int) ($this->theory_sks + $this->practical_sks);
    }
}

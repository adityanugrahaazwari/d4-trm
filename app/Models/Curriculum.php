<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curricula';

    protected $fillable = [
        'name',
        'code',
        'year',
        'total_sks',
        'total_credits',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'total_sks' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class)->orderBy('semester')->orderBy('code');
    }

    public function getTotalCreditsAttribute(): int
    {
        return (int) ($this->total_sks ?? 144);
    }

    public function setTotalCreditsAttribute($value): void
    {
        $this->attributes['total_sks'] = $value;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduateProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'career_roles',
        'career_prospects',
        'icon',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'order' => 'integer',
        ];
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Alias accessor for career_prospects mapping to career_roles
     */
    public function getCareerProspectsAttribute(): ?string
    {
        return $this->career_roles;
    }

    /**
     * Alias mutator for career_prospects mapping to career_roles
     */
    public function setCareerProspectsAttribute(?string $value): void
    {
        $this->attributes['career_roles'] = $value;
    }

    /**
     * @return array<int, string>
     */
    public function getCareerRolesListAttribute(): array
    {
        $roles = $this->career_roles;
        if (empty($roles)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $roles))));
    }
}

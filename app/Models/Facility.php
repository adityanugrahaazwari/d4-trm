<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'specifications',
        'capacity',
        'image',
        'is_active',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'order' => 'integer',
            'capacity' => 'integer',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function getSpecsAttribute(): string
    {
        return $this->specifications ?? 'Workstation Core i7/Ryzen, RTX GPU, High-Res Monitor';
    }

    public function getSoftwareAttribute(): string
    {
        return 'Unreal Engine 5, Blender 4, Unity, Adobe Creative Suite';
    }
}

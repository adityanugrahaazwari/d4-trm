<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpl extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'category',
        'description',
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
        return $query->orderBy('order', 'asc')->orderBy('code', 'asc');
    }

    public function getCategoryLabelAttribute(): string
    {
        $cat = strtolower(trim($this->category ?? ''));

        return match ($cat) {
            'sikap' => 'Sikap & Tata Nilai',
            'pengetahuan' => 'Penguasaan Pengetahuan',
            'keterampilan_umum' => 'Keterampilan Umum',
            'keterampilan_khusus' => 'Keterampilan Khusus',
            default => ucwords(str_replace('_', ' ', $this->category ?? 'Umum')),
        };
    }

    public function getCategoryBadgeAttribute(): string
    {
        $cat = strtolower(trim($this->category ?? ''));

        return match ($cat) {
            'sikap' => 'bg-blue-50 text-blue-700 border-blue-200',
            'pengetahuan' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'keterampilan_umum' => 'bg-amber-50 text-amber-700 border-amber-200',
            'keterampilan_khusus' => 'bg-purple-50 text-purple-700 border-purple-200',
            default => 'bg-slate-100 text-slate-700 border-slate-200',
        };
    }
}

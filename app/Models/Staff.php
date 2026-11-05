<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'name',
        'type',
        'nip_nidn',
        'position',
        'expertise',
        'education',
        'email',
        'phone',
        'photo',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'order' => 'integer',
        ];
    }

    public function scopeLecturers(Builder $query): Builder
    {
        return $query->where('type', 'dosen');
    }

    public function scopeTendik(Builder $query): Builder
    {
        return $query->where('type', 'tendik');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function (Builder $q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhere('nip_nidn', 'like', "%{$search}%")
                ->orWhere('position', 'like', "%{$search}%")
                ->orWhere('expertise', 'like', "%{$search}%")
                ->orWhere('education', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        });
    }

    public function getNipAttribute(): string
    {
        return (string) ($this->nip_nidn ?? '-');
    }

    public function getNidnAttribute(): ?string
    {
        return $this->nip_nidn;
    }

    public function getPhotoUrlAttribute(): ?string
    {
        if (empty($this->photo)) {
            return null;
        }

        if (str_starts_with($this->photo, 'http://') || str_starts_with($this->photo, 'https://') || str_starts_with($this->photo, '/')) {
            return $this->photo;
        }

        return '/storage/'.$this->photo;
    }

    public function getRoleAttribute(): string
    {
        return (string) ($this->position ?? ($this->type === 'dosen' ? 'Dosen Pengajar' : 'Tenaga Kependidikan'));
    }

    public function getUnitAttribute(): string
    {
        return (string) ($this->position ?? 'Tenaga Kependidikan');
    }

    public function getDescAttribute(): string
    {
        return (string) ($this->expertise ?? 'Layanan akademik dan operasional sarana laboratorium prodi.');
    }
}

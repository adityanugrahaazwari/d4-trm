<?php

namespace App\Models;

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
}

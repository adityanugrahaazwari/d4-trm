<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudyProgramProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'section',
        'title',
        'content',
        'meta',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'meta' => 'array',
        ];
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public static function forSection(string $section): ?self
    {
        return static::where('section', $section)->first();
    }
}

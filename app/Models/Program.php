<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;

    public const LEVELS = [
        'Certificate',
        'Diploma',
        'Undergraduate',
        'Postgraduate',
    ];

    public const FORMATS = [
        'On-Campus',
        'Online',
        'Hybrid',
    ];

    protected $fillable = [
        'department_id',
        'title',
        'slug',
        'level',
        'formats',
        'duration',
        'next_intake',
        'accreditation',
        'summary',
        'overview',
        'modules',
        'entry_requirements',
        'student_packages',
        'is_featured',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'formats' => 'array',
            'modules' => 'array',
            'entry_requirements' => 'array',
            'student_packages' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }
}

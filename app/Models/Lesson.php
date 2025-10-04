<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'panda_id',
        'name',
        'slug',
        'description',
        'panda_player_url',
        'panda_thumbnail_url',
        'position',
        'duration',
        'transcription_url',
        'resume'
    ];

    protected function casts(): array
    {
        return [
            'position' => 'integer',
        ];
    }

    /**
     * Get the module that owns this lesson.
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * Get the materials for this lesson.
     */
    public function materials(): HasMany
    {
        return $this->hasMany(LessonMaterial::class)->orderBy('position');
    }

    /**
     * Get the lesson statuses for this lesson.
     */
    public function lessonStatuses(): HasMany
    {
        return $this->hasMany(LessonStatus::class);
    }

    public function userLessonStatus(): HasOne
    {
        return $this->hasOne(LessonStatus::class)->where('user_id', auth()->id());
    }

    /**
     * Get the ratings for this lesson.
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Get the comments for this lesson.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}

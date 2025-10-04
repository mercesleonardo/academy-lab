<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaterialType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Get the lesson materials of this type.
     */
    public function lessonMaterials(): HasMany
    {
        return $this->hasMany(LessonMaterial::class);
    }
}

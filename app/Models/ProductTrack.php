<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductTrack extends Model
{
    use HasFactory;

    protected $table = 'product_track';

    protected $fillable = [
        'product_id',
        'track_id',
        'position',
        'visibility',
    ];

    protected function casts(): array
    {
        return [
            'position' => 'integer',
        ];
    }

    /**
     * Get the product that owns this product track.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the track that belongs to this product track.
     */
    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }

    /**
     * Get the paths associated with this product track.
     */
    public function paths(): BelongsToMany
    {
        return $this->belongsToMany(Path::class)
            ->withPivot('position', 'visibility')
            ->withTimestamps()
            ->orderByPivot('position');
    }

    public function productTrackPaths(): HasMany
    {
        return $this->hasMany(ProductTrackPath::class, 'product_track_id', 'id');
    }
}

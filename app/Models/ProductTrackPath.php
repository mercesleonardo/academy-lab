<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductTrackPath extends Model
{
    use HasFactory;

    protected $table = 'product_track_path';

    protected $fillable = [
        'product_track_id',
        'path_id',
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
     * Get the product track that owns this product track path.
     */
    public function productTrack(): BelongsTo
    {
        return $this->belongsTo(ProductTrack::class, 'product_track_id', 'id');
    }

    /**
     * Get the path that belongs to this product track path.
     */
    public function path(): BelongsTo
    {
        return $this->belongsTo(Path::class);
    }
}

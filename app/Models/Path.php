<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Path extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'cover',
        'duration',
    ];

    protected function casts(): array
    {
        return [
            'position' => 'integer',
        ];
    }

    /**
     * Get the track that owns this path.
     */
    public function productTracks(): BelongsToMany
    {
        return $this->belongsToMany(ProductTrack::class, 'product_track_path', 'path_id', 'product_track_id')
            ->withPivot('position', 'visibility')
            ->withTimestamps()
            ->orderByPivot('position');
    }

    public function productTrackPaths(): HasMany
    {
        return $this->hasMany(ProductTrackPath::class);
    }

    /**
     * Get the modules for this path.
     */
    public function modules(): HasMany
    {
        return $this->hasMany(Module::class)->orderBy('position');
    }

    public function getProductTrackPathId($product_id)
    {
        return Cache::rememberForever('product-id' . $product_id . '-path-id' . $this->id, fn () => DB::table('product_track_path as ptp')
            ->join('product_track as pt', 'pt.id', '=', 'ptp.product_track_id')
            ->where('pt.product_id', $product_id)
            ->where('ptp.path_id', $this->id)
            ->where('ptp.visibility', 'visible')            // opcional, mas recomendável
            ->orderBy('ptp.position')                      // em caso de múltiplos, pega o mais “alto”
            ->value('ptp.id'));
    }
}

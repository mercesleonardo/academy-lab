<?php

namespace App\Policies;

use App\Models\Path;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProductPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Product $product): bool
    {
        return $user->products()
            ->whereKey($product->id)
            ->wherePivot('status', 'active')
            ->where(function ($query) {
                $query->whereNull('product_user.expires_at')
                    ->orWhere('product_user.expires_at', '>', now());
            })
            ->exists();
    }

    public function accessClassRoom(User $user, Product $product, Path $path): bool
    {
        return DB::table('product_user as pu')
            ->join('products as p', 'p.id', '=', 'pu.product_id')
            ->join('product_track as pt', 'pt.product_id', '=', 'p.id')
            ->join('product_track_path as ptp', 'ptp.product_track_id', '=', 'pt.id')
            ->where('pu.user_id', $user->id)
            ->where('pu.product_id', $product->id)
            ->where('pu.status', 'active')
            ->where(function ($q) {
                $q->whereNull('pu.expires_at')
                    ->orWhere('pu.expires_at', '>', now());
            })
            ->where('ptp.path_id', $path->id)
            ->exists();

    }
}

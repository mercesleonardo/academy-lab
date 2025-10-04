<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

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
}

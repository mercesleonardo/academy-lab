<?php

namespace App\Http\Controllers;

use App\Http\Requests\EduzzWebhookRequest;
use App\Models\Product;
use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EduzzWebhookController extends Controller
{
    public function __invoke(EduzzWebhookRequest $request)
    {
        $user = User::where('email', $request->input('data.buyer.email'))
            ->orWhere('document', preg_replace('/\D/', '',  $request->input('data.buyer.document')))
            ->first();

        if (!$user) {
            $user = User::create([
                'email' => $request->input('data.buyer.email'),
                'name' => $request->input('data.buyer.name'),
                'document' => $request->input('data.buyer.document'),
                'phone' => preg_replace('/\D/', '',  $request->input('data.buyer.phone')),
                'password' => bcrypt(Str::uuid())
            ]);
        }

        $product = Product::where('eduzz_id', 2566660)->first()->id;

        if (!$user->products()->where('product_id', $product)->exists()) {
            $user->products()->attach([
                Product::where('eduzz_id', 2566660)->first()->id => [
                    'starts_at' => now(),
                    'expires_at' => now()->addMonths(12)
                ]
            ]);
        }

        $user->notify(new WelcomeNotification($user));

    }
}

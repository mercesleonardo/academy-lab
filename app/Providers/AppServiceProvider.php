<?php

namespace App\Providers;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FilamentAsset::register([
            Js::make('panda-api', 'https://player.pandavideo.com.br/api.v2.js')->loadedOnRequest(),
        ]);

        FilamentAsset::register([
            AlpineComponent::make(
                'panda-player',
                base_path('resources/js/dist/components/panda-player.js'),
            ),
        ]);
    }
}

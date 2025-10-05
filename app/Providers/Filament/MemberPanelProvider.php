<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class MemberPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('member')
            ->path('')
            ->login()
            ->passwordReset()
            ->colors([
                'primary' => "#f44b34",
            ])
            ->brandLogo(asset('logos/logo.png'))
            ->darkModeBrandLogo(asset('logos/logo-white.png'))
            ->brandLogoHeight('60px')
            ->discoverResources(in: app_path('Filament/Member/Resources'), for: 'App\Filament\Member\Resources')
            ->discoverPages(in: app_path('Filament/Member/Pages'), for: 'App\Filament\Member\Pages')
            ->pages([
            ])
            ->discoverWidgets(in: app_path('Filament/Member/Widgets'), for: 'App\Filament\Member\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                $user = auth()->user();

                [$navigationItems,$productItems] = Cache::rememberForever("users-menu-{$user->id}", function() use ($user) {
                    $navigationItems = [
                        NavigationItem::make('Home')
                            ->icon('heroicon-s-home')
                            ->url(route('filament.member.pages.home'))
                    ];

                    $productItems = $user->products()->with('tracks')->get()->map(function ($product) {
                        return NavigationGroup::make($product->name)
                            ->items([
                                    NavigationItem::make("Ver tudo")
                                        ->url(route('filament.member.pages.produto.{product}', $product->id))
                                        ->icon(Heroicon::OutlinedHome),
                                    ...$product->tracks->map(function ($track) {
                                        return NavigationItem::make($track->name)
                                            ->url(route('filament.member.pages.produto.{product}', $track->id))
                                            ->icon(Heroicon::OutlinedHome);
                                    })->all()
                                ]
                            );
                    })->all();

                    return [$navigationItems,$productItems];
                });


                $builder->items($navigationItems);
                $builder->groups($productItems);
                return $builder;
            })
            ->renderHook(PanelsRenderHook::BODY_START, fn(): string => Blade::render('@livewire(\'global-chat\')'))
            ->viteTheme('resources/css/filament/member/theme.css');
    }
}

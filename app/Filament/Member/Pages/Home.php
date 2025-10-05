<?php

namespace App\Filament\Member\Pages;

use App\Models\Product;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Panel;
use Filament\Support\Icons\Heroicon;

class Home extends Page
{

    protected string $view = 'filament.member.pages.home';
    protected static ?string $navigationLabel = 'Home';
    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedHome;
    protected static ?string $title = '';

    public $products = [];

    public function mount(): void
    {
        $this->products = Product::query()->get();
    }

    public static function getRoutePath(Panel $panel): string
    {
        return '';
    }
}

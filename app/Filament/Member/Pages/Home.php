<?php

namespace App\Filament\Member\Pages;

use App\Models\Product;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class Home extends Page
{
    protected string $view = 'filament.member.pages.home';

    protected static ?string $navigationLabel = 'Home';
    protected static ?string $title = '';
    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedHome;

    public $products = [];

    public function mount(): void
    {
        $this->products = Product::all();
    }
}

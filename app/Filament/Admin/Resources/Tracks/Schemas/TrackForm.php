<?php

namespace App\Filament\Admin\Resources\Tracks\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TrackForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('name')
                        ->required(),
                    RichEditor::make('description')
                        ->columnSpanFull(),
                ])->columns(2)
            ])->columns(1);
    }
}

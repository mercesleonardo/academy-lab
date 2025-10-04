<?php

namespace App\Filament\Resources\Tracks\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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

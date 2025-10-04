<?php

namespace App\Filament\Resources\Modules\Schemas;

use App\Filament\Resources\Modules\Pages\CreateModule;
use App\Filament\Resources\Modules\Pages\EditModule;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ModuleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    Select::make('path_id')
                        ->relationship('path', 'name')
                        ->default(fn (EditModule|CreateModule|RelationManager $livewire) => $livewire instanceof RelationManager
                            ? $livewire->getOwnerRecord()->getKey()
                            : null)
                        ->disabled(fn (EditModule|CreateModule|RelationManager $livewire) => $livewire instanceof RelationManager)
                        ->required(),
                    TextInput::make('name')
                        ->required(),
                    RichEditor::make('description')
                        ->required()
                        ->columnSpanFull(),
                    TextInput::make('position')
                        ->required()
                        ->numeric(),
                    TextInput::make('duration')
                        ->numeric(),
                ])->columns(2)
            ])->columns(1);
    }
}

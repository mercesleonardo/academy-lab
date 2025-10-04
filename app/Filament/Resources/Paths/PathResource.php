<?php

namespace App\Filament\Resources\Paths;

use App\Filament\Resources\Paths\Pages\CreatePath;
use App\Filament\Resources\Paths\Pages\EditPath;
use App\Filament\Resources\Paths\Pages\ListPaths;
use App\Filament\Resources\Paths\RelationManagers\ModulesRelationManager;
use App\Filament\Resources\Paths\Schemas\PathForm;
use App\Filament\Resources\Paths\Tables\PathsTable;
use App\Models\Path;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PathResource extends Resource
{
    protected static ?string $model = Path::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $modelLabel = "Path";
    protected static string | \UnitEnum | null $navigationGroup = "Produto";
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return PathForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PathsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ModulesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPaths::route('/'),
            'create' => CreatePath::route('/create'),
            'edit' => EditPath::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}

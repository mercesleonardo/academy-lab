<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    FileUpload::make('avatar')
                        ->columnSpanFull(),
                    Select::make('role_id')
                        ->label('Papel')
                        ->relationship('role', 'name')
                        ->required()
                        ->default(2),
                    TextInput::make('name')
                        ->label('Nome')
                        ->required(),
                    TextInput::make('email')
                        ->label('Email address')
                        ->email()
                        ->unique()
                        ->required(),
                    TextInput::make('password')
                        ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                        ->dehydrated(fn (?string $state): bool => filled($state))
                        ->required(fn (string $operation): bool => $operation === 'create')
                        ->password(),
                    TextInput::make('document')
                        ->label('CPF ou CNPJ')
                        ->dehydrateStateUsing(fn (string $state): string => preg_replace('/\D/', '', $state))
                        ->mask(RawJs::make(<<<'JS'
                            $input.length > 14 ? '99.999.999/9999-99' : '999.999.999-99'
                        JS))
                        ->rule('cpf_ou_cnpj')
                        ->unique()
                        ->disabled(fn (string $operation): bool => $operation === 'edit')
                        ->required(),
                    TextInput::make('phone')
                        ->mask('(99) 99999-9999')
                        ->tel(),
                ])->columns(2)
            ])->columns(1);
    }
}

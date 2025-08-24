<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\Toko;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Illuminate\Validation\Rules\Password;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Profile')->schema([
                    TextInput::make('name')
                        ->label('Nama User')
                        ->required()
                        ->maxLength(150),
                    TextInput::make('username')
                        ->label('Username')
                        ->required(),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true),
                    Select::make('role')
                        ->label('Pilih Role')
                        ->options([
                            'admin' => 'Admin',
                            'owner' => 'Owner',
                            'kasir' => 'Kasir',
                        ])
                        ->required()
                        ->reactive(),
                    Select::make('toko_id')
                        ->label('Pilih Toko')
                        ->options(Toko::query()->orderBy('nama_toko')->pluck('nama_toko', 'id'))
                        ->searchable()
                        ->preload()
                        ->visible(fn(callable $get) => $get('role') !== 'admin')
                        ->required(fn(callable $get) => in_array($get('role'), ['owner', 'kasir'], true)),
                    Textinput::make('password')
                        ->password()
                        ->revealable()
                        ->dehydrateStateUsing(fn($state) => filled($state) ? bcrypt($state) : null)
                        ->required(fn(string $operation) => $operation === 'create')
                        ->rule(Password::default())
                        ->dehydrated(fn($state) => filled($state)),
                ])->columns(2)
            ])->columns(1);
    }
}

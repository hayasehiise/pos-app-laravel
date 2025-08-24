<?php

namespace App\Filament\Resources\Tokos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TokoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Info Toko')->schema([
                    TextInput::make('nama_toko')->label('Nama Toko')->required()->maxLength(150),
                    TextInput::make('telp')->tel(),
                    TextInput::make('alamat')->columnSpanFull(),
                ])->columns(2),
            ]);
    }
}

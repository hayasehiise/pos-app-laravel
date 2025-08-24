<?php

namespace App\Filament\Resources\Penjualans;

use App\Filament\Resources\Penjualans\Pages\CreatePenjualan;
use App\Filament\Resources\Penjualans\Pages\EditPenjualan;
use App\Filament\Resources\Penjualans\Pages\ListPenjualans;
use App\Filament\Resources\Penjualans\Schemas\PenjualanForm;
use App\Filament\Resources\Penjualans\Tables\PenjualansTable;
use App\Models\Penjualan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PenjualanResource extends Resource
{
    protected static ?string $model = Penjualan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingBag;

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'Penjualan Management';

    protected static ?string $modelLabel = "Penjualan";

    protected static ?string $pluralModelLabel = "Manage Penjualan";

    public static function form(Schema $schema): Schema
    {
        return PenjualanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenjualansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPenjualans::route('/'),
            'create' => CreatePenjualan::route('/create'),
            'edit' => EditPenjualan::route('/{record}/edit'),
        ];
    }
}

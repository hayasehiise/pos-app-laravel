<?php

namespace App\Filament\Resources\Tokos;

use App\Filament\Resources\Tokos\Pages\CreateToko;
use App\Filament\Resources\Tokos\Pages\EditToko;
use App\Filament\Resources\Tokos\Pages\ListTokos;
use App\Filament\Resources\Tokos\Schemas\TokoForm;
use App\Filament\Resources\Tokos\Tables\TokosTable;
use App\Models\Toko;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TokoResource extends Resource
{
    protected static ?string $model = Toko::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingStorefront;

    protected static ?string $navigationLabel = 'Management Toko';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Toko';

    protected static ?string $pluralModelLabel = 'Manage Toko';

    protected static ?string $slug = 'toko';

    protected static ?string $recordTitleAttribute = 'Toko Management';

    public static function form(Schema $schema): Schema
    {
        return TokoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TokosTable::configure($table);
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
            'index' => ListTokos::route('/'),
            'create' => CreateToko::route('/create'),
            'edit' => EditToko::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        return Filament::auth()->check() && Filament::auth()->user()->hasRole('admin');
    }
}

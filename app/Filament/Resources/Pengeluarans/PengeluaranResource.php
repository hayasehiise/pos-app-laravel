<?php

namespace App\Filament\Resources\Pengeluarans;

use App\Filament\Resources\Pengeluarans\Pages\CreatePengeluaran;
use App\Filament\Resources\Pengeluarans\Pages\EditPengeluaran;
use App\Filament\Resources\Pengeluarans\Pages\ListPengeluarans;
use App\Filament\Resources\Pengeluarans\Schemas\PengeluaranForm;
use App\Filament\Resources\Pengeluarans\Tables\PengeluaransTable;
use App\Models\Pengeluaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PengeluaranResource extends Resource
{
    protected static ?string $model = Pengeluaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentCurrencyDollar;
    protected static ?int $navigationSort = 6;
    public static function getNavigationGroup(): string|UnitEnum|null
    {
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            return 'Manage Data';
        }

        return null;
    }

    protected static ?string $modelLabel = "Pengeluaran";
    protected static ?string $pluralModelLabel = "Manage Pengeluaran";
    protected static ?string $recordTitleAttribute = 'Pengeluaran Management';


    public static function form(Schema $schema): Schema
    {
        return PengeluaranForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PengeluaransTable::configure($table);
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
            'index' => ListPengeluarans::route('/'),
            'create' => CreatePengeluaran::route('/create'),
            'edit' => EditPengeluaran::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        $user = auth()->user();
        return $user?->can('viewAny', Pengeluaran::class) === true;
    }
}

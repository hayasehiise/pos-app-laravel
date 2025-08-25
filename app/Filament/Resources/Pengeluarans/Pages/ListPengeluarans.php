<?php

namespace App\Filament\Resources\Pengeluarans\Pages;

use App\Filament\Resources\Pengeluarans\PengeluaranResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

class ListPengeluarans extends ListRecords
{
    protected static string $resource = PengeluaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->icon(Heroicon::PlusCircle)
            ->label('Input Pengeluaran'),
        ];
    }
}

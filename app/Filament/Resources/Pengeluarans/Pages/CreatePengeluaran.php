<?php

namespace App\Filament\Resources\Pengeluarans\Pages;

use App\Filament\Resources\Pengeluarans\PengeluaranResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePengeluaran extends CreateRecord
{
    protected static string $resource = PengeluaranResource::class;

    protected static ?string $title = "Manage Pengeluaran";

    protected ?string $heading = "Input Pengeluaran";

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = auth()->user();

        if (!$user->hasRole('admin')) {
            $data['toko_id'] = $user->toko_id;
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

<?php

namespace App\Filament\Resources\Penjualans\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Penjualans\PenjualanResource;

class CreatePenjualan extends CreateRecord
{
    protected static string $resource = PenjualanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = auth()->user();

        if ($user->hasRole('owner') || $user->hasRole('kasir')) {
            $data['toko_id'] = $user->toko_id;
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

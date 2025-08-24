<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected string $roleToAssign;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->roleToAssign = $data['role'] ?? 'kasir';
        unset($data['role']);
        // memastikan kalau toko terisi bukan untuk admin
        if (in_array($this->roleToAssign, ['owner', 'kasir'], true) && empty($data['toko_id'])) {
            throw new \RuntimeException('Owner/Kasir wajib memiliki Toko');
        }
        return $data;
    }

    protected function afterSave(): void
    {
        if (isset($this->record) && isset($this->roleToAssign)) {
            $this->record->syncRoles([$this->roleToAssign]);
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

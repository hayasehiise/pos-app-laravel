<?php

namespace App\Filament\Resources\Produks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
// use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
// use Illuminate\Database\Eloquent\Builder;

class ProduksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_produk')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('harga_jual')
                    ->label('Harga')
                    ->money('idr'),
                TextColumn::make('stock')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->getStateUsing(fn($record) => $record->stock > 0 ? 'TERSEDIA' : 'HABIS')
                    ->colors([
                        'success' => fn($state) => $state === 'TERSEDIA',
                        'danger' => fn($state) => $state === 'HABIS',
                    ])
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->color('warning'),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

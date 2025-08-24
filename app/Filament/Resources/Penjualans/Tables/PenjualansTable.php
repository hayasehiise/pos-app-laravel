<?php

namespace App\Filament\Resources\Penjualans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PenjualansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('produk.nama_produk')
                    ->label("Nama Produk")
                    ->searchable(),
                TextColumn::make('tanggal_penjualan')
                    ->label('Tanggal Penjualan')
                    ->date()
                    ->sortable(),
                TextColumn::make('quantitas')
                    ->label('Total Item'),
                TextColumn::make('diskon')
                    ->label('Diskon')
                    ->formatStateUsing(fn($state) => $state . '%'),
                TextColumn::make('total_harga')
                    ->label('Total Penjualan')
                    ->money('idr'),
                TextColumn::make('produk.stock')
                    ->label('Stock Tersedia')
                    ->colors([
                        'success' => fn($state) => $state > 20,
                        'warning' => fn($state) => $state <= 20 && $state > 0,
                        'danger' => fn($state) => $state == 0,
                    ]),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

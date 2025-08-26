<?php

namespace App\Filament\Resources\Pengeluarans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PengeluaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('deskripsi')
                    ->label('Jenis Pengeluaran')
                    ->searchable(),
                TextColumn::make('tanggal_pengeluaran')
                    ->label('Tanggal Pengeluaran')
                    ->date()
                    ->sortable(),
                TextColumn::make('total_pengeluaran')
                    ->label("Total Pengeluaran")
                    ->money('idr'),
                TextColumn::make('toko.nama_toko')
                    ->label('Toko'),
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

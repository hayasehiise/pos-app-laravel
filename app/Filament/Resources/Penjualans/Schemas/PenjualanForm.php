<?php

namespace App\Filament\Resources\Penjualans\Schemas;

use App\Models\Produk;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class PenjualanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Input Penjualan')
                    ->schema([
                        Select::make('produk_id')
                            ->label('Pilih Produk')
                            ->options(function () {
                                $user = auth()->user();
                                $query = Produk::query()
                                    ->where('stock', '>', 0)
                                    ->where('toko_id', $user->toko_id);

                                return $query->pluck('nama_produk', 'id');
                            })
                            ->reactive()
                            ->afterStateUpdated(fn($state, callable $set) => $set('quantitas', 1)),
                        DatePicker::make('tanggal_penjualan')
                            ->default(now()),
                        TextInput::make('quantitas')
                            ->label('Quantitas Produk')
                            ->numeric()
                            ->reactive()
                            ->required()
                            ->rule(function ($get) {
                                $produk = Produk::find($get('produk_id'));
                                if ($produk) {
                                    return 'max:' . $produk->stock;
                                }
                                return null;
                            })
                            ->afterStateUpdated(function ($state, $get, $set) {
                                $produk = Produk::find($get('produk_id'));
                                if ($produk) {
                                    $total = ($produk->harga_jual * $state) - ($get('diskon') / 100);
                                    $set('total_harga', $total);
                                }
                            }),
                        TextInput::make('diskon')
                            ->label("Diskon")
                            ->default(0)
                            ->reactive()
                            ->afterStateUpdated(function ($state, $get, $set) {
                                $produk = Produk::find($get('produk_id'));
                                if ($produk) {
                                    $total = ($produk->harga_jual * $get('quantitas')) - ($state / 100);
                                    $set('total_harga', $total);
                                }
                            }),
                        TextInput::make('total_harga')
                            ->label('Total Harga')
                            ->numeric()
                            ->readOnly()
                            ->prefix('Rp'),
                    ])->columns(2)
            ])->columns(1);
    }
}

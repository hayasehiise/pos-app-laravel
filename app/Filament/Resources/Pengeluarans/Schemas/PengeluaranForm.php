<?php

namespace App\Filament\Resources\Pengeluarans\Schemas;

use App\Models\Pengeluaran;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;

class PengeluaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Input Pengeluaran')
                    ->schema([
                        Select::make('deskripsi')
                            ->label('Jenis Pengeluaran')
                            ->searchable()
                            ->options(function () {
                                return Pengeluaran::query()
                                    ->select('deskripsi')
                                    ->distinct()
                                    ->pluck('deskripsi', 'deskripsi');
                            })
                            ->getOptionLabelUsing(fn($value): ?string => $value)
                            ->createOptionForm([
                                Textinput::make('deskripsi')
                                    ->label('Deksripsi Baru')
                                    ->required()
                            ])
                            ->createOptionUsing(function ($data) {
                                return $data['deskripsi'];
                            })
                            ->createOptionAction(function (Action $action) {
                                return $action->modalWidth('sm');
                            })
                            ->required(),
                        DatePicker::make('tanggal_pengeluaran')
                            ->default(now())
                            ->extraAttributes([
                                'style' => 'width: 10rem',
                            ]),
                        TextInput::make('total_pengeluaran')
                            ->label('Total Pengeluaran')
                            ->numeric()
                            ->required()
                            ->prefix('Rp'),
                    ])->columns(1)
            ]);
    }
}

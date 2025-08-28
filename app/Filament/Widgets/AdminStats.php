<?php

namespace App\Filament\Widgets;

use App\Models\Pengeluaran;
use App\Models\Penjualan;
use App\Models\Toko;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStats extends StatsOverviewWidget
{
    protected ?string $pollingInterval = null;
    protected static bool $isLazy = false;

    protected function getColumns(): int|array|null
    {
        return 2;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total User', User::count())
                ->description('Total Dari User Terdaftar'),
            Stat::make('Total Toko', Toko::count())
                ->description('Total Dari Toko Terdaftar'),
            Stat::make('Total Penjualan', Penjualan::count())
                ->description('Total Data Penjualan di Database'),
            Stat::make('Total Pengeluaran', Pengeluaran::count())
                ->description('Total Data Pengeluaran di Database')
        ];
    }
}

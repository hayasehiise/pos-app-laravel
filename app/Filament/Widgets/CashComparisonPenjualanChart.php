<?php

namespace App\Filament\Widgets;

use App\Models\Penjualan;
use Filament\Widgets\ChartWidget;

class CashComparisonPenjualanChart extends ChartWidget
{
    protected ?string $heading = 'Cash Comparison Penjualan';

    protected int|string|array $columnSpan = 1;

    protected ?string $pollingInterval = null;

    protected function getMonthlyData(string $model, string $column, string $sumColumn): array
    {
        $now = now();
        $thisMonth = $now->month;
        $thisYear = $now->year;

        $lastMonth = $now->copy()->subMonth()->month;
        $lastMonthYear = $now->copy()->subMonth()->year;

        $thisMonthData = $model::whereYear($column, $thisYear)
            ->whereMonth($column, $thisMonth)
            ->sum($sumColumn);

        $lastMontData = $model::whereYear($column, $lastMonthYear)
            ->whereMonth($column, $lastMonth)
            ->sum($sumColumn);

        return [$lastMontData, $thisMonthData];
    }

    protected function getData(): array
    {
        [$lastMontData, $thisMonthData] = $this->getMonthlyData(Penjualan::class, 'tanggal_penjualan', 'total_harga');
        return [
            'datasets' => [[
                'label' => 'Penjualan',
                'data' => [$lastMontData, $thisMonthData],
                'backgroundColor' => ['oklch(0.8402 0.2326 141.46)', 'oklch(0.7007 0.2326 141.46)'],
            ]],
            'labels' => ['Bulan Kemarin', 'Bulan Ini']
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
